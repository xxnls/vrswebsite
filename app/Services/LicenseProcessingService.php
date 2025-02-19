<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LicenseProcessingService extends BaseApiService
{
    public function __construct()
    {
        // Initialize the base URI and endpoint for License Uploads
        parent::__construct('LicenseApprovalRequests');
    }

    /**
     * Upload a license to the API.
     *
     * @param array $data
     * @return array
     */
    public function uploadLicense(array $data): array
    {
        try {
            $http = Http::withoutVerifying();

            // Prepare the payload
            $payload = [
                'fileContentFront' => $data['fileContentFront'] ?? null,
                'fileContentBack' => $data['fileContentBack'] ?? null,
                'fileNameFront' => $data['fileNameFront'] ?? null,
                'fileNameBack' => $data['fileNameBack'] ?? null,
                'customerId' => $data['customerId'] ?? null,
                'licenseType' => $data['licenseType'] ?? null,
            ];


            // Send the POST request to the API
            $response = $http->post("{$this->baseUri}{$this->endpoint}/upload-license", $payload);

            Log::info('Endpoint: ' . $this->baseUri . $this->endpoint . 'upload-license');

            // Handle the response
            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()];
            }

            Log::error('Failed to upload license: ' . $response->body());
            return ['success' => false, 'message' => $response->body()];
        } catch (\Exception $e) {
            Log::error('Error during license upload: ' . $e->getMessage());
            return ['success' => false, 'message' => 'An error occurred while uploading the license.'];
        }
    }
}
