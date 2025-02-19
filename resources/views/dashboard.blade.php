@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto flex justify-center min-h-screen mt-4">
    <div class="w-full max-w-4xl"> <!-- Increased max-width to accommodate two columns -->
        <div class="card mb-4 rounded-xl shadow-2xl bg-white dark:bg-gray-900 transition-all hover:shadow-3xl transform hover:scale-[1.02] mt-4">
            <div class="card-body p-6">
                @isset($success)
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                      <span class="font-medium"> {{ $success }}</span>
                    </div>
                  </div>
                @endisset

                <!-- Two-column grid layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column: Customer Information -->
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ Session::get('customer')['firstName'] ?? '' }} {{ Session::get('customer')['lastName'] ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ Session::get('customer')['email'] ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ Session::get('customer')['address']['country']['dialingCode'] ?? '' }} {{ Session::get('customer')['phoneNumber'] ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ Session::get('customer')['address']['firstLine'] ?? '' }},
                                {{ Session::get('customer')['address']['secondLine'] ? Session::get('customer')['address']['secondLine'] . ',' : '' }}
                                {{ Session::get('customer')['address']['city'] ?? '' }},
                                {{ Session::get('customer')['address']['zipCode'] ?? '' }},
                                {{ Session::get('customer')['address']['country']['name'] ?? '' }}
                            </p>
                        </div>
                    </div>

                    <!-- Right Column: License Information -->
                    <div class="grid grid-rows-4 space-y-2">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            Approved Licenses:
                        </p>
                        <span class="text-sm {{ Session::get('customer')['approvedA'] ? 'text-green-600' : 'text-red-600' }}">
                            A: {{ Session::get('customer')['approvedA'] ? 'Approved' : 'Not Approved' }}
                        </span>
                        <span class="text-sm {{ Session::get('customer')['approvedB'] ? 'text-green-600' : 'text-red-600' }}">
                            B: {{ Session::get('customer')['approvedB'] ? 'Approved' : 'Not Approved' }}
                        </span>
                        <span class="text-sm {{ Session::get('customer')['approvedC'] ? 'text-green-600' : 'text-red-600' }}">
                            C: {{ Session::get('customer')['approvedC'] ? 'Approved' : 'Not Approved' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Requests and Logout Section -->
        <div class="w-full max-w-4xl mt-6">
            <div class="card rounded-xl shadow-2xl bg-white dark:bg-gray-900 transition-all hover:shadow-3xl transform hover:scale-[1.02] mt-4">
                <div class="card-body p-6">
                    <div class="space-y-4">
                        <a href="{{ route('upload.form') }}" class="flex items-center w-full text-left text-gray-900 dark:text-white bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg px-4 py-2 transition-colors">
                            <i class="fas fa-list-alt me-3 text-lg"></i>
                            <span class="text-lg font-medium">Send License Approval Request</span>
                        </a>
                        <a href="{{ route('rental-requests.index') }}" class="flex items-center w-full text-left text-gray-900 dark:text-white bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg px-4 py-2 transition-colors">
                            <i class="fas fa-list-alt me-3 text-lg"></i>
                            <span class="text-lg font-medium">My Rental Requests</span>
                        </a>
                        <a href="{{ route('rentals.index') }}" class="flex items-center w-full text-left text-gray-900 dark:text-white bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg px-4 py-2 transition-colors">
                            <i class="fas fa-car me-3 text-lg"></i>
                            <span class="text-lg font-medium">My Rentals</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-left text-white bg-red-600 hover:bg-red-700 rounded-lg px-4 py-2 transition-colors">
                                <i class="fas fa-sign-out-alt me-3 text-lg"></i>
                                <span class="text-lg font-medium">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
