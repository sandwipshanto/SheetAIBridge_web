<?php
require_once __DIR__ . '/src/bootstrap.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: /dashboard');
    exit;
}

// Set up Google OAuth
$client = new Google\Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();

include __DIR__ . '/src/includes/header.php';
?>

<!-- Login Page -->
<section class="min-h-[70vh] flex items-center justify-center relative py-16">
    <!-- Background effects -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-64 h-64 bg-[#217c71]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-md mx-auto">
            <div class="glass rounded-3xl p-8 md:p-12 reveal text-center">
                <!-- Logo -->
                <div
                    class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-teal-500 via-teal-600 to-teal-700 flex items-center justify-center shadow-lg shadow-teal-500/30">
                    <i data-lucide="sparkles" class="w-10 h-10 text-white"></i>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold mb-2">Welcome to <?php echo $APP_SHORT_NAME; ?></h1>
                <p class="text-gray-400 mb-8">Sign in to start using AI in your spreadsheets</p>

                <!-- Sign In Button -->
                <a href="<?php echo htmlspecialchars($authUrl); ?>" id="loginBtn"
                    class="w-full py-4 px-6 bg-white hover:bg-gray-100 text-gray-800 rounded-xl font-semibold transition-all flex items-center justify-center gap-3 mb-6"
                    onclick="showLoading()">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    <span id="btnText">Continue with Google</span>
                    <div id="btnSpinner" class="spinner hidden"></div>
                </a>

                <!-- Loading State -->
                <div id="loadingState" class="hidden">
                    <div class="flex items-center justify-center gap-3 text-gray-400">
                        <div class="spinner"></div>
                        <span>Redirecting to Google...</span>
                    </div>
                </div>

                <!-- Terms -->
                <p class="text-xs text-gray-500">
                    By signing in, you agree to our
                    <a href="terms" class="text-teal-400 hover:text-teal-300">Terms of Service</a>
                    and
                    <a href="privacy" class="text-teal-400 hover:text-teal-300">Privacy Policy</a>
                </p>
            </div>

            <!-- Features List -->
            <div class="mt-8 text-center reveal" style="animation-delay: 0.2s;">
                <p class="text-gray-400 text-sm mb-4">What you'll get:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <div class="flex items-center gap-2 text-gray-300">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        Free trial
                    </div>
                    <div class="flex items-center gap-2 text-gray-300">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        All AI models
                    </div>
                    <div class="flex items-center gap-2 text-gray-300">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-400"></i>
                        No credit card
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function showLoading() {
        document.getElementById('btnText').classList.add('hidden');
        document.getElementById('btnSpinner').classList.remove('hidden');
        document.getElementById('loginBtn').classList.add('opacity-75', 'cursor-wait');
        document.getElementById('loadingState').classList.remove('hidden');
    }
</script>

<?php include __DIR__ . '/src/includes/footer.php'; ?>