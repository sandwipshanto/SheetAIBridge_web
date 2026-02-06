<?php
/**
 * OAuth initiation endpoint
 * Stores selected plan/price info in session, then redirects to Google OAuth
 */
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Capture plan intent from query params
if (isset($_GET['plan']) && isset($_GET['priceId'])) {
    $_SESSION['checkout_intent'] = [
        'plan' => $_GET['plan'],
        'priceId' => $_GET['priceId']
    ];
}

// Setup Google Client
$client = new Google\Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$client->addScope('email');
$client->addScope('profile');

// Generate auth URL and redirect
$authUrl = $client->createAuthUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
