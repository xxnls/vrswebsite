<nav class="bg-gray-100 shadow-md">
    <div class="w-full px-0"> <!-- Remove padding -->
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('/storage/logo.png') }}" alt="Vehicle Rental System" class="h-28 drop-shadow-lg">
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex space-x-4 items-center mr-4">
                <a href="/vehicles" class="mt-2 text-white transition duration-300 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:focus:ring-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Rentals</a>
                <a href="/contact" class="mt-2 text-white transition duration-300 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:focus:ring-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Contact</a>
                <!-- Show Login/Register buttons only if the user is NOT logged in -->
                @unless(Session::has('token'))
                    <a href="/login" class="mt-2 text-white transition duration-300 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:focus:ring-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Login</a>
                    <a href="/register" class="mt-2 text-white transition duration-300 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:focus:ring-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Register</a>
                @endunless
                <!-- Show Logout button and user info if the user is logged in -->
                @if(Session::has('token'))
                <a href="{{ route('dashboard') }}">
                    <button type="button" class="mt-2 text-white transition duration-300 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:focus:ring-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{ Session::get('customer')['firstName'] ?? '' }} {{ Session::get('customer')['lastName'] ?? '' }}
                    </button>
                </a>
                    {{-- <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" style="margin-top: 2px;" class="text-white transition duration-300 bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center me-2 mb-1">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                            </svg>
                        </button>
                    </form> --}}
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden mr-4">
                <button type="button" class="text-gray-800 hover:text-blue-500 focus:outline-none transition duration-300" id="mobile-menu-button">
                    <!-- Animated Hamburger Icon -->
                    <svg class="h-8 w-8 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Links (Mobile) -->
        <div class="hidden md:hidden bg-white shadow-lg rounded-lg mt-0 mb-0" id="mobile-menu"> <!-- Remove margin -->
            <a href="/vehicles" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Rentals</a>
            <a href="/contact" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Contact</a>

            <!-- Show Login/Register buttons only if the user is NOT logged in -->
            @unless(Session::has('token'))
                <a href="/login" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Login</a>
                <a href="/register" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Register</a>
            @endunless

            <!-- Show Logout button and user info if the user is logged in -->
            @if(Session::has('token'))
                <a href="/dashboard" class="block py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">{{ Session::get('customer')['firstName'] ?? '' }} {{ Session::get('customer')['lastName'] ?? '' }}</a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left py-3 px-4 text-gray-800 hover:bg-blue-50 hover:text-blue-500 transition duration-300">Logout</button>
                </form>
            @endif
        </div>
    </div>
</nav>
