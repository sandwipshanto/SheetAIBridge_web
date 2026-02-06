<?php
// Include site configuration
require_once __DIR__ . '/../config.php';

// Get current page URL for meta tags
$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $APP_NAME; ?> — <?php echo $APP_TAGLINE; ?></title>
    <meta name="description" content="<?php echo $META_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo $META_KEYWORDS; ?>">
    <meta name="author" content="<?php echo $COMPANY_NAME; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/favicon.svg">
    <link rel="apple-touch-icon" href="/assets/apple-touch-icon.png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($currentUrl); ?>">
    <meta property="og:title" content="<?php echo $APP_NAME; ?> — <?php echo $APP_TAGLINE; ?>">
    <meta property="og:description" content="<?php echo $META_DESCRIPTION; ?>">
    <meta property="og:image" content="/assets/og-image.png">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($currentUrl); ?>">
    <meta name="twitter:title" content="<?php echo $APP_NAME; ?> — <?php echo $APP_TAGLINE; ?>">
    <meta name="twitter:description" content="<?php echo $META_DESCRIPTION; ?>">
    <meta name="twitter:image" content="/assets/og-image.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($currentUrl); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- External CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'gradient': 'gradient 8s ease infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'fade-up': 'fadeUp 0.6s ease-out forwards',
                        'scale-in': 'scaleIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.9)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                    },
                },
            },
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Brand Design System - CSS Variables */
        :root {
            --primary: #173d4e;
            --secondary: #34af9e;
            /* accent only - NOT for white text */
            --accent: #e1f1f1;

            --secondary-strong: #217c71;
            /* CTAs/indicators - AA compliant with white */
            --secondary-strong-hover: #1a625a;
            --secondary-soft: #e6faf7;
            --secondary-soft-border: #93e6dc;

            --surface: #ffffff;
            --surface-subtle: #f7fafb;
            --divider: #d9e3e6;

            --text: #0c2230;
            --text-secondary: #3b515b;
            --text-muted: #526a75;
            /* AA for small text */
            --border-control: #6f8791;
            /* ≥3:1 boundary on white */

            --danger: #c14f5a;
            --info: #1f5fa6;
            --warning: #f2b23a;

            --focus-border: var(--secondary-strong);
            --focus-ring: 0 0 0 3px rgba(52, 175, 158, .35);

            --r-sm: 10px;
            --r-md: 14px;
            --r-pill: 999px;
            --sh-card: 0 6px 18px rgba(12, 34, 48, .08);
            --sh-pop: 0 10px 28px rgba(12, 34, 48, .12);
            --t-fast: 120ms ease;
        }

        /* Custom Styles */
        .gradient-text {
            background: linear-gradient(135deg, #34af9e 0%, #217c71 50%, #1a625a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #0a1f2a, #173d4e, #0d2936, #1a4a5c);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-light {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .glow {
            box-shadow: 0 0 60px rgba(33, 124, 113, 0.3);
        }

        .glow-sm {
            box-shadow: 0 0 30px rgba(33, 124, 113, 0.2);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        .mesh-gradient {
            background:
                radial-gradient(at 40% 20%, rgba(52, 175, 158, 0.15) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(33, 124, 113, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(52, 175, 158, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 50%, rgba(23, 61, 78, 0.15) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(52, 175, 158, 0.1) 0px, transparent 50%);
        }

        .feature-icon {
            background: linear-gradient(135deg, rgba(52, 175, 158, 0.2) 0%, rgba(33, 124, 113, 0.2) 100%);
            border: 1px solid rgba(52, 175, 158, 0.3);
        }

        /* Primary CTA Button - Brand */
        .btn-primary {
            background-color: var(--secondary-strong);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-strong-hover);
        }

        /* Scroll reveal animation classes */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #173d4e;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #34af9e, #217c71);
            border-radius: 4px;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex flex-col font-sans text-white overflow-x-hidden">
    <!-- Skip Link for Accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Background mesh -->
    <div class="fixed inset-0 mesh-gradient pointer-events-none"></div>

    <!-- Mobile Menu Overlay -->
    <div id="mobileOverlay" class="mobile-overlay" onclick="toggleMobileMenu()"></div>

    <!-- Mobile Menu -->
    <nav id="mobileMenu" class="mobile-menu" aria-label="Mobile navigation">
        <div class="flex justify-between items-center mb-8">
            <span class="text-xl font-bold"><?php echo $APP_SHORT_NAME; ?></span>
            <button onclick="toggleMobileMenu()" class="p-2" aria-label="Close menu">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        <div class="flex flex-col gap-4">
            <a href="index" class="text-lg text-gray-300 hover:text-white transition-colors py-2">Home</a>
            <a href="#features" class="text-lg text-gray-300 hover:text-white transition-colors py-2" onclick="toggleMobileMenu()">Features</a>
            <a href="#use-cases" class="text-lg text-gray-300 hover:text-white transition-colors py-2" onclick="toggleMobileMenu()">Use Cases</a>
            <a href="pricing" class="text-lg text-gray-300 hover:text-white transition-colors py-2">Pricing</a>
            <hr class="border-white/10 my-2">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="dashboard" class="text-lg text-gray-300 hover:text-white transition-colors py-2">Dashboard</a>
                <a href="logout" class="text-lg text-gray-300 hover:text-white transition-colors py-2">Log Out</a>
            <?php else: ?>
                <a href="login" class="w-full py-3 bg-[#217c71] hover:bg-[#1a625a] rounded-xl font-semibold text-center transition-all">
                    Get Started
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass border-b border-white/10" role="navigation" aria-label="Main navigation">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index" class="flex items-center gap-3 group" aria-label="<?php echo $APP_NAME; ?> Home">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 via-teal-600 to-teal-700 flex items-center justify-center shadow-lg group-hover:shadow-teal-500/30 transition-shadow duration-300">
                    <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                </div>
                <span
                    class="text-xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent"><?php echo $APP_SHORT_NAME; ?></span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-gray-300 hover:text-white transition-colors font-medium">Features</a>
                <a href="#use-cases" class="text-gray-300 hover:text-white transition-colors font-medium">Use Cases</a>
                <a href="pricing" class="text-gray-300 hover:text-white transition-colors font-medium">Pricing</a>
            </div>

            <div class="flex items-center gap-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="dashboard" class="hidden sm:inline-block text-gray-300 hover:text-white transition-colors font-medium">Dashboard</a>
                    <a href="logout" class="hidden sm:inline-block px-5 py-2.5 glass rounded-xl hover:bg-white/10 transition-all font-medium">Log Out</a>
                <?php else: ?>
                    <a href="login"
                        class="hidden sm:inline-block text-gray-300 hover:text-white transition-colors font-medium">Sign In</a>
                    <a href="login"
                        class="hidden sm:inline-block px-5 py-2.5 bg-[#217c71] hover:bg-[#1a625a] rounded-xl font-semibold shadow-lg shadow-teal-500/25 hover:shadow-teal-500/40 transition-all btn-glow">
                        Get Started
                    </a>
                <?php endif; ?>
                
                <!-- Mobile Hamburger -->
                <button id="hamburgerBtn" class="hamburger md:hidden" onclick="toggleMobileMenu()" aria-label="Toggle menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <main id="main-content" class="flex-grow relative z-10">