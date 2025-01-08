<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sabaleh Homestay</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair+display:700&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                        playfair: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        primary: '#FF2D20',
                        secondary: '#1F2937',
                        accent: '#E5E7EB'
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tambahkan ini untuk membuat body menjadi Alpine.js root -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modalState', () => ({
                loginOpen: false,
                registerOpen: false,
                mobileMenuOpen: false
            }))
        })
    </script>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-200 via-white to-gray-200" x-data>
    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>

    <!-- Include Login & Register Modals -->
    @include('auth.login')
    @include('auth.register')

    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/95 backdrop-blur-lg fixed w-full z-50 shadow-lg border-b border-gray-200" x-data="{ mobileMenuOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <h1 class="text-2xl md:text-3xl font-playfair font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Sabaleh Homestay</h1>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-primary transition-colors duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#rooms" class="text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:scale-105">Kamar</a>
                        <a href="#facilities" class="text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:scale-105">Fasilitas</a>
                        <a href="#gallery" class="text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:scale-105">Galeri</a>
                        <button @click="$dispatch('open-modal', 'login-modal')" class="text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:scale-105">Reservasi</button>
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:scale-105">Dashboard</a>
                                @else
                                    <button @click="$dispatch('open-modal', 'login-modal')" class="px-6 py-2.5 rounded-full border-2 border-primary text-primary font-medium hover:bg-primary hover:text-white transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                        Login
                                    </button>
                                    @if (Route::has('register'))
                                        <button @click="$dispatch('open-modal', 'register-modal')" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-primary to-red-600 text-white font-medium hover:from-primary hover:to-primary transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                                            Register
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Mobile menu -->
                <div x-show="mobileMenuOpen" class="md:hidden" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
                    <div class="pt-2 pb-4 space-y-1">
                        <a href="#rooms" class="block px-4 py-2 text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:bg-gray-50">Kamar</a>
                        <a href="#facilities" class="block px-4 py-2 text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:bg-gray-50">Fasilitas</a>
                        <a href="#gallery" class="block px-4 py-2 text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:bg-gray-50">Galeri</a>
                        <button @click="$dispatch('open-modal', 'login-modal')" class="block w-full text-left px-4 py-2 text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:bg-gray-50">Reservasi</button>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:text-primary font-medium transition-all duration-300 hover:bg-gray-50">Dashboard</a>
                            @else
                                <button @click="$dispatch('open-modal', 'login-modal')" class="block w-full px-4 py-2 text-primary font-medium hover:bg-primary/10 transition-all duration-300">
                                    Login
                                </button>
                                @if (Route::has('register'))
                                    <button @click="$dispatch('open-modal', 'register-modal')" class="block w-full px-4 py-2 text-primary font-medium hover:bg-primary/10 transition-all duration-300">
                                        Register
                                    </button>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative h-screen">
            <div class="absolute inset-0">
                <img src="{{ asset('images/welcome_img/logo1.jpg') }}"
                    class="w-full h-full object-cover" alt="Homestay">
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/40 backdrop-blur-[2px]"></div>
            </div>
            <div class="relative z-10 flex items-center justify-center h-full text-center" data-aos="fade-up" data-aos-duration="1000">
                <div class="max-w-4xl px-4">
                    <h1 class="text-4xl md:text-6xl font-playfair font-bold text-white mb-8 leading-tight drop-shadow-lg">
                        Nikmati Kenyamanan Seperti di Rumah Sendiri
                    </h1>
                    <p class="text-xl md:text-2xl text-white/90 mb-12 font-light drop-shadow-md">
                        Pengalaman menginap yang nyaman dengan suasana homey dan pelayanan ramah
                    </p>
                    <button @click="$dispatch('open-modal', 'login-modal')"
                        class="px-8 md:px-10 py-3 md:py-4 bg-gradient-to-r from-primary to-red-600 text-white rounded-full text-lg font-medium 
                        hover:from-primary hover:to-primary transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1
                        hover:scale-105 backdrop-blur-sm">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Rooms Section -->
        <div id="rooms" class="py-24 bg-gradient-to-b from-gray-200 via-white to-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-playfair font-bold text-center mb-4 text-gray-800" data-aos="fade-up">Pilihan Kamar</h2>
                <p class="text-gray-600 text-center mb-16 text-lg" data-aos="fade-up" data-aos-delay="100">Temukan kamar yang sesuai dengan kebutuhan Anda</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($rooms as $room)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-2 transition-all duration-300
                        hover:shadow-2xl backdrop-blur-lg" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('images/room_img/' . $room->image) }}"
                                class="w-full h-56 object-cover group-hover:scale-110 transition duration-500"
                                alt="{{ $room->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent 
                                opacity-0 group-hover:opacity-100 transition duration-300">
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $room->name }}</h3>
                            <p class="text-gray-600 mb-6">{{ $room->description }}</p>
                            <div class="flex justify-between items-center">
                                <p class="text-primary text-xl font-bold">Rp {{ number_format($room->price, 0, ',', '.') }} / malam</p>
                                <button @click="$dispatch('open-modal', 'login-modal')" 
                                    class="text-primary font-medium hover:underline group-hover:translate-x-2 transition-all duration-300">
                                    Pesan →
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div id="gallery" class="py-24 bg-gradient-to-t from-gray-200 via-white to-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-playfair font-bold text-center mb-4" data-aos="fade-up">Galeri Homestay</h2>
                <p class="text-gray-600 text-center mb-16 text-lg" data-aos="fade-up" data-aos-delay="100">Lihat keindahan dan kenyamanan homestay kami</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @for($i = 2; $i <= 13; $i++)
                    <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up" data-aos-delay="{{ ($i-2) * 50 }}">
                        <img src="{{ asset('images/welcome_img/logo'.$i.'.png') }}" alt="Homestay"
                            class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-center justify-center">
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Facilities Section -->
        <div id="facilities" class="py-24 bg-gradient-to-b from-gray-200 via-white to-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-playfair font-bold text-center mb-4 text-gray-800" data-aos="fade-up">Fasilitas Kami</h2>
                <p class="text-gray-600 text-center mb-16 text-lg" data-aos="fade-up" data-aos-delay="100">Berbagai fasilitas untuk kenyamanan Anda</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
                    <div class="group" data-aos="fade-up" data-aos-delay="200">
                        <div class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-lg 
                            group-hover:shadow-xl transform group-hover:-translate-y-2 
                            transition-all duration-300 border border-gray-200">
                            <div class="text-primary text-4xl mb-4">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">WiFi Gratis</h3>
                            <p class="text-gray-600">Koneksi internet cepat</p>
                        </div>
                    </div>
                    <!-- Add more facility cards -->
                </div>
            </div>
        </div>

        <!-- Booking Section -->
        <div id="booking" class="py-24 bg-gradient-to-b from-gray-200 via-white to-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-playfair font-bold text-center mb-4 text-gray-800" data-aos="fade-up">Buat Reservasi</h2>
                <p class="text-gray-600 text-center mb-16 text-lg" data-aos="fade-up" data-aos-delay="100">Pesan kamar Anda sekarang</p>
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 max-w-4xl mx-auto 
                    border border-gray-200 hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <form class="space-y-8">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-in</label>
                                <input type="date"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition-all duration-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-out</label>
                                <input type="date"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition-all duration-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Tamu</label>
                                <input type="number" min="1"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition-all duration-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Kamar</label>
                                <select
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition-all duration-300">
                                    @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-center pt-4">
                            <button type="button" @click="$dispatch('open-modal', 'login-modal')"
                                class="px-8 py-4 bg-gradient-to-r from-primary to-red-600 text-white rounded-lg text-lg font-medium 
                                hover:from-primary hover:to-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 
                                transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gradient-to-b from-gray-900 to-black text-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div data-aos="fade-up">
                        <h3 class="text-2xl font-playfair font-bold mb-6 bg-gradient-to-r from-primary to-red-600 bg-clip-text text-transparent">Sabaleh Homestay</h3>
                        <p class="text-gray-400 leading-relaxed">Jl. Contoh No. 123<br>Kota, Provinsi<br>Indonesia</p>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-2xl font-playfair font-bold mb-6">Kontak</h3>
                        <p class="text-gray-400 leading-relaxed">Tel: +62 123 4567 890<br>Email: info@sabalehhomestay.com</p>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-2xl font-playfair font-bold mb-6">Ikuti Kami</h3>
                        <div class="flex space-x-6">
                            <!-- Social media icons -->
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                    <p class="text-gray-400">&copy; 2024 Sabaleh Homestay. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
