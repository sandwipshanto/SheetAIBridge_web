<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env from one level up
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$customerId = null;

// Case 1: GET request (from Add-on link)
if (isset($_GET['customer_id'])) {
    $customerId = htmlspecialchars($_GET['customer_id']);
} 
// Case 2: POST request (from Website Dashboard)
elseif (isset($_POST['customer_id'])) {
    session_start();
    if (!isset($_SESSION['user'])) {
        die("Unauthorized access.");
    }
    $customerId = $_POST['customer_id'];
} 
else {
    die("Error: Customer ID is missing.");
}

// Initialize Stripe directly to create session
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

try {
    $session = \Stripe\BillingPortal\Session::create([
        'customer' => $customerId,
        'return_url' => $_ENV['SITE_URL'] . '/dashboard.php',
    ]);
    
    header("Location: " . $session->url);
    exit;
} catch (Exception $e) {
    http_response_code(500);
    echo "Error creating billing portal: " . htmlspecialchars($e->getMessage());
}