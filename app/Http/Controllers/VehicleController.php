<?php

namespace App\Http\Controllers;

use App\Services\VehicleApiService;

class VehicleController extends BaseApiController
{
    public function __construct(VehicleApiService $service)
    {
        $this->service = $service;
    }

    /**
     * Get the endpoint for vehicle API requests.
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return 'Vehicles';
    }
}
