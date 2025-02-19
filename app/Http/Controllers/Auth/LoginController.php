<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Disable SSL verification (for development only)
       $http = Http::withoutVerifying();

        // Send a POST request to the API endpoint
        $response = $http->post('https://localhost:7230/api/CustomerAuth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();

            // Store the token and user ID in the session
            Session::put('token', $data['token']);
            Session::put('customer', $data['customer']);

            // Redirect to the dashboard or home page
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        // Handle login failure
        return back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
    }

    /**
     * Log the user in after registration.
     *
     * @param string $email
     * @param string $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginUserAfterRegistration($email, $password)
    {
        $request = new Request();
        $request->replace([
            'email' => $email,
            'password' => $password,
        ]);

        // Call the existing login method
        return $this->login($request);
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Clear the session
        // Session::forget(['token', 'customer']);
        Session::flush();

        // Redirect to the login page
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    public static function refreshUser()
    {
       // Disable SSL verification (for development only)
       $http = Http::withoutVerifying();

       $customerId = Session::get('customer')['id'];

       // Send a POST request to the API endpoint
       $response = $http->get('https://localhost:7230/api/Customers/}'.$customerId);

       Log::info('Refresh User Response: ' . $response->json());

       Session::put('customer', $response->json());
    }
}
