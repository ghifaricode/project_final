<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md fixed w-full z-50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="text-3xl font-playfair font-bold text-primary">
                    Sabaleh Homestay
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-700 hover:text-primary font-medium transition duration-300 {{ request()->routeIs('dashboard') ? 'text-primary' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('fasilitas') }}"
                    class="text-gray-700 hover:text-primary font-medium transition duration-300 {{ request()->routeIs('fasilitas') ? 'text-primary' : '' }}">
                    Fasilitas & Kamar
                </a>
                <a href="{{ route('reservasi') }}"
                    class="text-gray-700 hover:text-primary font-medium transition duration-300 {{ request()->routeIs('reservasi') ? 'text-primary' : '' }}">
                    Reservasi
                </a>
                <a href="{{ route('status-reservasi') }}"
                    class="text-gray-700 hover:text-primary font-medium transition duration-300 {{ request()->routeIs('status-reservasi') ? 'text-primary' : '' }}">
                    Status Reservasi
                </a>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 px-6 py-2.5 rounded-full border-2 border-primary text-primary hover:bg-primary hover:text-white transition duration-300">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300">
                            Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="text-gray-700 hover:text-primary">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300 {{ request()->routeIs('dashboard') ? 'bg-primary/5 text-primary' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('fasilitas') }}"
                class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300 {{ request()->routeIs('fasilitas') ? 'bg-primary/5 text-primary' : '' }}">
                Fasilitas & Kamar
            </a>
            <a href="{{ route('reservasi') }}"
                class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300 {{ request()->routeIs('reservasi') ? 'bg-primary/5 text-primary' : '' }}">
                Reservasi
            </a>
            <a href="{{ route('status-reservasi') }}"
                class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300 {{ request()->routeIs('status-reservasi') ? 'bg-primary/5 text-primary' : '' }}">
                Status Reservasi
            </a>
            <a href="{{ route('profile.edit') }}"
                class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300">
                Profil Saya
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition duration-300">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Include Login & Register Modals -->
@include('auth.login')
@include('auth.register')
