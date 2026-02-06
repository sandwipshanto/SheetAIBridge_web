</main>

<!-- Footer -->
<footer class="relative z-10 border-t border-white/10 mt-auto">
    <div class="container mx-auto px-6 py-12">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <!-- Brand -->
            <div class="md:col-span-1">
                <a href="index" class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 via-teal-600 to-teal-700 flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xl font-bold"><?php echo $APP_SHORT_NAME; ?></span>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed">
                    <?php echo $APP_TAGLINE; ?>. Process thousands of rows with GPT-4, Gemini, and more.
                </p>
            </div>

            <!-- Product -->
            <div>
                <h4 class="font-semibold mb-4 text-white">Product</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                    <li><a href="pricing" class="text-gray-400 hover:text-white transition-colors">Pricing</a></li>
                    <li><a href="#use-cases" class="text-gray-400 hover:text-white transition-colors">Use Cases</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="font-semibold mb-4 text-white">Resources</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Documentation</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API Reference</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Support</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h4 class="font-semibold mb-4 text-white">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="privacy" class="text-gray-400 hover:text-white transition-colors">Privacy
                            Policy</a></li>
                    <li><a href="terms" class="text-gray-400 hover:text-white transition-colors">Terms of
                            Service</a></li>
                    <li><a href="refund" class="text-gray-400 hover:text-white transition-colors">Refund Policy</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">
                &copy; <?php echo date('Y'); ?> <?php echo $APP_NAME; ?>. All rights reserved.
            </p>
            <div class="flex items-center gap-4">
                <a href="#"
                    class="w-10 h-10 rounded-lg glass flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                    aria-label="Twitter">
                    <i data-lucide="twitter" class="w-5 h-5"></i>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-lg glass flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                    aria-label="GitHub">
                    <i data-lucide="github" class="w-5 h-5"></i>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-lg glass flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                    aria-label="LinkedIn">
                    <i data-lucide="linkedin" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Cookie Consent Banner -->
<div id="cookieBanner" class="cookie-banner" role="dialog" aria-labelledby="cookieTitle">
    <div class="container mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <i data-lucide="cookie" class="w-6 h-6 text-teal-400 flex-shrink-0"></i>
            <p id="cookieTitle" class="text-sm text-gray-300">
                We use cookies to enhance your experience. By continuing, you agree to our
                <a href="privacy" class="text-teal-400 hover:text-teal-300">Privacy Policy</a>.
            </p>
        </div>
        <div class="flex gap-3 flex-shrink-0">
            <button onclick="acceptCookies()"
                class="px-4 py-2 bg-[#217c71] hover:bg-[#1a625a] rounded-lg text-sm font-semibold transition-all">
                Accept
            </button>
            <button onclick="declineCookies()"
                class="px-4 py-2 glass hover:bg-white/10 rounded-lg text-sm font-medium transition-all">
                Decline
            </button>
        </div>
    </div>
</div>

<!-- Google Analytics (replace GA_MEASUREMENT_ID with your ID) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
    // Only load analytics if cookies accepted
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }

    if (localStorage.getItem('cookiesAccepted') === 'true') {
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    }
</script>

<script>
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Mobile Menu Toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('mobileOverlay');
        const hamburger = document.getElementById('hamburgerBtn');

        menu.classList.toggle('open');
        overlay.classList.toggle('show');
        hamburger.classList.toggle('active');
        hamburger.setAttribute('aria-expanded', menu.classList.contains('open'));

        // Re-init icons in mobile menu
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // Cookie Consent
    function showCookieBanner() {
        if (!localStorage.getItem('cookieConsent')) {
            setTimeout(() => {
                document.getElementById('cookieBanner').classList.add('show');
            }, 1000);
        }
    }

    function acceptCookies() {
        localStorage.setItem('cookieConsent', 'true');
        localStorage.setItem('cookiesAccepted', 'true');
        document.getElementById('cookieBanner').classList.remove('show');
        // Enable analytics
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    }

    function declineCookies() {
        localStorage.setItem('cookieConsent', 'true');
        localStorage.setItem('cookiesAccepted', 'false');
        document.getElementById('cookieBanner').classList.remove('show');
    }

    // Form Validation Helper
    function validateForm(form) {
        const inputs = form.querySelectorAll('[required]');
        let valid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                valid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });

        return valid;
    }

    // Scroll reveal animation
    function reveal() {
        const reveals = document.querySelectorAll('.reveal');
        reveals.forEach(element => {
            const windowHeight = window.innerHeight;
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;

            if (elementTop < windowHeight - elementVisible) {
                element.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', reveal);
    reveal(); // Initial check

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                // Close mobile menu if open
                const menu = document.getElementById('mobileMenu');
                if (menu && menu.classList.contains('open')) {
                    toggleMobileMenu();
                }

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Show cookie banner on load
    showCookieBanner();
</script>
</body>

</html>