<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Load config for site branding
require_once __DIR__ . '/src/config.php';

include __DIR__ . '/src/includes/header.php';
?>

<!-- Privacy Policy Section -->
<section class="py-16 lg:py-24 relative">
    <!-- Background effects -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-64 h-64 bg-[#217c71]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12 reveal">
                <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                    <i data-lucide="shield" class="w-4 h-4 inline mr-1"></i>
                    Legal
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Privacy <span class="gradient-text">Policy</span>
                </h1>
                <p class="text-gray-400">Last updated:
                    <?php echo date('F d, Y'); ?>
                </p>
            </div>

            <!-- Content -->
            <div class="glass rounded-3xl p-8 md:p-12 reveal space-y-8">
                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-6 h-6 text-teal-400"></i>
                        Introduction
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        <?php echo $COMPANY_NAME; ?> ("we," "our," or "us") is committed to protecting your privacy.
                        This Privacy
                        Policy explains how we collect, use, disclose, and safeguard your information when you use our
                        Google Sheets add-on and website.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="database" class="w-6 h-6 text-teal-400"></i>
                        Information We Collect
                    </h2>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Account Information:</strong> Email address and name when you sign in with
                                Google.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Usage Data:</strong> Information about how you use our service, including job
                                history and feature usage.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Payment Information:</strong> Processed securely through Stripe. We do not
                                store credit card details.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="lock" class="w-6 h-6 text-teal-400"></i>
                        How We Use Your Information
                    </h2>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>To provide and maintain our service</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>To process your transactions and send related information</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>To send you technical notices and support messages</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span>To improve and personalize your experience</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="share-2" class="w-6 h-6 text-teal-400"></i>
                        Data Sharing
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        We do not sell, trade, or rent your personal information. We may share data with third-party
                        service providers (like Stripe for payments and AI providers for processing) solely to provide
                        our services. All third parties are bound by confidentiality agreements.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-6 h-6 text-teal-400"></i>
                        Data Security
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        We implement industry-standard security measures to protect your data. All data is transmitted
                        over HTTPS and stored securely. However, no method of transmission over the Internet is 100%
                        secure.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="key" class="w-6 h-6 text-teal-400"></i>
                        Bring Your Own API Key (BYOK)
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        <?php echo $APP_NAME; ?> operates on a <strong class="text-white">Bring Your Own Key</strong>
                        model.
                        You provide your own API keys from providers like OpenAI, Google AI, or OpenRouter to access
                        AI services directly.
                    </p>
                    <ul class="space-y-3 text-gray-300 mb-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Your keys, your control:</strong> API keys are stored locally in your Google
                                Apps Script properties — we never have access to them</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Direct API calls:</strong> Your spreadsheet communicates directly with your
                                chosen AI provider — data doesn't pass through our servers</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>No API key storage on our end:</strong> We cannot see, access, or retrieve
                                your API keys at any time</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>You manage billing:</strong> AI usage costs are billed directly by your AI
                                provider to your account</span>
                        </li>
                    </ul>
                    <p class="text-gray-400 text-sm">
                        <i data-lucide="info" class="w-4 h-4 inline mr-1"></i>
                        Google Apps Script properties provide secure, encrypted storage that only you can access
                        through your Google account.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="sparkles" class="w-6 h-6 text-teal-400"></i>
                        Google API Services User Data Policy
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        <?php echo $APP_NAME; ?>'s use and transfer of information received from Google APIs adheres to
                        the
                        <a href="https://developers.google.com/terms/api-services-user-data-policy" target="_blank"
                            rel="noopener" class="text-teal-400 hover:text-teal-300 transition-colors">Google API
                            Services User Data Policy</a>,
                        including the Limited Use requirements.
                    </p>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>We only access Google Sheets data necessary to perform the AI processing you
                                request</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>We do not use Google user data for advertising purposes</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>We do not sell Google user data to third parties</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0"></i>
                            <span>Data is only transferred to AI providers as necessary to fulfill your requests</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="brain" class="w-6 h-6 text-teal-400"></i>
                        Third-Party AI Providers
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        To provide AI-powered processing, we use the following third-party AI services:
                    </p>
                    <ul class="space-y-3 text-gray-300 mb-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>OpenAI</strong> (GPT-5) - For text generation and analysis</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Google AI</strong> (Gemini 3) - For text generation and
                                analysis</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="arrow-right" class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0"></i>
                            <span><strong>Other AI providers</strong> - As made available through the service</span>
                        </li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Your spreadsheet data is sent to these providers only when you initiate an AI processing job.
                        Each provider has their own privacy policy and data handling practices. We recommend reviewing
                        their respective policies.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="clock" class="w-6 h-6 text-teal-400"></i>
                        Data Retention
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        We retain your account information for as long as your account is active. Job history and usage
                        data is retained for up to 90 days. You may request deletion of your data at any time by
                        contacting
                        us at <?php echo $SUPPORT_EMAIL; ?>.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="user-check" class="w-6 h-6 text-teal-400"></i>
                        Your Rights
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        You have the right to:
                    </p>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Access your personal data
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Request correction of inaccurate data
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Request deletion of your data
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                            Withdraw consent at any time
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="mail" class="w-6 h-6 text-teal-400"></i>
                        Contact Us
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        If you have questions about this Privacy Policy, please contact us at <a
                            href="mailto:<?php echo $SUPPORT_EMAIL; ?>"
                            class="text-teal-400 hover:text-teal-300 transition-colors"><?php echo $SUPPORT_EMAIL; ?></a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>