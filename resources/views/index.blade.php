@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Rental Business</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Apply blur effect to the video */
        .blur-video {
            filter: blur(10px); /* Adjust the blur intensity as needed */
            /* transform: scale(1.1); Slightly zoom the video to prevent edges from showing */
        }

                body {
            margin: 0;
            padding: 0;
        }

        section {
            margin-top: 0;
            padding-top: 0;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Blurred Video Background -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <video autoplay muted id="hero-video" class="w-full h-full object-cover blur-video">
                <source src="{{ asset('/storage/hero-video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Content -->
        <div class="relative z-10 text-white text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 text-shadow">Your Next Adventure Awaits</h1>
            <p class="text-xl md:text-2xl mb-8 text-shadow">Rent the perfect vehicle for your journey today!</p>
            <a href="{{ route('vehicles') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 shadow-md">
                Explore Rentals
            </a>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">About Us</h2>
            <p class="text-lg text-gray-600 text-center">
                We are a trusted vehicle rental service dedicated to providing high-quality cars, trucks, and SUVs for all your travel needs. Whether you're planning a road trip, a family vacation, or need a vehicle for daily commuting, we've got you covered.
            </p>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Why Choose Us?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Reason 1 -->
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Wide Selection</h3>
                    <p class="text-gray-600 mt-2">Choose from a wide range of vehicles to suit your needs.</p>
                </div>
                <!-- Reason 2 -->
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Affordable Rates</h3>
                    <p class="text-gray-600 mt-2">Competitive pricing with no hidden fees.</p>
                </div>
                <!-- Reason 3 -->
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">24/7 Support</h3>
                    <p class="text-gray-600 mt-2">Our team is available around the clock to assist you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <p class="text-gray-700 italic">"Great service! The car was clean and delivered on time. Highly recommend!"</p>
                    <p class="text-gray-800 font-bold mt-4">- John Doe</p>
                </div>
                <!-- Review 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <p class="text-gray-700 italic">"I rented an SUV for my family trip, and it was perfect. Will use this service again!"</p>
                    <p class="text-gray-800 font-bold mt-4">- Jane Smith</p>
                </div>
                <!-- Review 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <p class="text-gray-700 italic">"The staff was friendly, and the rental process was smooth. Thank you!"</p>
                    <p class="text-gray-800 font-bold mt-4">- Emily Johnson</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="py-16 bg-indigo-600">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Have Questions?</h2>
            <p class="text-lg text-white mb-8">Get in touch with us for more information or assistance.</p>
            <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-100 text-indigo-600 font-bold py-3 px-6 rounded-full transition duration-300">
                Contact Us
            </a>
        </div>
    </section>

    <script>
        // Slow down the video playback speed
        document.addEventListener("DOMContentLoaded", function () {
            const video = document.getElementById("hero-video");
            if (video) {
                video.playbackRate = 0.75; // Set playback speed to 50% (adjust as needed)
            }
        });
    </script>
</body>
</html>
@endsection
