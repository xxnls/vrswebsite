<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RentalRequestApiService;
use Illuminate\Support\Facades\Session;

class RentalRequestController extends BaseApiController
{
    public function __construct(RentalRequestApiService $service)
    {
        $this->service = $service;
    }

    protected function getEndpoint(): string
    {
        return 'RentalRequests';
    }

    // Show the rental request form
    public function create($vehicleId)
    {
        // Fetch vehicle details (you can fetch this from an API or database)
        $vehicle = [
            'vehicleId' => $vehicleId,
            'vehicleModel' => [
                'name' => 'Example Model',
                'vehicleBrand' => ['name' => 'Example Brand'],
            ],
            'customDailyRate' => 50.00,
        ];

        // Get customer details from session
        $customer = Session::get('customer', []);

        return view('rental-requests.create', compact('vehicle', 'customer'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'notes' => 'nullable|string',
        ]);

        // Merge customer and vehicle data into the request payload
        $payload = array_merge($validated, [
            'customer' => Session::get('customer'),
            'vehicle' => $request->input('vehicle'),
        ]);

        // Send the rental request to the API
        $response = $this->service->createRentalRequest($payload);

        if ($response['success']) {
            return redirect()->route('rental-requests.index')->with('success', 'Rental request submitted successfully!');
        }

        return back()->withErrors(['error' => 'Failed to submit rental request. Please try again.']);
    }
}
