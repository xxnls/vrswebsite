@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" style="background-image: url('{{ asset('/storage/app/public/background-image.webp') }}');">
        @foreach ($vehicles['items'] as $vehicle)
            <a href="{{ route('vehicles.show', ['id' => $vehicle['vehicleId']]) }}" class="block">
                <x-vehicle-card :vehicle="$vehicle" />
            </a>
        @endforeach
    </div>
@endsection
