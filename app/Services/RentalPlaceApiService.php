<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RentalPlaceApiService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct('RentalPlaces');
    }

    /**
     * Fetch all rental places from the API.
     *
     * @return array
     */
    public function getRentalPlaces(): array
    {
        try {
            $response = Http::withoutVerifying()->get("{$this->baseUri}RentalPlaces?page=1&pageSize=10");

            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()['items']];
                Log::info('rentalasdasdasd', $rentalPlaces);
            }

            return ['success' => false, 'message' => $response->body()];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
