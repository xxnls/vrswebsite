<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

abstract class BaseApiService
{
    protected $client;
    protected $baseUri;
    protected $endpoint;

    public function __construct(string $endpoint)
    {
        $this->baseUri = 'https://localhost:7230/api/';
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'verify' => false, // Disable SSL verification for local development
        ]);
        $this->endpoint = $endpoint;
    }

    /**
     * Fetch all records from the specified endpoint.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return array|null
     */
    public function getAll(string $endpoint, int $page, int $pageSize, array $queryParams = []): ?array
    {
        $queryParams['page'] = $page;
        $queryParams['pageSize'] = $pageSize;

        try {
            $response = $this->client->get($endpoint, [
                'query' => $queryParams,
            ]);

            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                return json_decode($response->getBody(), true);
            } else {
                Log::error("API Error: {$response->getStatusCode()} - {$response->getBody()}");
                return null;
            }
        } catch (GuzzleException $e) {
            Log::error("Failed to fetch data from {$endpoint}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Fetch a specific record by ID from the specified endpoint.
     *
     * @param string $endpoint
     * @param int $id
     * @return array|null
     */
    public function getById(string $endpoint, int $id): ?array
    {
        try {
            $response = $this->client->get($endpoint . '/' . $id);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            Log::error("Failed to fetch data from {$endpoint}/{$id}: " . $e->getMessage());
            return null;
        }
    }
}
