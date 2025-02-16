<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RentalApiService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct('Rentals');
    }

    public function getUserRentals(int $id): array
    {
        $http = Http::withoutVerifying();

        $response = $http->get("{$this->baseUri}Rentals/customer/{$id}");

        if ($response->successful()) {
            return ['success' => true, 'data' => $response->json()];
        }

        return ['success' => false, 'message' => $response->body()];
    }
}
