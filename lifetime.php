<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Load config for site branding
require_once __DIR__ . '/src/config.php';

// Fetch Lifetime Plan from Supabase
require_once __DIR__ . '/src/services/SupabaseService.php';
$service = new \App\Services\SupabaseService();
$dbPlans = $service->getActivePlans();

// Find the lifetime plan
$lifetimePlan = null;
foreach ($dbPlans as $plan) {
    if (strpos($plan['id'], 'lifetime') !== false) {
        $lifetimePlan = $plan;
        break;
    }
}

// Fallback if not found
if (!$lifetimePlan) {
    $lifetimePlan = [
        'id' => 'lifetime',
        'name' => 'Lifetime',
        'price' => 149,
        'stripe_price_id' => $_ENV['PRICE_LIFETIME'] ?? '',
        'badge' => 'LIMITED OFFER'
    ];
}

include __DIR__ . '/src/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative py-20 lg:py-28 overflow-hidden">
    <!-- Background effects -->
    <div class="absolute top-10 left-10 w-96 h-96 bg-gradient-to-br from-amber-500/20 to-orange-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-gradient-to-br from-teal-500/20 to-emerald-500/20 rounded-full blur-3xl animate-float"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#217c71]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Limited Time Badge -->
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500/20 to-orange-500/20 border border-amber-500/30 rounded-full mb-8 animate-pulse">
                <i data-lucide="clock" class="w-5 h-5 text-amber-400"></i>
                <span class="text-amber-300 font-bold uppercase tracking-wider text-sm">Limited Time Offer</span>
                <i data-lucide="sparkles" class="w-5 h-5 text-amber-400"></i>
            </div>

            <!-- Headline -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight">
                Get <span class="gradient-text">Lifetime Access</span>
                <br>for One Price
            </h1>

            <!-- Subheadline -->
            <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-2xl mx-auto">
                Pay once, own forever. No monthly fees. No annual renewals. 
                Just unlimited AI power in your spreadsheets.
            </p>

            <!-- Price Display -->
            <div class="glass rounded-3xl p-8 md:p-12 max-w-lg mx-auto mb-10 glow">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <span class="text-3xl text-gray-500 line-through">$149</span>
                    <span class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-300 via-emerald-300 to-teal-300">
                        $<?php echo number_format((float)$lifetimePlan['price'], 2); ?>
                    </span>
                </div>
                <p class="text-emerald-400 font-semibold text-lg mb-2">One-time payment • Forever access</p>
                <p class="text-gray-400 text-sm">No subscriptions. No hidden fees. Pay once, use forever.</p>
            </div>

            <!-- CTA Button -->
            <?php if (isset($_SESSION['user'])): ?>
                <button onclick="buyLifetime('<?php echo $lifetimePlan['id']; ?>', '<?php echo $lifetimePlan['stripe_price_id']; ?>')"
                    class="group px-12 py-5 bg-gradient-to-r from-[#217c71] to-[#1a625a] hover:from-[#2a8f82] hover:to-[#227a6f] rounded-2xl font-bold text-xl text-white shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow flex items-center justify-center gap-3 mx-auto">
                    <i data-lucide="zap" class="w-6 h-6"></i>
                    Get Lifetime Access Now
                    <i data-lucide="arrow-right" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
                </button>
            <?php else: ?>
                <a href="auth.php?plan=<?php echo urlencode($lifetimePlan['id']); ?>&priceId=<?php echo urlencode($lifetimePlan['stripe_price_id']); ?>"
                    class="group inline-flex px-12 py-5 bg-gradient-to-r from-[#217c71] to-[#1a625a] hover:from-[#2a8f82] hover:to-[#227a6f] rounded-2xl font-bold text-xl text-white shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow items-center justify-center gap-3">
                    <i data-lucide="zap" class="w-6 h-6"></i>
                    Get Lifetime Access Now
                    <i data-lucide="arrow-right" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
                </a>
            <?php endif; ?>

            <!-- Trust indicators -->
            <div class="flex flex-wrap justify-center gap-6 mt-8 text-sm text-gray-400">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-green-400"></i>
                    Secure Payment
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="credit-card" class="w-4 h-4 text-teal-400"></i>
                    Powered by Stripe
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-4 h-4 text-emerald-400"></i>
                    30-Day Money Back
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What You Get Section -->
<section class="py-20 border-y border-white/5">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Everything Included, <span class="gradient-text">Forever</span>
            </h2>
            <p class="text-gray-400 text-lg">One payment unlocks the complete AI toolkit</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
            <!-- Feature 1 -->
            <div class="glass rounded-2xl p-6 text-center card-hover reveal">
                <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-gradient-to-br from-teal-500/20 to-emerald-500/20 flex items-center justify-center">
                    <i data-lucide="infinity" class="w-7 h-7 text-teal-400"></i>
                </div>
                <h3 class="font-bold mb-2">Unlimited Processing</h3>
                <p class="text-gray-400 text-sm">No row limits, no caps. Process as much as you need.</p>
            </div>

            <!-- Feature 2 -->
            <div class="glass rounded-2xl p-6 text-center card-hover reveal" style="animation-delay: 0.1s;">
                <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-gradient-to-br from-purple-500/20 to-violet-500/20 flex items-center justify-center">
                    <i data-lucide="brain" class="w-7 h-7 text-purple-400"></i>
                </div>
                <h3 class="font-bold mb-2">All AI Models</h3>
                <p class="text-gray-400 text-sm">GPT-5, Gemini 3, and more included.</p>
            </div>

            <!-- Feature 3 -->
            <div class="glass rounded-2xl p-6 text-center card-hover reveal" style="animation-delay: 0.2s;">
                <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-gradient-to-br from-amber-500/20 to-orange-500/20 flex items-center justify-center">
                    <i data-lucide="gift" class="w-7 h-7 text-amber-400"></i>
                </div>
                <h3 class="font-bold mb-2">Future Updates</h3>
                <p class="text-gray-400 text-sm">All new features and AI models at no extra cost.</p>
            </div>

            <!-- Feature 4 -->
            <div class="glass rounded-2xl p-6 text-center card-hover reveal" style="animation-delay: 0.3s;">
                <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-gradient-to-br from-pink-500/20 to-rose-500/20 flex items-center justify-center">
                    <i data-lucide="headphones" class="w-7 h-7 text-pink-400"></i>
                </div>
                <h3 class="font-bold mb-2">Priority Support</h3>
                <p class="text-gray-400 text-sm">Get help faster with dedicated lifetime support.</p>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Why <span class="gradient-text">Lifetime</span> Makes Sense
            </h2>
        </div>

        <div class="max-w-3xl mx-auto glass rounded-3xl p-8 reveal">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Monthly comparison -->
                <div class="text-center p-6 rounded-2xl bg-red-500/5 border border-red-500/20">
                    <div class="text-red-400 font-bold mb-4">Monthly Subscription</div>
                    <div class="text-4xl font-bold text-gray-400 mb-2">$9.99<span class="text-lg">/mo</span></div>
                    <div class="text-sm text-gray-500 mb-4">=$120/year, $600 over 5 years</div>
                    <ul class="text-left text-sm text-gray-400 space-y-2">
                        <li class="flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4 text-red-400"></i>
                            Recurring payments forever
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4 text-red-400"></i>
                            Price increases over time
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4 text-red-400"></i>
                            Lose access if you cancel
                        </li>
                    </ul>
                </div>

                <!-- Lifetime comparison -->
                <div class="text-center p-6 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 ring-2 ring-emerald-500/20">
                    <div class="text-emerald-400 font-bold mb-4">Lifetime Deal</div>
                    <div class="text-4xl font-bold text-white mb-2">$<?php echo number_format((float)$lifetimePlan['price'], 2); ?><span class="text-lg text-emerald-400"> once</span></div>
                    <div class="text-sm text-emerald-400 mb-4">Pay once, use forever!</div>
                    <ul class="text-left text-sm text-gray-300 space-y-2">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-400"></i>
                            One-time payment only
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-400"></i>
                            Lock in this price forever
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-400"></i>
                            Lifetime access guaranteed
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Full Features List -->
<section class="py-20 border-y border-white/5">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Complete <span class="gradient-text">Feature List</span>
            </h2>
        </div>

        <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-4">
            <?php
            $features = [
                'Unlimited AI Processing',
                'All AI Models (GPT-5, Gemini, etc.)',
                'Background Job Processing',
                'Pause & Resume Jobs',
                'Priority Support',
                'No Row Limits',
                'All Future Updates',
                'Smart Batch Processing',
                'Column Variables Support',
                'Error Recovery',
                'Job History & Tracking',
                'Bring Your Own API Key'
            ];
            foreach ($features as $index => $feature): ?>
                <div class="flex items-center gap-3 glass rounded-xl p-4 reveal" style="animation-delay: <?php echo $index * 0.05; ?>s;">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-400"></i>
                    </div>
                    <span class="text-gray-200"><?php echo $feature; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="py-24">
    <div class="container mx-auto px-6">
        <div class="relative max-w-3xl mx-auto reveal">
            <!-- Background glow -->
            <div class="absolute inset-0 bg-gradient-to-r from-teal-500/20 via-[#217c71]/20 to-teal-500/20 rounded-3xl blur-3xl"></div>

            <!-- Card -->
            <div class="relative glass rounded-3xl p-12 text-center glow">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500/20 border border-amber-500/30 rounded-full mb-6">
                    <i data-lucide="timer" class="w-4 h-4 text-amber-400"></i>
                    <span class="text-amber-300 text-sm font-medium">Limited Time Pricing</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Don't Miss This <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-200 to-emerald-200">Lifetime Deal</span>
                </h2>
                <p class="text-gray-400 mb-8 max-w-lg mx-auto">
                    Lock in lifetime access at this special launch price before it's gone forever.
                </p>

                <?php if (isset($_SESSION['user'])): ?>
                    <button onclick="buyLifetime('<?php echo $lifetimePlan['id']; ?>', '<?php echo $lifetimePlan['stripe_price_id']; ?>')"
                        class="group px-10 py-5 bg-gradient-to-r from-[#217c71] to-[#1a625a] hover:from-[#2a8f82] hover:to-[#227a6f] rounded-2xl font-bold text-lg text-white shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow inline-flex items-center gap-3">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                        Get Lifetime Access — $<?php echo number_format((float)$lifetimePlan['price'], 2); ?>
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                <?php else: ?>
                    <a href="auth.php?plan=<?php echo urlencode($lifetimePlan['id']); ?>&priceId=<?php echo urlencode($lifetimePlan['stripe_price_id']); ?>"
                        class="group inline-flex px-10 py-5 bg-gradient-to-r from-[#217c71] to-[#1a625a] hover:from-[#2a8f82] hover:to-[#227a6f] rounded-2xl font-bold text-lg text-white shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow items-center gap-3">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                        Get Lifetime Access — $<?php echo number_format((float)$lifetimePlan['price'], 2); ?>
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                <?php endif; ?>

                <p class="mt-6 text-gray-500 text-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 inline text-green-400"></i>
                    30-day money-back guarantee • Secure checkout via Stripe
                </p>
            </div>
        </div>
    </div>
</section>

<script>
    async function buyLifetime(plan, priceId) {
        const btn = event.target.closest('button');
        const oldHTML = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i> Processing...';
        btn.disabled = true;
        lucide.createIcons();

        try {
            const res = await fetch('api/create-checkout.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ plan: plan, price_id: priceId })
            });

            const data = await res.json();

            if (data.url) {
                window.location.href = data.url;
            } else {
                alert(data.error || 'Something went wrong');
                btn.innerHTML = oldHTML;
                btn.disabled = false;
                lucide.createIcons();
            }
        } catch (e) {
            alert('Network error');
            btn.innerHTML = oldHTML;
            btn.disabled = false;
            lucide.createIcons();
        }
    }
</script>

<?php include __DIR__ . '/src/includes/footer.php'; ?>
