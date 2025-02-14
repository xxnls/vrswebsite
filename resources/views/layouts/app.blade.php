<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vehicle Rental')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        main {
            min-height: calc(100vh - 153px);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Include NavigationTop Partial -->
    @include('partials.navigation-top')

    <!-- Main Content -->
    <main class="container mx-auto p-4 flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = mobileMenuButton.querySelector('svg');

            mobileMenuButton.addEventListener('click', function () {
                // Toggle mobile menu visibility
                mobileMenu.classList.toggle('hidden');

                // Animate the hamburger icon
                hamburgerIcon.classList.toggle('transform');
                hamburgerIcon.classList.toggle('rotate-90');
            });
        });
    </script>
</body>
</html>
