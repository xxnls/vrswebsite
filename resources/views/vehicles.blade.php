<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Vehicles List</h1>

        @if (isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $error }}
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($vehicles['items'] as $vehicle)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle['vehicleId'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle['vin'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" class="text-blue-500 hover:text-blue-700">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                @if ($vehicles['currentPage'] > 1)
                    <a href="/vehicles?page={{ $vehicles['currentPage'] - 1 }}" class="bg-blue-500 text-white px-4 py-2 rounded">Previous</a>
                @endif

                @if ($vehicles['currentPage'] < ceil($vehicles['totalItemCount'] / $vehicles['pageSize']))
                    <a href="/vehicles?page={{ $vehicles['currentPage'] + 1 }}" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Next</a>
                @endif
            </div>
        @endif
    </div>
</body>
</html>
