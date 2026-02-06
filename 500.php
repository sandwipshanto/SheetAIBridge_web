<?php
require_once __DIR__ . '/src/bootstrap.php';
include __DIR__ . '/src/includes/header.php';
?>

<!-- 500 Error Page -->
<section class="min-h-[70vh] flex items-center justify-center relative py-16">
    <!-- Background effects -->
    <div class="absolute top-20 left-20 w-72 h-72 bg-red-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-20 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        <div class="reveal">
            <div
                class="w-24 h-24 mx-auto mb-8 rounded-3xl bg-gradient-to-br from-red-500/20 to-orange-500/20 border border-red-500/30 flex items-center justify-center">
                <i data-lucide="server-crash" class="w-12 h-12 text-red-400"></i>
            </div>

            <h1 class="text-6xl md:text-8xl font-black mb-4">
                <span class="bg-gradient-to-r from-red-400 to-orange-400 bg-clip-text text-transparent">500</span>
            </h1>

            <h2 class="text-2xl md:text-3xl font-bold mb-4">Server Error</h2>

            <p class="text-gray-400 text-lg mb-8 max-w-md mx-auto">
                Something went wrong on our end. We're working to fix it.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="index"
                    class="px-8 py-4 bg-[#217c71] hover:bg-[#1a625a] rounded-xl font-bold shadow-lg shadow-teal-500/25 transition-all flex items-center justify-center gap-2 btn-glow">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Go Home
                </a>
                <a href="javascript:location.reload()"
                    class="px-8 py-4 glass hover:bg-white/10 rounded-xl font-semibold transition-all flex items-center justify-center gap-2">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                    Try Again
                </a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>