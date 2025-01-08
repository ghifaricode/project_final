<x-app-layout>
    <div class="min-h-screen bg-gray-200">
        <!-- Hero Section -->
        <div class="relative h-[70vh]">
            <div class="absolute inset-0">
                <img src="{{ asset('images/welcome_img/logo1.jpg') }}" class="w-full h-full object-cover" alt="Homestay">
                <div class="absolute inset-0 bg-gradient-to-b from-red-900/80 to-black/50"></div>
            </div>
            <div class="relative z-10 flex items-center justify-center h-full text-center">
                <div class="max-w-4xl px-4">
                    <h1 class="text-6xl font-playfair font-bold text-white mb-6 animate-fade-in">
                        Fasilitas & Kamar
                    </h1>
                    <p class="text-2xl text-white/90 mb-8 animate-slide-up">
                        Temukan kenyamanan dalam setiap sudut kamar kami
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Room Types Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach ($rooms as $room)
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden group hover:-translate-y-3 hover:shadow-red-200/50 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('images/room_img/' . $room->image) }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                                alt="{{ $room->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-500">
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $room->name }}</h3>
                            <p class="text-gray-600 mb-6">{{ $room->description }}</p>
                            <div class="space-y-4">
                                <div class="flex items-center text-gray-700 hover:text-red-600 transition">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span>Kapasitas: {{ $room->capacity }} Orang</span>
                                </div>
                                <div class="flex items-center text-gray-700 hover:text-red-600 transition">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Check-in: 14:00 WIB</span>
                                </div>
                                <div class="flex items-center text-gray-700 hover:text-red-600 transition">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Check-out: 12:00 WIB</span>
                                </div>
                            </div>
                            <div class="mt-8 flex justify-between items-center">
                                <p class="text-red-600 text-2xl font-bold">Rp {{ number_format($room->price, 0, ',', '.') }} / malam</p>
                                <a href="{{ route('reservasi', ['selected_room' => $room->id]) }}"
                                    class="px-8 py-3 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transform hover:scale-105 transition duration-300">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Facilities Section -->
            <div class="mt-24">
                <h2 class="text-5xl font-playfair font-bold text-center mb-6 text-gray-800">Fasilitas Umum</h2>
                <p class="text-gray-600 text-center mb-20 text-xl">Berbagai fasilitas untuk kenyamanan Anda</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                    <div class="group">
                        <div class="bg-white p-10 rounded-3xl shadow-xl group-hover:shadow-2xl group-hover:shadow-red-200/50 transform group-hover:-translate-y-3 transition-all duration-500">
                            <div class="text-red-600 text-5xl mb-6">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">WiFi Gratis</h3>
                            <p class="text-gray-600">Koneksi internet cepat</p>
                        </div>
                    </div>
                    <!-- Add more facilities -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
