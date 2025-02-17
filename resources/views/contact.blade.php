@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Vehicle Rental Business</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Apply blur effect to the video */
        .blur-video {
            filter: blur(10px); /* Adjust the blur intensity as needed */
        }
        body {
            margin: 0;
            padding: 0;
        }
        section {
            margin-top: 0;
            padding-top: 0;
        }
        /* Map container styling */
        #map {
            height: 400px;
            width: 100%;
            margin-top: 2rem;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Contact Information Section -->
    <section class="py-16 bg-white bg-opacity-50 pb-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (!empty($rentalPlaces))
                @foreach ($rentalPlaces as $place)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <!-- Address -->
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800">Address</h3>
                            <p class="text-gray-600 mt-2">{{ $place['address']['firstLine'] }} {{ $place['address']['secondLine'] }}, {{ $place['address']['city'] }}</p>
                        </div>
                        <!-- Phone -->
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800">Phone</h3>
                            <p class="text-gray-600 mt-2">+1 (234) 567-8900</p>
                        </div>
                        <!-- Email -->
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800">Email</h3>
                            <p class="text-gray-600 mt-2">info@rentalbusiness.com</p>
                        </div>
                    </div>
                    <hr class="border-gray-300 my-8">
                @endforeach
            @endif
        </div>
    </section>

    <!-- Map Section -->
    <section class="pb-16 bg-white bg-opacity-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Locations</h2>
            <div id="map"></div>
        </div>
    </section>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([52.29927066198428, 19.027554323673268], 5); // Default center (Poland)
        // Add a tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add markers for each rental place
        @if (!empty($rentalPlaces))
            var latitude = 0.0;
            var longitude = 0.0;
            @foreach ($rentalPlaces as $place)
                @if (isset($place['location']['gpslatitude']) && isset($place['location']['gpslongitude']))
                    latitude = {{ $place['location']['gpslatitude'] }};
                    longitude = {{ $place['location']['gpslongitude'] }};
                    if (latitude && longitude) {
                        L.marker([latitude, longitude])
                            .addTo(map)
                            .bindPopup("{{ $place['address']['firstLine'] }} {{ $place['address']['secondLine'] }}<br>{{ $place['address']['city'] }}");
                    } else {
                        console.error('Invalid GPS coordinates for rental place:', { latitude, longitude });
                    }
                @else
                    console.warn('Rental place missing GPS coordinates:', "{{ $place['address']['firstLine'] }}");
                @endif
        @endforeach
        @endif

        // Adjust the map view to fit all markers
        if (bounds.length > 0) {
            map.fitBounds(bounds);
        } else {
            console.warn('No valid markers to fit bounds. Using default center.');
        }
    </script>
</body>
</html>
@endsection
