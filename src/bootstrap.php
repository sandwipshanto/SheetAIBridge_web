<?php
/**
 * Bootstrap File
 * 
 * Single entry point for common initialization.
 * Include this at the top of every page instead of repeating setup code.
 */

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

// Load site configuration
require_once __DIR__ . '/config.php';

// Helper function to check if user is logged in
function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

// Helper function to get current user
function getCurrentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

// Helper function to require login
function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: /login');
        exit;
    }
}

// Helper function for CSRF token generation
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Helper function to verify CSRF token
function verifyCsrf(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
