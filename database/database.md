-- WARNING: This schema is for context only and is not meant to be run.
-- Table order and constraints may not be valid for execution.

CREATE TABLE public.entitlements (
  id uuid NOT NULL DEFAULT uuid_generate_v4(),
  user_id uuid,
  plan text NOT NULL,
  status text NOT NULL,
  stripe_subscription_id text,
  valid_until timestamp with time zone,
  created_at timestamp with time zone DEFAULT now(),
  updated_at timestamp with time zone DEFAULT now(),
  CONSTRAINT entitlements_user_id_key UNIQUE (user_id),
  CONSTRAINT entitlements_pkey PRIMARY KEY (id),
  CONSTRAINT entitlements_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id)
);
CREATE TABLE public.plans (
  id text NOT NULL,
  name text NOT NULL,
  price numeric NOT NULL,
  description text,
  stripe_price_id text NOT NULL,
  badge text,
  features jsonb,
  active boolean DEFAULT true,
  created_at timestamp with time zone NOT NULL DEFAULT timezone('utc'::text, now()),
  CONSTRAINT plans_pkey PRIMARY KEY (id)
);
CREATE TABLE public.users (
  id uuid NOT NULL DEFAULT uuid_generate_v4(),
  google_user_id text NOT NULL UNIQUE,
  stripe_customer_id text,
  created_at timestamp with time zone DEFAULT now(),
  CONSTRAINT users_pkey PRIMARY KEY (id)
);
CREATE TABLE public.webhook_events (
  id uuid NOT NULL DEFAULT uuid_generate_v4(),
  stripe_event_id text NOT NULL UNIQUE,
  event_type text NOT NULL,
  processed_at timestamp with time zone DEFAULT now(),
  CONSTRAINT webhook_events_pkey PRIMARY KEY (id)
);