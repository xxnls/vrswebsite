<nav class="bg-gray-100 shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('/storage/logo.png') }}" alt="Vehicle Rental System" class="h-28 drop-shadow-lg">
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex space-x-4 items-center">
                <a href="/vehicles" class="text-gray-800 hover:text-blue-500 transition duration-300">Vehicles</a>
                <a href="/about" class="text-gray-800 hover:text-blue-500 transition duration-300">About</a>
                <a href="/contact" class="text-gray-800 hover:text-blue-500 transition duration-300">Contact</a>

                <!-- Show Login/Register buttons only if the user is NOT logged in -->
                @unless(Session::has('token'))
                    <a href="/login" class="text-gray-800 hover:text-blue-500 transition duration-300">Login</a>
                    <a href="/register" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Register</a>
                @endunless

                <!-- Show Logout button and user info if the user is logged in -->
                @if(Session::has('token'))
                <a href="{{ route('dashboard') }}">
                    <button type="button" class="mt-2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{ Session::get('customer')['firstName'] ?? '' }} {{ Session::get('customer')['lastName'] ?? '' }}
                    </button>
                </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-800 hover:text-blue-500 transition duration-300">Logout</button>
                    </form>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-800 hover:text-blue-500 focus:outline-none transition duration-300" id="mobile-menu-button">
                    <!-- Animated Hamburger Icon -->
                    <svg class="h-8 w-8 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Links (Mobile) -->
        <div class="hidden md:hidden bg-white shadow-lg rounded-lg mt-2 mb-2" id="mobile-menu">
            <a href="/vehicles" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Vehicles</a>
            <a href="/about" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">About</a>
            <a href="/contact" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Contact</a>

            <!-- Show Login/Register buttons only if the user is NOT logged in -->
            @unless(Session::has('token'))
                <a href="/login" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Login</a>
                <a href="/register" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Register</a>
            @endunless

            <!-- Show Logout button and user info if the user is logged in -->
            @if(Session::has('token'))
                <span class="block py-3 px-4 text-gray-800">{{ Session::get('customer')['firstName'] ?? '' }} {{ Session::get('customer')['lastName'] ?? '' }}</span>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Logout</button>
                </form>
            @endif
        </div>
    </div>
</nav>
