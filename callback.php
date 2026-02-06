<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new Google\Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

if (isset($_GET['code'])) {
    try {
        // Exchange code for token
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        // Get User Profile
        $google_oauth = new Google\Service\Oauth2($client);
        $user_info = $google_oauth->userinfo->get();

        // Save to Session
        $_SESSION['user'] = [
            'email' => $user_info->email,
            'name' => $user_info->name,
            'picture' => $user_info->picture
        ];

        header('Location: dashboard.php');
        exit;
    } catch (Exception $e) {
        die("Login failed. Please try again. Error: " . htmlspecialchars($e->getMessage()));
    }
} else {
    header('Location: index.php');
    exit;
}