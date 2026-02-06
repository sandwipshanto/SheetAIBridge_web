<?php
// Note: Vendor is one level up
require_once __DIR__ . '/../vendor/autoload.php';

session_start();
header('Content-Type: application/json');

// Check Login
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Please log in to purchase.']);
    exit;
}

// Load .env from one level up
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['price_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing price information']);
    exit;
}

// Call Supabase Service
require_once __DIR__ . '/../src/services/SupabaseService.php';
$service = new \App\Services\SupabaseService();

$result = $service->createCheckoutSession([
    'price_id' => $input['price_id'],
    'plan' => $input['plan'],
    'google_user_id' => $_SESSION['user']['email'],
    'email' => $_SESSION['user']['email'],
    // Redirect URLs
    'success_url' => $_ENV['SITE_URL'] . "/success.php?session_id={CHECKOUT_SESSION_ID}",
    'cancel_url' => $_ENV['SITE_URL'] . "/pricing.php"
]);

// Return URL to frontend
echo json_encode(['url' => $result['checkout_url'] ?? null, 'error' => $result['error'] ?? null]);