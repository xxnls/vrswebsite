<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RentalRequestApiService extends BaseApiService
{
    public function __construct()
    {
        // Initialize the base URI and endpoint for RentalRequests
        parent::__construct('RentalRequests');
    }

    /**
     * Fetch rental requests for the logged-in user.
     *
     * @param int $id
     * @return array
     */
    public function getUserRentalRequests(int $id): array
    {
        $http = Http::withoutVerifying();

        $response = $http->get("{$this->baseUri}RentalRequests/customer/{$id}");

        if ($response->successful()) {
            return ['success' => true, 'data' => $response->json()];
        }

        return ['success' => false, 'message' => $response->body()];
    }

    /**
     * Create a rental request and send it to the API.
     *
     * @param array $data
     * @return array
     */
    public function createRentalRequest(array $data)
    {

        $http = Http::withoutVerifying();

        // Send the request to the API
        $response = $http->post("{$this->baseUri}RentalRequests", [
            'startDate' => $data['startDate'],
            'endDate' => $data['endDate'],
            'notes' => $data['notes'] ?? null,
            'customer' => $this->formatCustomerData($data['customer']),
            'vehicle' => $this->formatVehicleData($data['vehicle']),
        ]);

        // Handle the response
        if ($response->successful()) {
            return ['success' => true, 'data' => $response->json()];
        }

        return ['success' => false, 'message' => $response->body()];
    }

    /**
     * Format customer data for the API.
     *
     * @param array $customerData
     * @return array
     */
    private function formatCustomerData(array $customerData): array
    {
        return [
            'id' => $customerData['id'] ?? null,
            'addressId' => $customerData['addressId'] ?? null,
            'customerTypeId' => $customerData['customerTypeId'] ?? null,
            'customerStatisticsId' => $customerData['customerStatisticsId'] ?? null,
            'firstName' => $customerData['firstName'] ?? null,
            'lastName' => $customerData['lastName'] ?? null,
            'companyName' => $customerData['companyName'] ?? null,
            'email' => $customerData['email'] ?? null,
            'phoneNumber' => $customerData['phoneNumber'] ?? null,
            'userName' => $customerData['userName'] ?? null,
            'password' => $customerData['password'] ?? null,
            'approvedA' => $customerData['approvedA'] ?? false,
            'approvedB' => $customerData['approvedB'] ?? false,
            'approvedC' => $customerData['approvedC'] ?? false,
            'address' => [
                'addressId' => $customerData['address']['addressId'] ?? null,
                'firstLine' => $customerData['address']['firstLine'] ?? null,
                'secondLine' => $customerData['address']['secondLine'] ?? null,
                'zipCode' => $customerData['address']['zipCode'] ?? null,
                'city' => $customerData['address']['city'] ?? null,
                'country' => [
                    'countryId' => $customerData['address']['country']['countryId'] ?? null,
                    'name' => $customerData['address']['country']['name'] ?? null,
                    'fullName' => $customerData['address']['country']['fullName'] ?? null,
                    'abbreviation' => $customerData['address']['country']['abbreviation'] ?? null,
                    'dialingCode' => $customerData['address']['country']['dialingCode'] ?? null,
                ],
            ],
            'customerType' => [
                'customerTypeId' => $customerData['customerType']['customerTypeId'] ?? null,
                'customerType' => $customerData['customerType']['customerType'] ?? null,
                'maxRentals' => $customerData['customerType']['maxRentals'] ?? null,
                'discountPercent' => $customerData['customerType']['discountPercent'] ?? null
            ],
        ];
    }

    /**
     * Format vehicle data for the API.
     *
     * @param array $vehicleData
     * @return array
     */
    private function formatVehicleData(array $vehicleData): array
    {
        return [
            'vehicleId' => $vehicleData['vehicleId'] ?? null,
            'vehicleTypeId' => $vehicleData['vehicleType']['vehicleTypeId'] ?? null,
            'vehicleModelId' => $vehicleData['vehicleModel']['vehicleModelId'] ?? null,
            'vehicleStatusId' => $vehicleData['vehicleStatusId'] ?? null,
            'rentalPlaceId' => $vehicleData['rentalPlaceId'] ?? null,
            'locationId' => $vehicleData['locationId'] ?? null,
            'vin' => $vehicleData['vin'] ?? null,
            'licensePlate' => $vehicleData['licensePlate'] ?? null,
            'color' => $vehicleData['color'] ?? null,
            'manufactureYear' => $vehicleData['manufactureYear'] ?? null,
            'currentMileage' => $vehicleData['currentMileage'] ?? null,
            'lastMaintenanceMileage' => $vehicleData['lastMaintenanceMileage'] ?? null,
            'lastMaintenanceDate' => $vehicleData['lastMaintenanceDate'] ?? null,
            'nextMaintenanceDate' => $vehicleData['nextMaintenanceDate'] ?? null,
            'purchaseDate' => $vehicleData['purchaseDate'] ?? null,
            'purchasePrice' => $vehicleData['purchasePrice'] ?? null,
            'customDailyRate' => $vehicleData['customDailyRate'] ?? null,
            'customWeeklyRate' => $vehicleData['customWeeklyRate'] ?? null,
            'customDeposit' => $vehicleData['customDeposit'] ?? null,
            'isAvailableForRent' => $vehicleData['isAvailableForRent'] ?? true,
            'notes' => $vehicleData['notes'] ?? null,
            'vehicleType' => [
                'vehicleTypeId' => $vehicleData['vehicleType']['vehicleTypeId'] ?? null,
                'name' => $vehicleData['vehicleType']['name'] ?? null,
                'description' => $vehicleData['vehicleType']['description'] ?? null,
                'baseDailyRate' => $vehicleData['vehicleType']['baseDailyRate'] ?? null,
                'baseWeeklyRate' => $vehicleData['vehicleType']['baseWeeklyRate'] ?? null,
                'baseDeposit' => $vehicleData['vehicleType']['baseDeposit'] ?? null,
                'requiredLicenseType' => $vehicleData['vehicleType']['requiredLicenseType'] ?? null
            ],
            'vehicleModel' => [
                'vehicleModelId' => $vehicleData['vehicleModel']['vehicleModelId'] ?? null,
                'name' => $vehicleData['vehicleModel']['name'] ?? null,
                'engineSize' => $vehicleData['vehicleModel']['engineSize'] ?? null,
                'horsePower' => $vehicleData['vehicleModel']['horsePower'] ?? null,
                'fuelType' => $vehicleData['vehicleModel']['fuelType'] ?? null,
                'description' => $vehicleData['vehicleModel']['description'] ?? null,
                'imageUrl' => $vehicleData['vehicleModel']['imageUrl'] ?? null,
                'vehicleBrand' => [
                    'vehicleBrandId' => $vehicleData['vehicleModel']['vehicleBrand']['vehicleBrandId'] ?? null,
                    'name' => $vehicleData['vehicleModel']['vehicleBrand']['name'] ?? null,
                    'description' => $vehicleData['vehicleModel']['vehicleBrand']['description'] ?? null,
                ]
            ]
        ];
    }
}

