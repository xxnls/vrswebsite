<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Services\CountryApiService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\LoginController;


class RegisterController extends Controller
{
    protected $countryApiService;

    public function __construct(CountryApiService $countryApiService)
    {
        $this->countryApiService = $countryApiService;
    }

    /**
     * Show the registration form, with countries data.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Fetch all countries using the service
        $response = $this->countryApiService->getAll('Countries', 1, 200); // Adjust page and pageSize as needed

        // Extract only the 'items' array from the response
        $countries = $response['items'] ?? [];

        // Pass the countries data to the view
        return View::make('auth.register', ['countries' => $countries]);
    }

    /**
     * Handle the registration request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phoneNumber' => 'nullable|string|max:20',
                'password' => 'required|string|min:8|confirmed',
                'address.firstLine' => 'required|string|max:255',
                'address.secondLine' => 'nullable|string|max:255',
                'address.zipCode' => 'required|string|max:20',
                'address.city' => 'required|string|max:255',
                'address.country' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        $decoded = json_decode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), true);
                        if (json_last_error() !== JSON_ERROR_NONE || empty($decoded)) {
                            $fail('The selected country is invalid.');
                        }
                    },
                ],
            ]);

            // Decode the JSON-encoded country object
            $countryString = html_entity_decode($request->input('address.country'), ENT_QUOTES, 'UTF-8');
            $country = json_decode($countryString, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['error' => 'Invalid country data. Please try again.'])->withInput();
            }

            // Disable SSL verification (for development only)
            $http = Http::withoutVerifying();

            // Send a POST request to the API endpoint
            $response = $http->post('https://localhost:7230/api/Customers', [
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phoneNumber' => $request->input('phoneNumber'),
                'password' => $request->input('password'),
                'address' => [
                    'firstLine' => $request->input('address.firstLine'),
                    'secondLine' => $request->input('address.secondLine'),
                    'zipCode' => $request->input('address.zipCode'),
                    'city' => $request->input('address.city'),
                    'country' => [
                        'countryId' => $country['countryId'] ?? null,
                        'name' => $country['name'] ?? null,
                        'fullName' => $country['fullName'] ?? null,
                        'abbreviation' => $country['abbreviation'] ?? null,
                        'dialingCode' => $country['dialingCode'] ?? null,
                    ],
                ],
                'customerType' => [
                    'customerTypeId' => 1,
                    'customerType' => 'Regular',
                    'createdDate' => '2021-09-01T00:00:00Z',
                ]
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                $data = $response->json();
                $loginController = new LoginController();
                return $loginController->loginUserAfterRegistration($request->email, $request->password);
            }

            // Handle API failure
            Log::error('API Error:', $response->json());
            return back()->withErrors(['error' => 'Failed to register. Please try again.'])->withInput();

        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Registration Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again.'])->withInput();
        }
    }
}
