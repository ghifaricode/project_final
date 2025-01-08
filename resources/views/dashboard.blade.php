<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-200 via-white to-gray-200">
        <!-- Hero Section -->
        <div class="relative h-[70vh]">
            <div class="absolute inset-0">
                <img src="{{ asset('images/welcome_img/logo1.jpg') }}"
                    class="w-full h-full object-cover" alt="Homestay">
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/40 backdrop-blur-[2px]"></div>
            </div>
            <div class="relative z-10 flex items-center justify-center h-full text-center" data-aos="fade-up" data-aos-duration="1000">
                <div class="max-w-4xl px-4">
                    <h1 class="text-5xl md:text-6xl font-playfair font-bold text-white mb-6 leading-tight drop-shadow-lg">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-xl md:text-2xl text-white/90 mb-8 font-light drop-shadow-md">
                        Nikmati pengalaman menginap yang nyaman bersama kami
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Reservation Form -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 -mt-32 relative z-20 mb-12 border border-gray-200 hover:shadow-2xl transition-all duration-300">
                <h2 class="text-3xl font-playfair font-bold text-center mb-2 bg-gradient-to-r from-primary to-red-600 bg-clip-text text-transparent">Buat Reservasi</h2>
                <p class="text-gray-600 text-center mb-8">Pesan kamar Anda sekarang</p>

                <form class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                            <option>Standard Room</option>
                            <option>Deluxe Room</option>
                            <option>Family Room</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex justify-center pt-4">
                        <button type="submit"
                            class="px-8 py-4 bg-gradient-to-r from-primary to-red-600 text-white rounded-lg text-lg font-medium 
                            hover:from-primary hover:to-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 
                            transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl">
                            Pesan Sekarang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Recent Reservations -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-gray-200 hover:shadow-2xl transition-all duration-300">
                <h3 class="text-2xl font-playfair font-bold mb-6 bg-gradient-to-r from-primary to-red-600 bg-clip-text text-transparent">Riwayat Reservasi Terakhir</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Reservasi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Kamar</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Tamu</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-200">
                            @forelse($reservations as $reservation)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $reservation->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $reservation->room->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $reservation->total_guests }} Orang</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-4 py-1.5 rounded-full text-sm font-medium inline-flex items-center justify-center
                                        @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('status-reservasi') }}"
                                        class="text-primary hover:text-red-600 text-sm font-medium transition-colors duration-200">
                                        Lihat Detail →
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Belum ada riwayat reservasi
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
