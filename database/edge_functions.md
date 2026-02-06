## check-entitlement

import { serve } from 'https://deno.land/std@0.168.0/http/server.ts'
import { createClient } from 'https://esm.sh/@supabase/supabase-js@2'

const corsHeaders = {
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Headers': 'authorization, x-client-info, apikey, content-type',
}

serve(async (req) => {
  // Handle CORS preflight requests
  if (req.method === 'OPTIONS') {
    return new Response('ok', { headers: corsHeaders })
  }

  try {
    const supabaseClient = createClient(
      Deno.env.get('SUPABASE_URL') ?? '',
      Deno.env.get('MY_SERVICE_ROLE_KEY') ?? ''
    )

    const { google_user_id } = await req.json()

    if (!google_user_id) {
      return new Response(
        JSON.stringify({ error: 'google_user_id is required' }),
        { status: 400, headers: { ...corsHeaders, 'Content-Type': 'application/json' } }
      )
    }

    // Look up user by Google email
    let { data: user, error: userError } = await supabaseClient
      .from('users')
      .select('*')
      .eq('google_user_id', google_user_id)
      .single()

    // If user doesn't exist, create them with a 30-day trial
    if (!user) {
      // Create new user
      const { data: newUser, error: createUserError } = await supabaseClient
        .from('users')
        .insert({ google_user_id })
        .select()
        .single()

      if (createUserError) throw createUserError
      user = newUser

      // Create trial entitlement (30 days)
      const validUntil = new Date()
      validUntil.setDate(validUntil.getDate() + 30)

      const { error: entitlementError } = await supabaseClient
        .from('entitlements')
        .insert({
          user_id: user.id,
          plan: 'trial',
          status: 'trial',
          valid_until: validUntil.toISOString()
        })

      if (entitlementError) throw entitlementError
    }

    // Get entitlement for this user
    const { data: entitlement, error: entitlementError } = await supabaseClient
      .from('entitlements')
      .select('*')
      .eq('user_id', user.id)
      .order('created_at', { ascending: false })
      .limit(1)
      .single()

    if (entitlementError && entitlementError.code !== 'PGRST116') {
      throw entitlementError
    }

    // Calculate access status
    const now = new Date()
    let hasAccess = false
    let trialDaysRemaining = null
    let status = entitlement?.status || 'expired'

    if (entitlement) {
      if (entitlement.plan.includes('lifetime')) {
        hasAccess = true
        status = 'active'
      } else if (entitlement.valid_until) {
        const validUntil = new Date(entitlement.valid_until)
        hasAccess = validUntil > now && (status === 'active' || status === 'trial')
        
        if (status === 'trial') {
          const diffMs = validUntil.getTime() - now.getTime()
          trialDaysRemaining = Math.max(0, Math.ceil(diffMs / (1000 * 60 * 60 * 24)))
        }
        
        // Update status if expired
        if (validUntil <= now && status !== 'canceled') {
          status = 'expired'
          hasAccess = false
        }
      }
    }

    return new Response(
      JSON.stringify({
        has_access: hasAccess,
        plan: entitlement?.plan || null,
        status: status,
        valid_until: entitlement?.valid_until || null,
        trial_days_remaining: trialDaysRemaining,
        stripe_customer_id: user.stripe_customer_id || null
      }),
      { headers: { ...corsHeaders, 'Content-Type': 'application/json' } }
    )

  } catch (error) {
    return new Response(
      JSON.stringify({ error: error.message }),
      { status: 500, headers: { ...corsHeaders, 'Content-Type': 'application/json' } }
    )
  }
})


## create-checkout

