<x-app-layout>
    <div class="min-h-screen bg-gray-200">
        <!-- Hero Section -->
        <div class="relative h-[70vh]">
            <div class="absolute inset-0">
                <img src="{{ asset('images/welcome_img/logo1.jpg') }}" class="w-full h-full object-cover" alt="Homestay">
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 to-red-900/50"></div>
            </div>
            <div class="relative z-10 flex items-center justify-center h-full text-center">
                <div class="max-w-4xl px-4">
                    <h1 class="text-6xl font-playfair font-bold text-white mb-6 tracking-wider">
                        Buat Reservasi
                    </h1>
                    <p class="text-2xl text-white/90 mb-8 font-light">
                        Pesan kamar Anda sekarang untuk pengalaman menginap terbaik
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Reservation Form -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-10 -mt-40 relative z-20 mb-12 border border-gray-100">
                <form action="{{ route('reservations.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Tipe Kamar</label>
                            <select name="room_id" id="room_id" required onchange="updateCapacity(this)"
                                class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 transition-all duration-300">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" data-capacity="{{ $room->capacity }}" {{ isset($selectedRoom) && $selectedRoom == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} - Rp {{ number_format($room->price, 0, ',', '.') }}/malam
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Jumlah Tamu</label>
                            <input type="number" name="total_guests" id="total_guests" readonly
                                class="w-full rounded-xl border-2 border-gray-200 bg-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500 cursor-not-allowed">
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Check-in</label>
                            <input type="date" name="check_in" required
                                class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 transition-all duration-300">
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Check-out</label>
                            <input type="date" name="check_out" required
                                class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 transition-all duration-300">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Catatan Tambahan</label>
                            <textarea name="notes" rows="3"
                                class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 transition-all duration-300"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-center pt-8">
                        <button type="submit"
                            class="px-12 py-4 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 active:translate-y-0">
                            Buat Reservasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Information Section -->
            <div class="bg-black/90 backdrop-blur-sm text-white rounded-2xl shadow-2xl p-8">
                <h3 class="text-2xl font-bold mb-8">Informasi Penting</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Waktu Check-in/Check-out</h4>
                                <p class="text-gray-300">Check-in: 14:00 WIB<br>Check-out: 12:00 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Metode Pembayaran</h4>
                                <p class="text-gray-300">Transfer bank dan QRIS tersedia</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Kebijakan Pembatalan</h4>
                                <p class="text-gray-300">Pembatalan gratis hingga 24 jam sebelum check-in</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Perhatian</h4>
                                <p class="text-gray-300">Harap membawa identitas yang valid saat check-in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateCapacity(select) {
            const selectedOption = select.options[select.selectedIndex];
            const capacity = selectedOption.getAttribute('data-capacity');
            document.getElementById('total_guests').value = capacity;
        }

        window.onload = function() {
            const roomSelect = document.getElementById('room_id');
            updateCapacity(roomSelect);
        }
    </script>
</x-app-layout>
