@extends('layouts.app')
@section('title', 'Create Rental Request')
@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-900 rounded-xl shadow-2xl overflow-hidden p-8">
    <!-- Centered Title -->
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">Create Rental Request</h1>
    <form method="POST" action="{{ route('rental-requests.store') }}" id="rentalRequestForm">
        @csrf
        <!-- Vehicle Details -->
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Vehicle Information</h2>
            <p><strong>Brand:</strong> {{ $vehicle['vehicleModel']['vehicleBrand']['name'] }}</p>
            <p><strong>Model:</strong> {{ $vehicle['vehicleModel']['name'] }}</p>
            <p><strong>Daily Rate:</strong> ${{ number_format($vehicle['customDailyRate'], 2) }}/day</p>
            <p><strong>Fuel Type:</strong> {{ $vehicle['vehicleModel']['fuelType'] }}</p>
            <p><strong>Horsepower:</strong> {{ $vehicle['vehicleModel']['horsePower'] }} HP</p>
            <p><strong>Mileage:</strong> {{ number_format($vehicle['currentMileage']) }} km</p>
            <input type="hidden" name="vehicle[vehicleId]" value="{{ $vehicle['vehicleId'] }}">
        </div>
        <!-- Rental Dates -->
        <div class="mb-6">
            <label for="startDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
            <input type="date" id="startDate" name="startDate" class="border p-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @error('startDate')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="endDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
            <input type="date" id="endDate" name="endDate" class="border p-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @error('endDate')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Total Cost Calculation -->
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Total Cost</h2>
            <p><strong>Total Days:</strong> <span id="totalDays">0</span> days</p>
            <p><strong>Daily Rate:</strong> ${{ number_format($vehicle['customDailyRate'], 2) }}/day</p>
            <p><strong>Discount:</strong> <span id="discountPercent">{{ $customer['customerType']['discountPercent'] ?? 0 }}%</span></p>
            <p><strong>Total Cost Before Discount:</strong> $<span id="totalCostBeforeDiscount">0.00</span></p>
            <p><strong>Total Cost After Discount:</strong> $<span id="totalCost">0.00</span></p>
        </div>
        <!-- Notes -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes (Optional)</label>
            <textarea id="notes" name="notes" rows="3" class="border p-1 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 shadow-md">
            Submit Rental Request
        </button>
    </form>
</div>
<!-- JavaScript for Dynamic Total Cost Calculation -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const totalDaysElement = document.getElementById('totalDays');
    const totalCostBeforeDiscountElement = document.getElementById('totalCostBeforeDiscount');
    const totalCostElement = document.getElementById('totalCost');
    const discountPercentElement = document.getElementById('discountPercent');

    const dailyRate = {{ $vehicle['customDailyRate'] }};
    const discountPercent = {{ $customer['customerType']['discountPercent'] ?? 0 }};

    function calculateTotalCost() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDate && endDate && startDate <= endDate) {
            const timeDifference = endDate - startDate;
            const totalDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) + 1; // Include both start and end dates
            const totalCostBeforeDiscount = totalDays * dailyRate;
            const discountAmount = (discountPercent / 100) * totalCostBeforeDiscount;
            const totalCostAfterDiscount = totalCostBeforeDiscount - discountAmount;

            totalDaysElement.textContent = totalDays;
            totalCostBeforeDiscountElement.textContent = totalCostBeforeDiscount.toFixed(2);
            totalCostElement.textContent = totalCostAfterDiscount.toFixed(2);
        } else {
            totalDaysElement.textContent = '0';
            totalCostBeforeDiscountElement.textContent = '0.00';
            totalCostElement.textContent = '0.00';
        }
    }

    startDateInput.addEventListener('change', calculateTotalCost);
    endDateInput.addEventListener('change', calculateTotalCost);
});
</script>
@endsection
