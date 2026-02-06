<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Load config for site branding
require_once __DIR__ . '/src/config.php';

include __DIR__ . '/src/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative py-24 lg:py-32 overflow-hidden">
    <!-- Floating orbs -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-teal-500/20 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#217c71]/20 rounded-full blur-3xl animate-float"
        style="animation-delay: -3s;"></div>
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#34af9e]/10 rounded-full blur-3xl">
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full mb-8 animate-fade-up">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-sm text-gray-300">Powered by GPT-5, Gemini 3 & more</span>
            </div>

            <!-- Headline -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight animate-fade-up"
                style="animation-delay: 0.1s;">
                Supercharge Google Sheets
                <span class="block gradient-text">with AI</span>
            </h1>

            <!-- Subheadline -->
            <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed animate-fade-up"
                style="animation-delay: 0.2s;">
                Process thousands of rows instantly. Summarize, translate, and extract data using AI — without leaving
                your spreadsheet.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16 animate-fade-up"
                style="animation-delay: 0.3s;">
                <?php if (!isset($_SESSION['user'])): ?>
                    <a href="login"
                        class="group px-8 py-4 bg-[#217c71] hover:bg-[#1a625a] rounded-2xl font-bold text-lg shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow flex items-center justify-center gap-2">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                        Get Started Free
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="pricing"
                        class="px-8 py-4 glass hover:bg-white/10 rounded-2xl font-semibold text-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        View Pricing
                    </a>
                <?php else: ?>
                    <a href="dashboard"
                        class="group px-8 py-4 bg-[#217c71] hover:bg-[#1a625a] rounded-2xl font-bold text-lg shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow flex items-center justify-center gap-2">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        Go to Dashboard
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 max-w-lg mx-auto animate-fade-up" style="animation-delay: 0.4s;">
                <div class="text-center">
                    <div class="text-3xl font-bold gradient-text">1000+</div>
                    <div class="text-sm text-gray-400">Active Users</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold gradient-text">10M+</div>
                    <div class="text-sm text-gray-400">Rows Processed</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold gradient-text">99.9%</div>
                    <div class="text-sm text-gray-400">Uptime</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="py-12 border-y border-white/5">
    <div class="container mx-auto px-6">
        <p class="text-center text-gray-500 text-sm uppercase tracking-wider mb-8">Trusted by teams at</p>
        <div class="flex flex-wrap justify-center items-center gap-12 opacity-50">
            <span class="text-2xl font-bold text-gray-400">Startup</span>
            <span class="text-2xl font-bold text-gray-400">TechCorp</span>
            <span class="text-2xl font-bold text-gray-400">DataFlow</span>
            <span class="text-2xl font-bold text-gray-400">CloudBase</span>
            <span class="text-2xl font-bold text-gray-400">AI Labs</span>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-24 lg:py-32">
    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-20 reveal">
            <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                <i data-lucide="sparkles" class="w-4 h-4 inline mr-1"></i>
                Features
            </span>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Everything you need for
                <span class="gradient-text">AI-powered spreadsheets</span>
            </h2>
            <p class="text-xl text-gray-400">
                Powerful automation tools designed for efficiency, built for scale.
            </p>
        </div>

        <!-- Feature Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Feature 1: AI-Powered Automation -->
            <div class="group glass rounded-3xl p-8 card-hover reveal">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="rocket" class="w-7 h-7 text-indigo-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">AI-Powered Automation</h3>
                <p class="text-gray-400 mb-4">Run AI on hundreds of rows in one click. Choose from GPT-5,
                    Gemini 3, and more models.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Bulk AI Processing
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Multiple AI Models
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Smart Batch Processing
                    </li>
                </ul>
            </div>

            <!-- Feature 2: Seamless Integration -->
            <div class="group glass rounded-3xl p-8 card-hover reveal" style="animation-delay: 0.1s;">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="table-2" class="w-7 h-7 text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Seamless Spreadsheet Integration</h3>
                <p class="text-gray-400 mb-4">Use column variables like {A}, {B} in your prompts. Auto-detect headers
                    and output columns.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Column Variables
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Header Detection
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Flexible Output
                    </li>
                </ul>
            </div>

            <!-- Feature 3: Productivity -->
            <div class="group glass rounded-3xl p-8 card-hover reveal" style="animation-delay: 0.2s;">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="zap" class="w-7 h-7 text-yellow-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Productivity Features</h3>
                <p class="text-gray-400 mb-4">Append or replace data, skip existing results, see exactly how many rows
                    will be processed.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Append or Replace Mode
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Live Row Count
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Smart Filtering
                    </li>
                </ul>
            </div>

            <!-- Feature 4: Job Management -->
            <div class="group glass rounded-3xl p-8 card-hover reveal">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="bar-chart-3" class="w-7 h-7 text-pink-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Job Management</h3>
                <p class="text-gray-400 mb-4">Jobs run in background while you work. Pause and resume anytime with
                    real-time progress tracking.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Background Processing
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Pause & Resume
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Job History
                    </li>
                </ul>
            </div>

            <!-- Feature 5: Built for Scale -->
            <div class="group glass rounded-3xl p-8 card-hover reveal" style="animation-delay: 0.1s;">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="shield-check" class="w-7 h-7 text-cyan-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Built for Scale</h3>
                <p class="text-gray-400 mb-4">Process thousands of rows efficiently. Optimized for Google Sheets quota
                    limits with graceful error handling.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        No Row Limits
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Smart Batching
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Error Recovery
                    </li>
                </ul>
            </div>

            <!-- Feature 6: AI Models -->
            <div class="group glass rounded-3xl p-8 card-hover reveal" style="animation-delay: 0.2s;">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="brain" class="w-7 h-7 text-orange-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Multiple AI Models</h3>
                <p class="text-gray-400 mb-4">Choose the perfect model for your task. From GPT-5 for quality to Gemini
                    Flash for speed.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        GPT-5
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Gemini 3
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        And Many More
                    </li>
                </ul>
            </div>

            <!-- Feature 7: Privacy-First BYOK -->
            <div class="group glass rounded-3xl p-8 card-hover reveal" style="animation-delay: 0.3s;">
                <div
                    class="w-14 h-14 feature-icon rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="key" class="w-7 h-7 text-green-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Bring Your Own Key</h3>
                <p class="text-gray-400 mb-4">Use your own API keys stored securely in your Google account. We never see
                    or store your credentials.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Your Keys, Your Control
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Direct API Calls
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Zero Data Middleman
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-24 lg:py-32 border-y border-white/5">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-20 reveal">
            <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                <i data-lucide="git-branch" class="w-4 h-4 inline mr-1"></i>
                How It Works
            </span>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Three simple steps to
                <span class="gradient-text">automate everything</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Step 1 -->
            <div class="text-center reveal">
                <div
                    class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-teal-600/20 to-[#217c71]/20 border border-teal-500/30 flex items-center justify-center">
                    <span class="text-3xl font-bold gradient-text">1</span>
                </div>
                <h3 class="text-xl font-bold mb-3">Write Your Prompt</h3>
                <p class="text-gray-400">Use column variables like {A}, {B} to reference your data. Create the perfect
                    AI instruction for your task.</p>
            </div>

            <!-- Step 2 -->
            <div class="text-center reveal" style="animation-delay: 0.1s;">
                <div
                    class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[#217c71]/20 to-[#1a625a]/20 border border-[#217c71]/30 flex items-center justify-center">
                    <span class="text-3xl font-bold gradient-text">2</span>
                </div>
                <h3 class="text-xl font-bold mb-3">Select Your Rows</h3>
                <p class="text-gray-400">Test on a few rows first, then process all. Choose which columns to read and
                    where to write results.</p>
            </div>

            <!-- Step 3 -->
            <div class="text-center reveal" style="animation-delay: 0.2s;">
                <div
                    class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[#34af9e]/20 to-teal-700/20 border border-[#34af9e]/30 flex items-center justify-center">
                    <span class="text-3xl font-bold gradient-text">3</span>
                </div>
                <h3 class="text-xl font-bold mb-3">Run & Relax</h3>
                <p class="text-gray-400">Hit run and let AI do the work. Monitor progress in real-time, pause anytime,
                    and continue working.</p>
            </div>
        </div>
    </div>
</section>

<!-- Use Cases Section -->
<section id="use-cases" class="py-24 lg:py-32">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-20 reveal">
            <span class="inline-block px-4 py-2 glass rounded-full text-sm text-teal-300 mb-4">
                <i data-lucide="lightbulb" class="w-4 h-4 inline mr-1"></i>
                Use Cases
            </span>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Endless possibilities with
                <span class="gradient-text">AI automation</span>
            </h2>
            <p class="text-xl text-gray-400">
                See what you can accomplish with <?php echo $APP_NAME; ?>.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <!-- Use Case 1 -->
            <div class="glass rounded-2xl p-6 card-hover reveal group">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-cyan-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="file-text" class="w-6 h-6 text-blue-400"></i>
                </div>
                <h3 class="font-bold mb-2">Product Descriptions</h3>
                <p class="text-gray-400 text-sm">Generate compelling product descriptions from keywords and
                    specifications.</p>
            </div>

            <!-- Use Case 2 -->
            <div class="glass rounded-2xl p-6 card-hover reveal group" style="animation-delay: 0.05s;">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="languages" class="w-6 h-6 text-green-400"></i>
                </div>
                <h3 class="font-bold mb-2">Content Translation</h3>
                <p class="text-gray-400 text-sm">Translate content across columns into any language instantly.</p>
            </div>

            <!-- Use Case 3 -->
            <div class="glass rounded-2xl p-6 card-hover reveal group" style="animation-delay: 0.1s;">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500/20 to-orange-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="file-search" class="w-6 h-6 text-yellow-400"></i>
                </div>
                <h3 class="font-bold mb-2">Text Summarization</h3>
                <p class="text-gray-400 text-sm">Summarize long text into concise snippets for quick insights.</p>
            </div>

            <!-- Use Case 4 -->
            <div class="glass rounded-2xl p-6 card-hover reveal group" style="animation-delay: 0.15s;">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-violet-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="tags" class="w-6 h-6 text-purple-400"></i>
                </div>
                <h3 class="font-bold mb-2">Data Categorization</h3>
                <p class="text-gray-400 text-sm">Categorize or tag data automatically based on content analysis.</p>
            </div>

            <!-- Use Case 5 -->
            <div class="glass rounded-2xl p-6 card-hover reveal group" style="animation-delay: 0.2s;">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500/20 to-rose-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="scan-search" class="w-6 h-6 text-pink-400"></i>
                </div>
                <h3 class="font-bold mb-2">Insight Extraction</h3>
                <p class="text-gray-400 text-sm">Extract structured insights from unstructured text data.</p>
            </div>

            <!-- Use Case 6 -->
            <div class="glass rounded-2xl p-6 card-hover reveal group" style="animation-delay: 0.25s;">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500/20 to-orange-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="mail" class="w-6 h-6 text-red-400"></i>
                </div>
                <h3 class="font-bold mb-2">Email Personalization</h3>
                <p class="text-gray-400 text-sm">Create personalized email copy at scale from your data.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 lg:py-32">
    <div class="container mx-auto px-6">
        <div class="relative max-w-4xl mx-auto reveal">
            <!-- Background glow -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-teal-600/20 via-[#217c71]/20 to-[#1a625a]/20 rounded-3xl blur-3xl">
            </div>

            <!-- Card -->
            <div class="relative glass rounded-3xl p-12 md:p-16 text-center glow">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Ready to transform your
                    <span class="gradient-text">spreadsheet workflow?</span>
                </h2>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                    Join thousands of users who are automating their spreadsheets with AI. Get started in minutes.
                </p>

                <?php if (!isset($_SESSION['user'])): ?>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="login"
                            class="group px-10 py-5 bg-[#217c71] hover:bg-[#1a625a] rounded-2xl font-bold text-lg shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow flex items-center justify-center gap-2">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                            Start Free Trial
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="pricing"
                            class="px-10 py-5 glass hover:bg-white/10 rounded-2xl font-semibold text-lg transition-all duration-300 flex items-center justify-center gap-2">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                            View Pricing
                        </a>
                    </div>
                <?php else: ?>
                    <a href="dashboard"
                        class="group inline-flex items-center gap-2 px-10 py-5 bg-[#217c71] hover:bg-[#1a625a] rounded-2xl font-bold text-lg shadow-2xl shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 btn-glow">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        Go to Dashboard
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                <?php endif; ?>

                <p class="mt-8 text-gray-400 text-sm">
                    <i data-lucide="check-circle-2" class="w-4 h-4 inline text-green-400"></i>
                    No credit card required
                    <span class="mx-2">•</span>
                    <i data-lucide="check-circle-2" class="w-4 h-4 inline text-green-400"></i>
                    Cancel anytime
                </p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>