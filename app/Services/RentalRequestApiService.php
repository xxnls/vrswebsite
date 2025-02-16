<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RentalRequestApiService extends BaseApiService
{
    protected $apiUrl;

    public function __construct()
    {
        parent::__construct('RentalRequests');
    }

    // Method to create a rental request
    public function createRentalRequest(array $data)
    {
        $response = Http::post("{$this->apiUrl}/rental-requests", $data);

        if ($response->successful()) {
            return ['success' => true, 'data' => $response->json()];
        }

        return ['success' => false, 'message' => $response->body()];
    }
}
