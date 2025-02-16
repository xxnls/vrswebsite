@extends('layouts.app')

@section('content')
    {{-- Vehicle Details Page --}}
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-900 rounded-xl shadow-2xl overflow-hidden transition-all hover:shadow-3xl">
        <!-- Header Section -->
        <div class="relative">
            <!-- Vehicle Image -->
            <img src="{{ $vehicle['vehicleModel']['imageUrl'] }}" alt="Vehicle Image" class="w-full h-96 object-cover rounded-t-xl">
            <!-- Overlay for Not Available -->
            @if(!$vehicle['isAvailableForRent'])
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <span class="text-4xl font-bold text-gray-200 shadow-4x1">NOT AVAILABLE</span>
                </div>
            @endif
        </div>

        <!-- Content Section -->
        <div class="p-8">
            <!-- Vehicle Brand, Model, Price, and Description -->
            <div class="flex flex-col md:flex-row gap-6 mb-8">
                <!-- Left Column: Brand, Model, and Price -->
                <div class="flex-1">

                    <div class="flex items-center mb-4">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white flex-1">
                            {{ $vehicle['vehicleModel']['vehicleBrand']['name'] }} {{ $vehicle['vehicleModel']['name'] }}
                        </h1>

                        <!-- Rental Button -->
                        <div class="flex items-center justify-end mx-4">
                            @if($vehicle['isAvailableForRent'])
                                @if(Session::has('token'))
                                    <a href="{{ route('rental-requests.create', ['vehicleId' => $vehicle['vehicleId']]) }}"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 shadow-md">
                                        Rent Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 shadow-md">
                                        Login to Rent
                                    </a>
                                @endif
                            @else
                                <button disabled class="bg-gray-500 text-white font-bold py-3 px-6 rounded-full cursor-not-allowed">
                                    Not Available for Rent
                                </button>
                            @endif
                        </div>

                        <!-- Logo -->
                        <div class="flex items-center justify-end">
                            <img src="{{ $vehicle['vehicleModel']['vehicleBrand']['logoUrl'] }}" alt="Brand Logo" class="h-16 drop-shadow-lg">
                        </div>
                    </div>

                    <!-- Price -->
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        ${{ number_format($vehicle['customDailyRate'], 2) }}
                        <span class="text-base font-normal italic">/ day</span>
                    </p>

                </div>
            </div>

            <!-- Detailed Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Vehicle Details</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                        <li><strong>Manufacture Year:</strong> {{ $vehicle['manufactureYear'] }}</li>
                        <li><strong>Fuel Type:</strong> {{ $vehicle['vehicleModel']['fuelType'] }}</li>
                        <li><strong>Mileage:</strong> {{ number_format($vehicle['currentMileage']) }} km</li>
                        <li><strong>Horsepower:</strong> {{ $vehicle['vehicleModel']['horsePower'] }} HP</li>
                        <li><strong>Engine Size:</strong> {{ $vehicle['vehicleModel']['engineSize'] }}</li>
                        <li><strong>Color:</strong> {{ $vehicle['color'] }}</li>
                    </ul>
                </div>

                <!-- Right Column -->
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Additional Information</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                        <li><strong>Automatic Transmission:</strong>
                            @if ($vehicle['vehicleOptionalInformation']['hasAutomaticTransmission'])
                                Yes
                            @else
                                No
                            @endif
                        </li>
                        <li><strong>Navigation System:</strong>
                            @if ($vehicle['vehicleOptionalInformation']['hasNavigation'])
                                Yes
                            @else
                                No
                            @endif
                        </li>
                        <li><strong>Bluetooth:</strong>
                            @if ($vehicle['vehicleOptionalInformation']['hasBluetooth'])
                                Yes
                            @else
                                No
                            @endif
                        </li>
                        <li><strong>Air Conditioning:</strong>
                            @if ($vehicle['vehicleOptionalInformation']['hasAirConditioning'])
                                Yes
                            @else
                                No
                            @endif
                        </li>
                        <li><strong>Parking Sensors:</strong>
                            @if ($vehicle['vehicleOptionalInformation']['hasParkingSensors'])
                                Yes
                            @else
                                No
                            @endif
                        </li>
                        <li><strong>Cruise Control:</strong>
                            @if ($vehicle['vehicleOptionalInformation']['hasCruiseControl'])
                                Yes
                            @else
                                No
                            @endif
                        </li>
                    </ul>
                </div>

                <!-- Right Column: Description -->
                @if ($vehicle['vehicleModel']['description'])
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Description</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            {{ $vehicle['vehicleModel']['description'] }}
                        </p>
                    </div>
                @endif
            </div>
            {{-- {{ route('rental-requests.create', ['vehicleId' => $vehicle['id']]) }} --}}
        </div>
    </div>
@endsection
