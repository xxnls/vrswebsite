<?php

namespace App\Http\Controllers;

use App\Services\LicenseProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LicenseController extends Controller
{
    protected $licenseUploadService;

    public function __construct(LicenseProcessingService $licenseUploadService)
    {
        $this->licenseUploadService = $licenseUploadService;
    }

     /**
     * Show the form for uploading a license.
     *
     * @return \Illuminate\View\View
     */
    public function showUploadForm()
    {
        return view('upload-license');
    }

    /**
     * Handle the license upload via API.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadLicense(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'fileFront' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
                'fileBack' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
                'licenseType' => 'required|string|in:A,B,C',
            ]);

            // Retrieve the customer ID from the session
            $customer = $request->session()->get('customer');
            $customerId = $customer['id'] ?? null;
            if (!$customerId) {
                return response()->json(['error' => 'Customer ID not found in session.'], 400);
            }

            // Ensure both files are uploaded and valid
            if (!$request->hasFile('fileFront') || !$request->hasFile('fileBack')) {
                return response()->json(['error' => 'Both front and back files are required.'], 400);
            }

            $fileFront = $request->file('fileFront');
            $fileBack = $request->file('fileBack');

            if (!$fileFront->isValid() || !$fileBack->isValid()) {
                return response()->json(['error' => 'Invalid file upload.'], 400);
            }

            // Convert files to base64
            try {
                $fileContentFront = base64_encode(file_get_contents($fileFront->getPathname()));
                $fileContentBack = base64_encode(file_get_contents($fileBack->getPathname()));
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to process file content.', 'details' => $e->getMessage()], 500);
            }

            // Extract file names
            $fileNameFront = $fileFront->getClientOriginalName();
            $fileNameBack = $fileBack->getClientOriginalName();

            // Prepare the payload
            $payload = [
                'fileContentFront' => (string) $fileContentFront,
                'fileContentBack' => (string) $fileContentBack,
                'fileNameFront' => (string) $fileNameFront,
                'fileNameBack' => (string) $fileNameBack,
                'customerId' => (int) $customerId,
                'licenseType' => (string) $validatedData['licenseType'],
            ];

            // Log the payload for debugging
            Log::info('Upload License Payload: ', $payload);

            // Call the service to upload the license
            $response = $this->licenseUploadService->uploadLicense($payload);

            if ($response['success']) {
                return response()->json(['message' => 'License uploaded successfully', 'data' => $response['data']], 200);
            }

            return response()->json(['error' => $response['message']], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.', 'details' => $e->getMessage()], 500);
        }
    }
}
