@extends('layouts.app')
@section('title', 'My Rentals')
@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white dark:bg-gray-900 rounded-xl shadow-2xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">My Rentals</h1>
    @if (!$rentals)
        <p class="text-gray-700 dark:text-gray-300">You have no active rentals.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" style="border-spacing: 0 10px; border-collapse: separate;">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Vehicle
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Rental Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Payment Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Deposit Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Start Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            End Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Deposit
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Damage Fee
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Final Cost
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($rentals as $rental)
                        <tr class="transition-all hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg overflow-hidden" style="margin-bottom: 10px;">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white"
                                style="background-image: url('{{ $rental['vehicle']['vehicleModel']['imageUrl'] }}');
                                       background-size: cover;
                                       background-position: center center;
                                       width: 100px;
                                       border-radius: 15px;">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $rental['vehicle']['vehicleModel']['name'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                @switch($rental['rentalStatus'])
                                    @case('AwaitingPickup')
                                        Awaiting Pickup
                                        @break
                                    @case('InProgress')
                                        In Progress
                                        @break
                                    @default
                                        {{ $rental['rentalStatus'] }}
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $rental['paymentStatus'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                @switch($rental['depositStatus'])
                                    @case('FullyRefunded')
                                        Fully Refunded
                                        @break
                                    @case('PartiallyRefunded')
                                        Partially Refunded
                                        @break
                                    @case('NotTaken')
                                        Not Taken
                                        @break
                                    @case('FullyTaken')
                                        Fully Taken
                                        @break
                                    @default
                                        {{ $rental['depositStatus'] }}
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($rental['startDate'])->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($rental['endDate'])->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                ${{ number_format($rental['depositAmount'], 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                ${{ number_format($rental['damageFee'], 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                ${{ number_format($rental['finalCost'], 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
