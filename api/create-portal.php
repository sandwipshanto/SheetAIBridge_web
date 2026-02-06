<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

// Protection
if (!isset($_SESSION['user'])) {
    die("Unauthorized access.");
}

// Load .env from one level up
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Config for return URL
require_once __DIR__ . '/../src/config.php';
$returnUrl = $_ENV['SITE_URL'] . '/dashboard.php';

// Use SupabaseService to call Edge Function
require_once __DIR__ . '/../src/services/SupabaseService.php';
$service = new \App\Services\SupabaseService();

// We use the logged-in user's email (google_user_id) to look up the Stripe Customer ID on the backend
$result = $service->createPortalSession($_SESSION['user']['email'], $returnUrl);

if (isset($result['url'])) {
    header("Location: " . $result['url']);
    exit;
} else {
    $error = $result['error'] ?? "Unknown error creating portal session.";
    die("Error: " . htmlspecialchars($error));
}