<?php
namespace App\Services;

use GuzzleHttp\Client;

class SupabaseService
{
    private $client;

    public function __construct()
    {
        // Assume $_ENV is already loaded by the calling script
        $this->client = new Client([
            'base_uri' => $_ENV['SUPABASE_URL'] . '/functions/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['SUPABASE_ANON_KEY'],
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function getSubscription($email)
    {
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

    public function createCheckoutSession($data)
    {
        try {
            $response = $this->client->post('create-checkout', [
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createPortalSession($googleUserId, $returnUrl)
    {
        try {
            $response = $this->client->post('create-portal', [
                'json' => [
                    'google_user_id' => $googleUserId,
                    'return_url' => $returnUrl
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Log error if needed
            return ['error' => $e->getMessage()];
        }
    }

    public function getActivePlans()
    {
        try {
            $client = new Client([
                'base_uri' => $_ENV['SUPABASE_URL'] . '/rest/v1/',
                'headers' => [
                    'apikey' => $_ENV['SUPABASE_ANON_KEY'],
                    'Authorization' => 'Bearer ' . $_ENV['SUPABASE_ANON_KEY'],
                    'Content-Type' => 'application/json',
                ]
            ]);

            $response = $client->get('plans', [
                'query' => [
                    'select' => '*',
                    'active' => 'eq.true',
                    'order' => 'price.asc'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return [];
        }
    }
}