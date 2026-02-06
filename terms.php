<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Load config for site branding
require_once __DIR__ . '/src/config.php';

include __DIR__ . '/src/includes/header.php';
?>

<!-- Terms of Service Section -->
<section class="py-16 lg:py-24 relative">
    <!-- Background effects -->
    <div class="absolute top-20 right-10 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-64 h-64 bg-[#217c71]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12 reveal">
                <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                    <i data-lucide="file-text" class="w-4 h-4 inline mr-1"></i>
                    Legal
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Terms of <span class="gradient-text">Service</span>
                </h1>
                <p class="text-gray-400">Last updated:
                    <?php echo date('F d, Y'); ?>
                </p>
            </div>

            <!-- Content -->
            <div class="glass rounded-3xl p-8 md:p-12 reveal space-y-8">
                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="scroll" class="w-6 h-6 text-teal-400"></i>
                        Agreement to Terms
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        By accessing or using <?php echo $APP_NAME; ?>, you agree to be bound by these Terms of Service.
                        If
                        you disagree with any part of these terms, you may not access the service.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="key" class="w-6 h-6 text-teal-400"></i>
                        License and Access
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        Subject to these Terms, we grant you a limited, non-exclusive, non-transferable license to:
                    </p>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Access and use the service for personal or business purposes
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Use AI features to process your spreadsheet data
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Access your account and subscription features
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="user" class="w-6 h-6 text-teal-400"></i>
                        User Responsibilities
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4">You agree to:</p>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Provide accurate account information</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Maintain the security of your account credentials</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Not use the service for any unlawful purpose</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Not attempt to reverse engineer or exploit the service</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>Comply with all applicable laws and regulations</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="credit-card" class="w-6 h-6 text-teal-400"></i>
                        Payments and Subscriptions
                    </h2>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>All payments are processed securely through Stripe</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>Prices are displayed in USD and include all applicable fees</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>Subscriptions provide access for the purchased duration</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>Lifetime plans provide perpetual access to the service</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="brain" class="w-6 h-6 text-teal-400"></i>
                        AI Processing
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        Our service uses third-party AI providers (OpenAI, Google, etc.) to process your data. While we
                        strive to provide accurate results, AI outputs may contain errors. You are responsible for
                        reviewing and verifying all AI-generated content before use.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-teal-400"></i>
                        Limitation of Liability
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        To the maximum extent permitted by law, <?php echo $COMPANY_NAME; ?> shall not be liable for any
                        indirect,
                        incidental, special, consequential, or punitive damages, or any loss of profits or revenues,
                        whether incurred directly or indirectly.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="refresh-cw" class="w-6 h-6 text-teal-400"></i>
                        Changes to Terms
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        We reserve the right to modify these terms at any time. We will notify users of significant
                        changes via email or through the service. Continued use after changes constitutes acceptance of
                        the new terms.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="mail" class="w-6 h-6 text-teal-400"></i>
                        Contact
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        For questions about these Terms, contact us at <a href="mailto:<?php echo $SUPPORT_EMAIL; ?>"
                            class="text-teal-400 hover:text-teal-300 transition-colors"><?php echo $SUPPORT_EMAIL; ?></a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>