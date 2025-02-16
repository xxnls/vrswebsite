@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto flex justify-center min-h-screen mt-4">
    <div class="w-full max-w-md">
        <div class="card mb-4 rounded-xl shadow-2xl bg-white dark:bg-gray-900 transition-all hover:shadow-3xl transform hover:scale-[1.02] mt-4">
            <div class="card-body p-6">
                {{-- @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif --}}
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-user me-2 text-lg text-gray-500 dark:text-gray-400"></i>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ Session::get('customer')['firstName'] ?? '' }} {{ Session::get('customer')['lastName'] ?? '' }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope me-2 text-lg text-gray-500 dark:text-gray-400"></i>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            {{ Session::get('customer')['email'] ?? '' }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone me-2 text-lg text-gray-500 dark:text-gray-400"></i>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            {{ Session::get('customer')['address']['country']['dialingCode'] ?? '' }} {{ Session::get('customer')['phoneNumber'] ?? '' }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt me-2 text-lg text-gray-500 dark:text-gray-400"></i>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            {{ Session::get('customer')['address']['firstLine'] ?? '' }},
                            {{ Session::get('customer')['address']['secondLine'] ? Session::get('customer')['address']['secondLine'] . ',' : '' }}
                            {{ Session::get('customer')['address']['city'] ?? '' }},
                            {{ Session::get('customer')['address']['zipCode'] ?? '' }},
                            {{ Session::get('customer')['address']['country']['name'] ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-md mt-6">
            <div class="card rounded-xl shadow-2xl bg-white dark:bg-gray-900 transition-all hover:shadow-3xl transform hover:scale-[1.02] mt-4">
                <div class="card-body p-6">
                    <div class="space-y-4">
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
