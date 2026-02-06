<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Load config for site branding
require_once __DIR__ . '/src/config.php';

include __DIR__ . '/src/includes/header.php';
?>

<!-- Refund Policy Section -->
<section class="py-16 lg:py-24 relative">
    <!-- Background effects -->
    <div class="absolute top-20 left-20 w-72 h-72 bg-[#217c71]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-20 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12 reveal">
                <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                    <i data-lucide="rotate-ccw" class="w-4 h-4 inline mr-1"></i>
                    Legal
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Refund <span class="gradient-text">Policy</span>
                </h1>
                <p class="text-gray-400">Last updated:
                    <?php echo date('F d, Y'); ?>
                </p>
            </div>

            <!-- Highlight Banner -->
            <div class="glass rounded-2xl p-6 mb-8 border border-teal-500/30 reveal">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-teal-500/20 to-[#217c71]/20 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="badge-check" class="w-8 h-8 text-teal-400"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-1">30-Day Money-Back Guarantee</h2>
                        <p class="text-gray-300">No questions asked. If you're not satisfied, we'll refund your
                            purchase.</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="glass rounded-3xl p-8 md:p-12 reveal space-y-8">
                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="heart" class="w-6 h-6 text-teal-400"></i>
                        Our Promise
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        We want you to be completely satisfied with <?php echo $APP_NAME; ?>. If for any reason you're
                        not
                        happy with your purchase, we offer a hassle-free refund policy.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="clock" class="w-6 h-6 text-teal-400"></i>
                        30-Day Refund Window
                    </h2>
                    <div class="space-y-4 text-gray-300">
                        <p class="leading-relaxed">
                            You may request a full refund within <strong class="text-white">30 days</strong> of your
                            purchase date. This applies to all plans:
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="check" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <span><strong class="text-white">6-Month Plan</strong> — Full refund within 30
                                    days</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="check" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <span><strong class="text-white">1-Year Plan</strong> — Full refund within 30
                                    days</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="check" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <span><strong class="text-white">Lifetime Plan</strong> — Full refund within 30
                                    days</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="list-checks" class="w-6 h-6 text-teal-400"></i>
                        How to Request a Refund
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-600/20 to-[#217c71]/20 border border-teal-500/30 flex items-center justify-center flex-shrink-0">
                                <span class="font-bold gradient-text">1</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Contact Support</h3>
                                <p class="text-gray-400 text-sm">Email us at <a
                                        href="mailto:<?php echo $SUPPORT_EMAIL; ?>"
                                        class="text-teal-400 hover:text-teal-300 transition-colors"><?php echo $SUPPORT_EMAIL; ?></a>
                                    with your request.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#217c71]/20 to-[#1a625a]/20 border border-[#217c71]/30 flex items-center justify-center flex-shrink-0">
                                <span class="font-bold gradient-text">2</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Provide Order Details</h3>
                                <p class="text-gray-400 text-sm">Include your email address associated with the
                                    purchase.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#34af9e]/20 to-teal-700/20 border border-[#34af9e]/30 flex items-center justify-center flex-shrink-0">
                                <span class="font-bold gradient-text">3</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Receive Your Refund</h3>
                                <p class="text-gray-400 text-sm">We'll process your refund within 5-10 business days to
                                    your original payment method.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-6 h-6 text-teal-400"></i>
                        Important Notes
                    </h2>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Refunds are processed to the original payment method</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Processing time may vary depending on your bank or card issuer</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Your access will be revoked once the refund is processed</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>You may re-purchase at any time after a refund</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="help-circle" class="w-6 h-6 text-teal-400"></i>
                        Questions?
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        If you have any questions about our refund policy, please don't hesitate to reach out at <a
                            href="mailto:<?php echo $SUPPORT_EMAIL; ?>"
                            class="text-teal-400 hover:text-teal-300 transition-colors"><?php echo $SUPPORT_EMAIL; ?></a>.
                        We're
                        here to help!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>