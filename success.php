<?php
require_once __DIR__ . '/src/bootstrap.php';

$planName = 'Subscription';

if (isset($_GET['session_id'])) {
    try {
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);
        if (isset($session->metadata->plan)) {
            $planName = ucfirst($session->metadata->plan);
        }
    } catch (Exception $e) {
        // Ignore Stripe errors here, just show generic success
    }
}

include __DIR__ . '/src/includes/header.php';
?>

<!-- Success Page -->
<section class="min-h-[70vh] flex items-center justify-center relative py-16">
    <!-- Background effects -->
    <div class="absolute top-20 left-20 w-72 h-72 bg-green-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-20 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-md mx-auto text-center">
            <div class="glass rounded-3xl p-8 md:p-12 reveal">
                <!-- Success Icon -->
                <div
                    class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-green-500/20 to-emerald-500/20 border border-green-500/30 flex items-center justify-center">
                    <i data-lucide="check-circle-2" class="w-10 h-10 text-green-400"></i>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold mb-2">Payment Successful!</h1>
                <p class="text-gray-400 mb-8">
                    Your <strong class="text-white"><?php echo htmlspecialchars($planName); ?></strong> plan is now
                    active.
                </p>

                <!-- Confirmation Details -->
                <div class="glass rounded-xl p-4 mb-8 text-left">
                    <div class="flex items-center gap-3 text-sm text-gray-300">
                        <i data-lucide="mail" class="w-4 h-4 text-teal-400"></i>
                        <span>Confirmation email sent to your inbox</span>
                    </div>
                </div>

                <!-- CTA Button -->
                <a href="dashboard"
                    class="w-full py-4 px-6 bg-[#217c71] hover:bg-[#1a625a] text-white rounded-xl font-bold shadow-lg shadow-teal-500/25 transition-all flex items-center justify-center gap-2 btn-glow">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Go to Dashboard
                </a>

                <!-- Secondary Action -->
                <p class="mt-6 text-sm text-gray-500">
                    Need help? <a href="mailto:<?php echo $SUPPORT_EMAIL; ?>"
                        class="text-teal-400 hover:text-teal-300">Contact support</a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>