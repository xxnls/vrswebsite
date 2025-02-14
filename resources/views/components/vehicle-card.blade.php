@props(['vehicle'])

{{-- Vehicle Card --}}
<div class="max-w-sm rounded-xl overflow-hidden shadow-2xl bg-white dark:bg-gray-900 transition-all hover:shadow-3xl transform hover:scale-105 relative
  {{ !$vehicle['isAvailableForRent'] ? 'blur-lg' : '' }}">
  <!-- Image Section -->
  <img src="{{ $vehicle['vehicleModel']['vehicleBrand']['website'] }}" alt="Vehicle Image" class="w-full h-56 object-cover rounded-t-xl">

  <!-- Overlay for Not Available -->
  @if(!$vehicle['isAvailableForRent'])
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <span class="text-4xl font-bold text-gray-200 shadow-4x1">NOT AVAILABLE</span>
    </div>
  @endif

  <!-- Content Section -->
  <div class="p-6">
    <!-- Vehicle Brand and Model with Logo -->
    <div class="flex items-center">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex-1">
        {{ $vehicle['vehicleModel']['vehicleBrand']['name'] }} {{ $vehicle['vehicleModel']['name'] }}
      </h2>

      <!-- Brand Logo -->
      <img src="{{ $vehicle['vehicleModel']['vehicleBrand']['logoUrl'] }}" alt="Brand Logo" class="h-10 ml-4 drop-shadow-lg">
    </div>

    <!-- Status with Badge -->
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
      Status:
      <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
        {{ $vehicle['isAvailableForRent'] ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
        {{ $vehicle['isAvailableForRent'] ? 'Available' : 'Not Available' }}
      </span>
    </p>

    <!-- Price -->
    <p class="mt-3 text-2xl font-bold text-gray-900 dark:text-white">
      ${{ number_format($vehicle['customDailyRate'], 2) }}
      {{-- make per day smaller and incursive --}}
        <span class="text-sm font-normal italic">/ day</span>
    </p>

    <!-- Additional Details -->
    <ul class="mt-4 space-y-2 text-sm text-gray-600 dark:text-gray-300">
      <li><strong>Year:</strong> {{ $vehicle['manufactureYear'] }}</li>
      <li><strong>Fuel Type:</strong> {{ $vehicle['vehicleModel']['fuelType'] }}</li>
      <li><strong>Mileage:</strong> {{ number_format($vehicle['currentMileage']) }} km</li>
      <li><strong>Horsepower:</strong> {{ $vehicle['vehicleModel']['horsePower'] }} HP</li>
    </ul>
  </div>
</div>
