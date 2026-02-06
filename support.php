<?php
require_once __DIR__ . '/src/bootstrap.php';
include __DIR__ . '/src/includes/header.php';
?>

<!-- Support Page -->
<section class="min-h-screen py-16 relative">
    <!-- Background effects -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-64 h-64 bg-[#217c71]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                How Can We <span class="gradient-text">Help You?</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                We're here to assist you. Choose a category below and send us an email – we typically respond within 24
                hours.
            </p>
        </div>

        <!-- Support Categories Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-12 max-w-5xl mx-auto">
            <!-- General Queries -->
            <div class="glass rounded-2xl p-8 card-hover reveal" style="animation-delay: 0.1s;">
                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-teal-500 via-teal-600 to-teal-700 flex items-center justify-center mb-6 shadow-lg shadow-teal-500/30">
                    <i data-lucide="help-circle" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">General Queries</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Have questions about features, pricing, or how to get started? We're here to help.
                </p>
                <a href="mailto:<?php echo $SUPPORT_EMAIL; ?>?subject=General%20Query"
                    class="inline-flex items-center gap-2 text-teal-400 hover:text-teal-300 font-semibold transition-colors group">
                    <span>Send Email</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Bug Reports -->
            <div class="glass rounded-2xl p-8 card-hover reveal" style="animation-delay: 0.2s;">
                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 via-red-600 to-red-700 flex items-center justify-center mb-6 shadow-lg shadow-red-500/30">
                    <i data-lucide="bug" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Report a Bug</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Found an issue? Let us know so we can fix it and improve your experience.
                </p>
                <a href="mailto:<?php echo $SUPPORT_EMAIL; ?>?subject=Bug%20Report"
                    class="inline-flex items-center gap-2 text-teal-400 hover:text-teal-300 font-semibold transition-colors group">
                    <span>Report Bug</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Refund Requests -->
            <div class="glass rounded-2xl p-8 card-hover reveal" style="animation-delay: 0.3s;">
                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
                    <i data-lucide="credit-card" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Refund Request</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Need a refund? Review our refund policy and reach out to us with your request.
                </p>
                <a href="mailto:<?php echo $SUPPORT_EMAIL; ?>?subject=Refund%20Request"
                    class="inline-flex items-center gap-2 text-teal-400 hover:text-teal-300 font-semibold transition-colors group">
                    <span>Request Refund</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Direct Contact Section -->
        <div class="max-w-3xl mx-auto glass rounded-3xl p-8 md:p-12 reveal" style="animation-delay: 0.4s;">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-shrink-0">
                    <div
                        class="w-20 h-20 rounded-2xl bg-gradient-to-br from-teal-500 via-teal-600 to-teal-700 flex items-center justify-center shadow-lg shadow-teal-500/30">
                        <i data-lucide="mail" class="w-10 h-10 text-white"></i>
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-2xl font-bold mb-2">Direct Email Support</h3>
                    <p class="text-gray-400 mb-4">
                        Prefer to write your own email? Send us a message at:
                    </p>
                    <a href="mailto:<?php echo $SUPPORT_EMAIL; ?>"
                        class="text-xl font-semibold text-teal-400 hover:text-teal-300 transition-colors inline-flex items-center gap-2 group">
                        <span>
                            <?php echo $SUPPORT_EMAIL; ?>
                        </span>
                        <i data-lucide="external-link"
                            class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Resources -->
        <div class="mt-16 text-center reveal" style="animation-delay: 0.5s;">
            <h3 class="text-2xl font-bold mb-8">More Resources</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="refund"
                    class="px-6 py-3 glass rounded-xl hover:bg-white/10 transition-all font-medium inline-flex items-center gap-2 group">
                    <i data-lucide="shield-check" class="w-5 h-5 text-teal-400"></i>
                    <span>Refund Policy</span>
                </a>
                <a href="terms"
                    class="px-6 py-3 glass rounded-xl hover:bg-white/10 transition-all font-medium inline-flex items-center gap-2 group">
                    <i data-lucide="file-text" class="w-5 h-5 text-teal-400"></i>
                    <span>Terms of Service</span>
                </a>
                <a href="privacy"
                    class="px-6 py-3 glass rounded-xl hover:bg-white/10 transition-all font-medium inline-flex items-center gap-2 group">
                    <i data-lucide="lock" class="w-5 h-5 text-teal-400"></i>
                    <span>Privacy Policy</span>
                </a>
            </div>
        </div>

        <!-- FAQ Teaser (Optional) -->
        <div class="mt-16 max-w-3xl mx-auto reveal" style="animation-delay: 0.6s;">
            <div class="glass rounded-2xl p-8 text-center">
                <i data-lucide="lightbulb" class="w-12 h-12 text-teal-400 mx-auto mb-4"></i>
                <h3 class="text-xl font-bold mb-3">Quick Tip</h3>
                <p class="text-gray-400 leading-relaxed">
                    When reporting a bug, please include details like what you were doing, what happened, and any error
                    messages you saw. This helps us resolve issues faster!
                </p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>