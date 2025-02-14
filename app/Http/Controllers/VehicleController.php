<?php

namespace App\Http\Controllers;

use App\Services\VehicleApiService;
use Illuminate\Http\Request;

class VehicleController extends BaseApiController
{
    public function __construct(VehicleApiService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the vehicles.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1); // Default to page 1
        $pageSize = $request->query('pageSize', 10); // Default to 10 items per page

        // Fetch data from the API
        $data = $this->service->getAllVehicles($this->getEndpoint(), $page, $pageSize);

        if ($data === null) {
            // If data fetching fails, return an error view or redirect
            return view('vehicles/index', ['error' => 'Failed to fetch vehicles from the API.']);
        }

        // Pass the data to the view
        return view('vehicles/index', ['vehicles' => $data]);
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
