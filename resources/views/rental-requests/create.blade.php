@extends('layouts.app')

@section('title', 'Create Rental Request')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-900 rounded-xl shadow-2xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Create Rental Request</h1>

    <form method="POST" action="{{ route('rental-request.store') }}">
        @csrf

        <!-- Vehicle Details -->
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Vehicle Information</h2>
            <p><strong>Brand:</strong> {{ $vehicle['vehicleModel']['vehicleBrand']['name'] }}</p>
            <p><strong>Model:</strong> {{ $vehicle['vehicleModel']['name'] }}</p>
            <p><strong>Daily Rate:</strong> ${{ number_format($vehicle['customDailyRate'], 2) }}/day</p>
            <input type="hidden" name="vehicle[vehicleId]" value="{{ $vehicle['vehicleId'] }}">
        </div>

        <!-- Customer Details -->
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Customer Information</h2>
            <p><strong>Name:</strong> {{ $customer['firstName'] ?? '' }} {{ $customer['lastName'] ?? '' }}</p>
            <p><strong>Email:</strong> {{ $customer['email'] ?? '' }}</p>
            <p><strong>Phone:</strong> {{ $customer['phoneNumber'] ?? '' }}</p>
        </div>

        <!-- Rental Dates -->
        <div class="mb-6">
            <label for="startDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
            <input type="datetime-local" id="startDate" name="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @error('startDate')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="endDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
            <input type="datetime-local" id="endDate" name="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @error('endDate')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Notes -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes (Optional)</label>
            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 shadow-md">
            Submit Rental Request
        </button>
    </form>
</div>
@endsection
