<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

abstract class BaseApiService
{
    protected $client;
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = 'https://localhost:7230/api/';
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'verify' => false, // Disable SSL verification for local development
        ]);
    }

    /**
     * Fetch all records from the specified endpoint.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return array|null
     */
    protected function getAll(string $endpoint, array $queryParams = []): ?array
    {
        try {
            $response = $this->client->get($endpoint, [
                'query' => $queryParams,
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            Log::error("Failed to fetch data from {$endpoint}: " . $e->getMessage());
            return null;
        }
    }
}
