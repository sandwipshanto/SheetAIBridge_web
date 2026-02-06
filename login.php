<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Load config for site branding
require_once __DIR__ . '/src/config.php';

include __DIR__ . '/src/includes/header.php';

$plans = [
    ['id' => '6month', 'name' => '6 Months', 'price' => 29, 'period' => '/ 6 months', 'priceId' => $_ENV['PRICE_6MONTH'], 'perMonth' => '4.83'],
    ['id' => '1year', 'name' => '1 Year', 'price' => 49, 'period' => '/ year', 'priceId' => $_ENV['PRICE_1YEAR'], 'popular' => true, 'perMonth' => '4.08', 'savings' => 'Save 15%'],
    ['id' => 'lifetime', 'name' => 'Lifetime', 'price' => 149, 'period' => 'one time', 'priceId' => $_ENV['PRICE_LIFETIME'], 'perMonth' => 'Forever', 'savings' => 'Best Value']
];

$features = [
    'Unlimited AI Processing',
    'All AI Models (GPT-4o, Gemini, etc.)',
    'Background Job Processing',
    'Pause & Resume Jobs',
    'Priority Support',
    'No Row Limits',
    'All Future Updates'
];
?>

<!-- Pricing Section -->
<section class="py-24 lg:py-32 relative">
    <!-- Background effects -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-[#217c71]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                <i data-lucide="credit-card" class="w-4 h-4 inline mr-1"></i>
                Pricing
            </span>
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                Simple, transparent
                <span class="gradient-text">pricing</span>
            </h1>
            <p class="text-xl text-gray-400">
                One plan, all features. Choose the duration that works for you.
            </p>
        </div>

        <!-- Pricing Cards -->
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-20">
            <?php foreach ($plans as $index => $plan): ?>
                <div class="reveal relative" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <?php if (isset($plan['popular'])): ?>
                        <!-- Popular badge -->
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-10">
                            <span
                                class="px-4 py-1.5 bg-[#217c71] rounded-full text-xs font-bold uppercase tracking-wider shadow-lg shadow-teal-500/30">
                                Most Popular
                            </span>
                        </div>
                    <?php endif; ?>

                    <div
                        class="glass rounded-3xl p-8 h-full flex flex-col card-hover <?php echo isset($plan['popular']) ? 'ring-2 ring-teal-500/50 glow-sm' : ''; ?>">
                        <!-- Plan name -->
                        <h3 class="text-xl font-bold mb-2"><?php echo $plan['name']; ?></h3>

                        <!-- Price -->
                        <div class="mb-6">
                            <div class="flex items-baseline gap-1">
                                <span class="text-5xl font-black gradient-text">$<?php echo $plan['price']; ?></span>
                                <span class="text-gray-400"><?php echo $plan['period']; ?></span>
                            </div>
                            <?php if (isset($plan['savings'])): ?>
                                <span
                                    class="inline-block mt-2 px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-semibold">
                                    <?php echo $plan['savings']; ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Features -->
                        <ul class="space-y-3 mb-8 flex-grow">
                            <?php foreach ($features as $feature): ?>
                                <li class="flex items-center gap-3 text-sm text-gray-300">
                                    <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 flex-shrink-0"></i>
                                    <?php echo $feature; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- CTA Button -->
                        <?php if (isset($_SESSION['user'])): ?>
                            <button onclick="buy('<?php echo $plan['id']; ?>', '<?php echo $plan['priceId']; ?>')" class="w-full py-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2 <?php echo isset($plan['popular'])
                                      ? 'bg-[#217c71] hover:bg-[#1a625a] shadow-lg shadow-teal-500/25 hover:shadow-teal-500/40 btn-glow'
                                      : 'glass hover:bg-white/10 border border-white/10'; ?>">
                                <i data-lucide="zap" class="w-5 h-5"></i>
                                Select Plan
                            </button>
                        <?php else: ?>
                            <a href="auth.php?plan=<?php echo urlencode($plan['id']); ?>&priceId=<?php echo urlencode($plan['priceId']); ?>" class="w-full py-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2 <?php echo isset($plan['popular'])
                                ? 'bg-[#217c71] hover:bg-[#1a625a] shadow-lg shadow-teal-500/25 hover:shadow-teal-500/40 btn-glow'
                                : 'glass hover:bg-white/10 border border-white/10'; ?>">
                                <i data-lucide="log-in" class="w-5 h-5"></i>
                                Login to Buy
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Trust badges -->
        <div class="max-w-3xl mx-auto reveal">
            <div class="glass rounded-2xl p-6 flex flex-wrap justify-center items-center gap-8">
                <div class="flex items-center gap-2 text-gray-300 text-sm">
                    <i data-lucide="shield-check" class="w-5 h-5 text-green-400"></i>
                    Secure Payment
                </div>
                <div class="flex items-center gap-2 text-gray-300 text-sm">
                    <i data-lucide="credit-card" class="w-5 h-5 text-teal-400"></i>
                    Powered by Stripe
                </div>
                <div class="flex items-center gap-2 text-gray-300 text-sm">
                    <i data-lucide="refresh-cw" class="w-5 h-5 text-[#217c71]"></i>
                    Cancel Anytime
                </div>
                <div class="flex items-center gap-2 text-gray-300 text-sm">
                    <i data-lucide="mail" class="w-5 h-5 text-pink-400"></i>
                    24/7 Support
                </div>
                <div class="flex items-center gap-2 text-gray-300 text-sm">
                    <i data-lucide="key" class="w-5 h-5 text-green-400"></i>
                    Bring Your Own Key
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-24 border-t border-white/5">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <h2 class="text-3xl font-bold mb-4">Frequently Asked Questions</h2>
            <p class="text-gray-400">Everything you need to know about the pricing.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="glass rounded-2xl p-6 reveal">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-5 h-5 text-teal-400"></i>
                    What's included in all plans?
                </h4>
                <p class="text-gray-400 text-sm pl-7">All plans include unlimited AI processing, access to all AI models
                    (GPT-4o, Gemini, etc.), background job processing, pause & resume capability, and priority support.
                </p>
            </div>

            <div class="glass rounded-2xl p-6 reveal" style="animation-delay: 0.1s;">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-5 h-5 text-teal-400"></i>
                    Can I upgrade or change my plan later?
                </h4>
                <p class="text-gray-400 text-sm pl-7">Yes! You can upgrade to a longer duration plan anytime. Your
                    remaining time will be prorated towards the new plan.</p>
            </div>

            <div class="glass rounded-2xl p-6 reveal" style="animation-delay: 0.2s;">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-5 h-5 text-teal-400"></i>
                    Is there a free trial?
                </h4>
                <p class="text-gray-400 text-sm pl-7">Yes! New users get a free trial to test all features before
                    committing to a paid plan.</p>
            </div>

            <div class="glass rounded-2xl p-6 reveal" style="animation-delay: 0.3s;">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-5 h-5 text-teal-400"></i>
                    What payment methods do you accept?
                </h4>
                <p class="text-gray-400 text-sm pl-7">We accept all major credit cards (Visa, Mastercard, American
                    Express) and payment is processed securely via Stripe.</p>
            </div>

            <div class="glass rounded-2xl p-6 reveal" style="animation-delay: 0.4s;">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-5 h-5 text-teal-400"></i>
                    What about AI API costs?
                </h4>
                <p class="text-gray-400 text-sm pl-7">This add-on uses a <strong class="text-white">Bring Your Own Key
                        (BYOK)</strong> model.
                    You provide your own API key from OpenAI, Google AI, or other providers. AI usage costs are billed
                    directly
                    by your provider — we never see or store your keys. Your keys stay securely in your Google Apps
                    Script properties.</p>
            </div>
        </div>
    </div>
</section>

<script>
    async function buy(plan, priceId) {
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