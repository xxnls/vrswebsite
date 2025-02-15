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
</head>
<body class="bg-gray-100 font-sans">
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('{{ asset('/storage/hero.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-white text-center">
            <h1 class="text-5xl font-bold mb-4">Welcome to Our Vehicle Rental Service</h1>
            <p class="text-xl mb-8">Rent the perfect vehicle for your next adventure!</p>
            <a href="{{ route('vehicles.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition duration-300">
                Explore Vehicles
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

    <!-- Call to Action Section -->
    <section class="py-16 bg-indigo-600">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Rent?</h2>
            <p class="text-lg text-white mb-8">Choose from our wide selection of vehicles and enjoy a seamless rental experience.</p>
            <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-indigo-600 font-bold py-3 px-6 rounded-full transition duration-300">
                Get Started
            </a>
        </div>
    </section>
</body>
</html>
@endsection
