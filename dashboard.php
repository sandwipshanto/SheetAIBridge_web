<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

// Protection
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Fetch Data
require_once __DIR__ . '/src/services/SupabaseService.php';
$service = new \App\Services\SupabaseService();
$subData = $service->getSubscription($_SESSION['user']['email']);

// Defaults
$plan = $subData['plan'] ?? 'trial';
$status = $subData['status'] ?? 'inactive';
$stripeCustomerId = $subData['stripe_customer_id'] ?? null;
$validUntil = $subData['valid_until'] ?? null;

// Load config for site branding
require_once __DIR__ . '/src/config.php';

include __DIR__ . '/src/includes/header.php';
?>

<!-- Dashboard Section -->
<section class="py-16 lg:py-24 relative">
    <!-- Background effects -->
    <div class="absolute top-20 right-20 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-20 w-64 h-64 bg-[#217c71]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- User Header -->
        <div class="flex items-center gap-6 mb-12 reveal">
            <?php if (isset($_SESSION['user']['picture'])): ?>
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($_SESSION['user']['picture']); ?>"
                        class="w-20 h-20 rounded-2xl border-2 border-white/10 shadow-lg">
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-gray-900">
                    </div>
                </div>
            <?php endif; ?>
            <div>
                <h1 class="text-3xl font-bold mb-1">Welcome back,
                    <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
                </h1>
                <p class="text-gray-400 flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    <?php echo htmlspecialchars($_SESSION['user']['email']); ?>
                </p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Subscription Card -->
            <div class="lg:col-span-2 glass rounded-3xl p-8 reveal">
                <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500/20 to-[#217c71]/20 flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-5 h-5 text-teal-400"></i>
                    </div>
                    Subscription
                </h2>

                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <!-- Plan -->
                    <div class="glass rounded-2xl p-5">
                        <div class="text-sm text-gray-400 mb-2">Current Plan</div>
                        <div class="text-2xl font-bold capitalize gradient-text"><?php echo htmlspecialchars($plan); ?>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="glass rounded-2xl p-5">
                        <div class="text-sm text-gray-400 mb-2">Status</div>
                        <div class="flex items-center gap-2">
                            <?php if ($status === 'active'): ?>
                                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                <span class="text-xl font-bold text-green-400">Active</span>
                            <?php else: ?>
                                <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                                <span
                                    class="text-xl font-bold text-yellow-400 capitalize"><?php echo htmlspecialchars($status); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($validUntil): ?>
                        <!-- Valid Until -->
                        <div class="glass rounded-2xl p-5 md:col-span-2">
                            <div class="text-sm text-gray-400 mb-2">Valid Until</div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-5 h-5 text-teal-400"></i>
                                <span class="text-xl font-bold"><?php echo date('F d, Y', strtotime($validUntil)); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4">
                    <?php if ($plan === 'trial'): ?>
                        <a href="pricing"
                            class="px-6 py-3 bg-[#217c71] hover:bg-[#1a625a] rounded-xl font-semibold shadow-lg shadow-teal-500/25 transition-all flex items-center gap-2 btn-glow">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                            Upgrade Plan
                        </a>
                    <?php elseif ($stripeCustomerId): ?>
                        <form action="api/create-portal.php" method="POST" target="_blank">
                            <input type="hidden" name="customer_id"
                                value="<?php echo htmlspecialchars($stripeCustomerId); ?>">
                            <button type="submit"
                                class="px-6 py-3 glass hover:bg-white/10 rounded-xl font-semibold transition-all flex items-center gap-2">
                                <i data-lucide="settings" class="w-5 h-5"></i>
                                Manage Billing
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-6 reveal" style="animation-delay: 0.1s;">
                <!-- Getting Started Card -->
                <div class="glass rounded-3xl p-6">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="rocket" class="w-5 h-5 text-pink-400"></i>
                        Getting Started
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-3 text-gray-300">
                            <div class="w-6 h-6 rounded-lg bg-green-500/20 flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            </div>
                            Install the add-on
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <div class="w-6 h-6 rounded-lg bg-green-500/20 flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            </div>
                            Sign in with Google
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <div class="w-6 h-6 rounded-lg bg-teal-500/20 flex items-center justify-center">
                                <span class="text-xs font-bold text-teal-400">3</span>
                            </div>
                            Run your first AI job
                        </li>
                    </ul>
                </div>

                <!-- Support Card -->
                <div class="glass rounded-3xl p-6">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="headphones" class="w-5 h-5 text-cyan-400"></i>
                        Need Help?
                    </h3>
                    <p class="text-sm text-gray-400 mb-4">
                        Our support team is here to help you get the most out of <?php echo $APP_SHORT_NAME; ?>.
                    </p>
                    <a href="#"
                        class="text-teal-400 hover:text-teal-300 text-sm font-medium flex items-center gap-1 transition-colors">
                        Contact Support
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>