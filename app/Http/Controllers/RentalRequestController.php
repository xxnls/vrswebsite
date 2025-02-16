<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RentalRequestApiService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Override;

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

    /**
     * Show the rental request form for the specified vehicle.
     *
     * @param int $vehicleId
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create($vehicleId)
    {
        // Fetch the vehicle details using the service
        $vehicle = $this->service->getById('Vehicles', $vehicleId);

        if ($vehicle === null) {
            return redirect()->back()->withErrors(['error' => 'Vehicle not found.']);
        }

        // Get customer details from the session
        $customer = Session::get('customer', []);

        // Pass the vehicle and customer data to the view
        return view('rental-requests.create', compact('vehicle', 'customer'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        Log::info('Store method called', ['request' => $request->all()]);

        // Validate the form data
        $validated = $request->validate([
            'startDate' => 'required|date|after:today',
            'endDate' => 'required|date|after:startDate',
            'notes' => 'nullable|string',
        ]);

        // Get customer and vehicle data
        $customer = Session::get('customer');
        if (empty($customer)) {
            return back()->withErrors(['error' => 'Customer data not found in session.']);
        }

        $vehicle = $this->service->getById('Vehicles', $request['vehicle']['vehicleId']);
        if (!$vehicle) {
            return ['success' => false, 'message' => 'Vehicle not found.'];
        }

        // Merge customer and vehicle data into the request payload
        $payload = array_merge($validated, [
            'customer' => $customer,
            'vehicle' => $vehicle,
        ]);

        // Send the rental request to the API
        $response = $this->service->createRentalRequest($payload);

        if ($response['success']) {
            return redirect()->route('rental-requests.index')->with('success', 'Rental request submitted successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to submit rental request. Please try again.']);
    }

        /**
     * Show all rental requests made by the logged-in user.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function indexCustomerRequests()
    {
        $token = Session::get('token');
        Log::info('Session Token:', ['token' => $token]);

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to view rental requests.']);
        }

        $customerId = Session::get('customer.id');
        Log::info('Customer ID:', ['customerId' => $customerId]);

        // Fetch rental requests for the logged-in user
        $response = $this->service->getUserRentalRequests($customerId);
        if ($response['success']) {
            $rentalRequests = $response['data']['items'];
            return view('rental-requests.index', compact('rentalRequests'));
        }

        Log::info('Failed to fetch rental requests:', ['response' => $response]);

        return back()->withErrors(['error' => 'Failed to fetch rental requests. Please try again.']);
    }
}