import { serve } from "https://deno.land/std@0.168.0/http/server.ts";
import { createClient } from "https://esm.sh/@supabase/supabase-js@2";
const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers": "authorization, x-client-info, apikey, content-type",
};
function stripeFormEncode(params: Record<string, string>) {
  return new URLSearchParams(params).toString();
}
serve(async (req) => {
  if (req.method === "OPTIONS") return new Response("ok", { headers: corsHeaders });
  try {
    const STRIPE_SECRET_KEY = Deno.env.get("STRIPE_SECRET_KEY") || "";
    if (!STRIPE_SECRET_KEY) throw new Error("Missing STRIPE_SECRET_KEY");
    const supabase = createClient(
      Deno.env.get("SUPABASE_URL") ?? "",
      Deno.env.get("MY_SERVICE_ROLE_KEY") ?? ""
    );
    // FIX 1: Read 'mode' from request (defaulting to undefined initially)
    const { google_user_id, email, plan, price_id, mode: requestMode } = await req.json();
    if (!google_user_id || !email || !plan || !price_id) {
      return new Response(JSON.stringify({ error: "Missing required fields" }), {
        status: 400,
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    const { data: user, error: userError } = await supabase
      .from("users")
      .select("*")
      .eq("google_user_id", google_user_id)
      .single();
    if (userError || !user) {
      return new Response(JSON.stringify({ error: "User not found" }), {
        status: 404,
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    let customerId = user.stripe_customer_id as string | null;
    // Create Stripe customer via HTTP if missing
    if (!customerId) {
      const customerRes = await fetch("https://api.stripe.com/v1/customers", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${STRIPE_SECRET_KEY}`,
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: stripeFormEncode({
          email,
          "metadata[google_user_id]": google_user_id,
        }),
      });
      const customerJson = await customerRes.json();
      if (!customerRes.ok) throw new Error(customerJson.error?.message || "Stripe customer create failed");
      customerId = customerJson.id;
      await supabase.from("users").update({ stripe_customer_id: customerId }).eq("id", user.id);
    }
    const WEBSITE_URL = Deno.env.get("WEBSITE_URL") || "https://yourwebsite.com";
    
    // FIX 2: Use the passed mode, or fallback to smart detection, or default to subscription
    // This fixes the issue where strict checking (plan === "lifetime") failed for "lifetime_promo" etc.
    const mode = requestMode || (plan.includes("lifetime") ? "payment" : "subscription");
    console.log(`Creating session. Plan: ${plan}, Mode: ${mode}`);
    // Create Checkout Session via HTTP
    const sessionRes = await fetch("https://api.stripe.com/v1/checkout/sessions", {
      method: "POST",
      headers: {
        Authorization: `Bearer ${STRIPE_SECRET_KEY}`,
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: stripeFormEncode({
        mode,
        customer: customerId!,
        success_url: `${WEBSITE_URL}/success.php?session_id={CHECKOUT_SESSION_ID}`,
        cancel_url: `${WEBSITE_URL}/pricing.php`,
        client_reference_id: user.id,
        // line_items[0][price]=... & line_items[0][quantity]=1
        "line_items[0][price]": price_id,
        "line_items[0][quantity]": "1",
        "metadata[google_user_id]": google_user_id,
        "metadata[plan]": plan,
      }),
    });
    const sessionJson = await sessionRes.json();
    if (!sessionRes.ok) throw new Error(sessionJson.error?.message || "Stripe checkout session create failed");
    return new Response(JSON.stringify({ checkout_url: sessionJson.url, session_id: sessionJson.id }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 200,
    });
  } catch (error) {
    return new Response(JSON.stringify({ error: error.message }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
});

## create-portal

import { serve } from "https://deno.land/std@0.168.0/http/server.ts";
import { createClient } from "https://esm.sh/@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers": "authorization, x-client-info, apikey, content-type",
};

serve(async (req) => {
  if (req.method === "OPTIONS") return new Response("ok", { headers: corsHeaders });

  try {
    const STRIPE_SECRET_KEY = Deno.env.get("STRIPE_SECRET_KEY") || "";
    if (!STRIPE_SECRET_KEY) throw new Error("Missing STRIPE_SECRET_KEY");
    
    // Website URL for return link (default to configured env or fallback)
    const WEBSITE_URL = Deno.env.get("WEBSITE_URL") || "https://sheetaibridge.com";

    const supabase = createClient(
      Deno.env.get("SUPABASE_URL") ?? "",
      Deno.env.get("MY_SERVICE_ROLE_KEY") ?? ""
    );

    const { google_user_id, return_url } = await req.json();

    if (!google_user_id) {
       return new Response(JSON.stringify({ error: "Missing google_user_id" }), {
        status: 400,
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 1. Get User
    const { data: user, error: userError } = await supabase
      .from("users")
      .select("stripe_customer_id")
      .eq("google_user_id", google_user_id)
      .single();

    if (userError || !user || !user.stripe_customer_id) {
      return new Response(JSON.stringify({ error: "User or Stripe Customer ID not found" }), {
        status: 404,
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 2. Create Portal Session
    // curl https://api.stripe.com/v1/billing_portal/sessions \
    //   -u sk_test_...: \
    //   -d customer=cus_... \
    //   -d return_url="https://example.com/account"
    const response = await fetch("https://api.stripe.com/v1/billing_portal/sessions", {
      method: "POST",
      headers: {
        Authorization: `Bearer ${STRIPE_SECRET_KEY}`,
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        customer: user.stripe_customer_id,
        return_url: return_url || WEBSITE_URL,
      }).toString(),
    });

    const session = await response.json();

    if (!response.ok) {
        throw new Error(session.error?.message || "Failed to create portal session");
    }

    return new Response(JSON.stringify({ url: session.url }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 200,
    });

  } catch (error) {
    return new Response(JSON.stringify({ error: error.message }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
});


## stripe-webhook

import { serve } from "https://deno.land/std@0.168.0/http/server.ts";
import { createClient } from "https://esm.sh/@supabase/supabase-js@2";

/**
 * Verify Stripe webhook signature using WebCrypto (Edge-safe).
 * Stripe-Signature format: "t=...,v1=...,v1=..."
 */
async function verifyStripeSignature(params: {
  payload: string;
  signatureHeader: string;
  secret: string;
  toleranceSeconds?: number;
}): Promise<void> {
  const { payload, signatureHeader, secret } = params;
  const toleranceSeconds = params.toleranceSeconds ?? 300;

  if (!secret) throw new Error("Missing STRIPE_WEBHOOK_SECRET");

  const parts = signatureHeader.split(",").map((p) => p.trim());
  const timestampPart = parts.find((p) => p.startsWith("t="));
  const v1Parts = parts.filter((p) => p.startsWith("v1="));

  if (!timestampPart || v1Parts.length === 0) {
    throw new Error("Invalid Stripe-Signature header");
  }

  const timestamp = Number(timestampPart.slice(2));
  if (!Number.isFinite(timestamp)) throw new Error("Invalid Stripe timestamp");

  const now = Math.floor(Date.now() / 1000);
  if (Math.abs(now - timestamp) > toleranceSeconds) {
    throw new Error("Stripe signature timestamp outside tolerance");
  }

  const signedPayload = `${timestamp}.${payload}`;

  const enc = new TextEncoder();
  const key = await crypto.subtle.importKey(
    "raw",
    enc.encode(secret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    ["sign"]
  );

  const mac = await crypto.subtle.sign("HMAC", key, enc.encode(signedPayload));
  const expectedHex = [...new Uint8Array(mac)]
    .map((b) => b.toString(16).padStart(2, "0"))
    .join("");

  const providedSignatures = v1Parts.map((p) => p.slice(3));

  const equalHex = (a: string, b: string) => {
    if (a.length !== b.length) return false;
    let out = 0;
    for (let i = 0; i < a.length; i++) out |= a.charCodeAt(i) ^ b.charCodeAt(i);
    return out === 0;
  };

  const ok = providedSignatures.some((sig) => equalHex(sig, expectedHex));
  if (!ok) throw new Error("No matching Stripe signature found");
}

function jsonResponse(body: unknown, status = 200) {
  return new Response(JSON.stringify(body), {
    status,
    headers: { "Content-Type": "application/json" },
  });
}

function asDateFromUnixSeconds(sec?: number | null): Date | null {
  if (!sec || !Number.isFinite(sec)) return null;
  return new Date(sec * 1000);
}

serve(async (req) => {
  const signature = req.headers.get("stripe-signature");
  if (!signature) return new Response("No signature", { status: 400 });

  try {
    const supabaseClient = createClient(
      Deno.env.get("SUPABASE_URL") ?? "",
      Deno.env.get("MY_SERVICE_ROLE_KEY") ?? ""
    );

    const body = await req.text();
    const webhookSecret = Deno.env.get("STRIPE_WEBHOOK_SECRET") || "";

    // Verify signature
    try {
      await verifyStripeSignature({
        payload: body,
        signatureHeader: signature,
        secret: webhookSecret,
      });
    } catch (err) {
      console.error("Webhook signature verification failed:", err.message);
      return new Response(`Webhook Error: ${err.message}`, { status: 400 });
    }

    // Parse event
    const event = JSON.parse(body) as { id: string; type: string; data: { object: any } };

    // Idempotency check (use maybeSingle semantics)
    const { data: existingEvent, error: existingEventErr } = await supabaseClient
      .from("webhook_events")
      .select("id")
      .eq("stripe_event_id", event.id)
      .maybeSingle?.() ?? await supabaseClient
        .from("webhook_events")
        .select("id")
        .eq("stripe_event_id", event.id)
        .single();

    // If your client doesn't support maybeSingle (older), the .single() branch above may throw on not found.
    // We'll just treat "not found" as normal.
    if (existingEvent && !existingEventErr) {
      console.log("Event already processed:", event.id);
      return jsonResponse({ received: true, duplicate: true }, 200);
    }

    // Log event (best if stripe_event_id is UNIQUE in DB)
    const { error: insertEventErr } = await supabaseClient.from("webhook_events").insert({
      stripe_event_id: event.id,
      event_type: event.type,
    });

    if (insertEventErr) {
      // If unique constraint hit due to race, treat as duplicate
      console.warn("webhook_events insert error (possible duplicate/race):", insertEventErr.message);
    }

    switch (event.type) {
      /**
       * Checkout completed: create / upsert entitlement.
       * Keep your current plan-based valid_until rules.
       */
      case "checkout.session.completed": {
        const session = event.data.object as {
          metadata?: { google_user_id?: string; plan?: string };
          subscription?: string | null;
        };

        const googleUserId = session.metadata?.google_user_id;
        const plan = session.metadata?.plan;

        if (!googleUserId || !plan) {
          console.error("Missing metadata in checkout session");
          break;
        }

        const { data: user, error: userErr } = await supabaseClient
          .from("users")
          .select("id")
          .eq("google_user_id", googleUserId)
          .single();

        if (userErr || !user) {
          console.error("User not found:", googleUserId, userErr?.message);
          break;
        }

        let validUntil: string | null = null;
        if (plan.includes("lifetime")) {
          validUntil = null;
        } else {
          // Set initial validity based on plan name to prevent race conditions
          // with invoice.payment_succeeded.
          const date = new Date();
          if (plan.includes("yearly")) {
            date.setFullYear(date.getFullYear() + 1);
          } else if (plan.includes("quarterly")) {
            date.setMonth(date.getMonth() + 3);
          } else {
            // Default to monthly (30 days)
            date.setDate(date.getDate() + 30);
          }
          validUntil = date.toISOString();
        }

        const entitlementData: any = {
          user_id: user.id,
          plan,
          status: "active",
          valid_until: validUntil,
          updated_at: new Date().toISOString(),
        };

        if (session.subscription) {
          entitlementData.stripe_subscription_id = session.subscription;
        }

        // Upsert by user_id (assumes unique constraint on entitlements.user_id)
        const { error: upsertErr } = await supabaseClient
          .from("entitlements")
          .upsert(entitlementData, { onConflict: "user_id" });

        if (upsertErr) console.error("Entitlement upsert failed:", upsertErr.message);
        else console.log("Entitlement created/updated for user:", googleUserId);

        break;
      }

      /**
       * Renewal events:
       * Stripe-standard: invoice.payment_succeeded, invoice.paid
       * Your incoming:   invoice_payment.paid
       */
      case "invoice.payment_succeeded":
      case "invoice.paid":
      case "invoice_payment.paid": {
        const invoice = event.data.object as {
          customer: string;
          subscription?: string;
          lines?: {
            data?: Array<{
              period?: { start?: number; end?: number };
              price?: { recurring?: { interval?: string; interval_count?: number } };
            }>;
          };
        };

        const customerId = invoice.customer;

        const { data: user, error: userErr } = await supabaseClient
          .from("users")
          .select("id")
          .eq("stripe_customer_id", customerId)
          .single();

        if (userErr || !user) {
          console.error("User not found for customer:", customerId, userErr?.message);
          break;
        }

        // Prefer Stripe billing period end from invoice lines (best)
        const line0 = invoice.lines?.data?.[0];
        const periodEndDate = asDateFromUnixSeconds(line0?.period?.end);

        let validUntilISO: string | null = null;

        if (periodEndDate) {
          validUntilISO = periodEndDate.toISOString();
        } else {
          // Fallback: compute from recurring interval if present
          const recurring = line0?.price?.recurring;
          const interval = recurring?.interval;
          const intervalCount = recurring?.interval_count ?? 1;

          if (!interval) {
            console.warn(
              "Invoice paid but missing period.end and recurring interval; not updating valid_until",
              "user_id:",
              user.id
            );
            // still mark active, but leave valid_until as-is
            const { error: updateErr } = await supabaseClient
              .from("entitlements")
              .update({ status: "active", updated_at: new Date().toISOString() })
              .eq("user_id", user.id);

            if (updateErr) console.error("Entitlements update failed:", updateErr.message);
            break;
          }

          const validUntil = new Date();
          if (interval === "month") validUntil.setMonth(validUntil.getMonth() + intervalCount);
          else if (interval === "year") validUntil.setFullYear(validUntil.getFullYear() + intervalCount);

          validUntilISO = validUntil.toISOString();
        }

        const updatePayload: any = {
          status: "active",
          updated_at: new Date().toISOString(),
        };

        if (validUntilISO) updatePayload.valid_until = validUntilISO;
        if (invoice.subscription) updatePayload.stripe_subscription_id = invoice.subscription;

        const { error: entErr } = await supabaseClient
          .from("entitlements")
          .update(updatePayload)
          .eq("user_id", user.id);

        if (entErr) {
          console.error("Failed to update entitlement on invoice paid:", entErr.message);
        } else {
          console.log("Subscription renewed for user:", user.id, "valid_until:", validUntilISO);
        }

        break;
      }

      /**
       * Payment failed (handle both naming styles)
       */
      case "invoice.payment_failed":
      case "invoice_payment.failed": {
        const invoice = event.data.object as { customer: string };
        const customerId = invoice.customer;

        const { data: user, error: userErr } = await supabaseClient
          .from("users")
          .select("id")
          .eq("stripe_customer_id", customerId)
          .single();

        if (userErr || !user) {
          console.error("User not found for customer:", customerId, userErr?.message);
          break;
        }

        const { error: updErr } = await supabaseClient
          .from("entitlements")
          .update({ status: "past_due", updated_at: new Date().toISOString() })
          .eq("user_id", user.id);

        if (updErr) console.error("Failed to set past_due:", updErr.message);
        else console.log("Payment failed, status updated to past_due for user:", user.id);

        break;
      }

      /**
       * Subscription canceled / deleted
       */
      case "customer.subscription.deleted": {
        const subscription = event.data.object as { customer: string };
        const customerId = subscription.customer;

        const { data: user, error: userErr } = await supabaseClient
          .from("users")
          .select("id")
          .eq("stripe_customer_id", customerId)
          .single();

        if (userErr || !user) {
          console.error("User not found for customer:", customerId, userErr?.message);
          break;
        }

        const { error: updErr } = await supabaseClient
          .from("entitlements")
          .update({ status: "canceled", updated_at: new Date().toISOString() })
          .eq("user_id", user.id);

        if (updErr) console.error("Failed to set canceled:", updErr.message);
        else console.log("Subscription canceled for user:", user.id);

        break;
      }

      default:
        console.log("Unhandled event type:", event.type);
    }

    return jsonResponse({ received: true }, 200);
  } catch (error) {
    console.error("Webhook error:", error);
    return jsonResponse({ error: error.message }, 500);
  }
});
