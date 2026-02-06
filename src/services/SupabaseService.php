<?php
namespace App\Services;

use GuzzleHttp\Client;

class SupabaseService {
    private $client;

    public function __construct() {
        // Assume $_ENV is already loaded by the calling script
        $this->client = new Client([
            'base_uri' => $_ENV['SUPABASE_URL'] . '/functions/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['SUPABASE_ANON_KEY'],
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function getSubscription($email) {
        try {
            $response = $this->client->post('check-entitlement', [
                'json' => ['google_user_id' => $email]
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Return null if user not found or error
            return null;
        }
    }

    public function createCheckoutSession($data) {
        try {
            $response = $this->client->post('create-checkout', [
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}