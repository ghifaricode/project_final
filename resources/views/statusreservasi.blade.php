<x-app-layout>
    <div class="min-h-screen bg-gray-200 pt-20">
        <!-- Hero Section -->
        <div class="relative h-[40vh]">
            <div class="absolute inset-0">
                <img src="{{ asset('images/welcome_img/logo1.jpg') }}" class="w-full h-full object-cover" alt="Homestay">
                <div class="absolute inset-0 bg-gradient-to-b from-red-900/80 to-black/70"></div>
            </div>
            <div class="relative z-10 flex items-center justify-center h-full text-center">
                <div class="max-w-4xl px-4">
                    <h1 class="text-6xl font-playfair font-bold text-white mb-4 tracking-tight">
                        Status Reservasi
                    </h1>
                    <p class="text-xl text-white/90 mb-8 font-light">
                        Pantau status reservasi dan lakukan pembayaran dengan mudah
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Reservations List -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 -mt-20 relative z-20">
                @forelse($reservations as $reservation)
                    <div class="border-b border-gray-200 pb-8 mb-8 last:border-0 last:pb-0 last:mb-0 hover:bg-gray-50/50 rounded-xl transition duration-300 p-4">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $reservation->room->name }}</h3>
                                    <span
                                        class="px-4 py-1.5 rounded-full text-sm font-medium tracking-wide
                                        @if ($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Check-in: {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }} -
                                    Check-out: {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}
                                </p>
                                <p class="text-gray-600 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    {{ $reservation->total_guests }} Tamu
                                </p>
                                <p class="text-xl font-bold text-red-600">
                                    Total: Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 flex flex-col gap-4 lg:min-w-[300px]">
                                <!-- Payment Section -->
                                @if ($reservation->status === 'pending')
                                    @if ($reservation->payment)
                                        <div class="w-full bg-yellow-50 p-6 rounded-2xl border border-yellow-200">
                                            <p class="text-yellow-800 font-semibold">Menunggu konfirmasi pembayaran</p>
                                            <p class="text-sm text-yellow-600 mt-2">Bukti pembayaran sedang diverifikasi</p>
                                        </div>
                                    @else
                                        <div class="w-full space-y-4">
                                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                                                <h4 class="font-semibold text-gray-900 mb-3">Informasi Pembayaran</h4>
                                                <select id="payment-method-select-{{ $reservation->id }}"
                                                    name="payment_method_id"
                                                    class="w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500 mb-3">
                                                    @foreach ($paymentMethods as $method)
                                                        <option value="{{ $method->id }}"
                                                            data-account="{{ $method->account_number }}"
                                                            data-name="{{ $method->account_name }}">
                                                            {{ $method->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-sm text-gray-600">Transfer ke:</p>
                                                <p class="font-medium text-lg" id="account-number-{{ $reservation->id }}">
                                                    {{ $paymentMethods[0]->account_number }}</p>
                                                <p class="text-sm text-gray-600 mt-1"
                                                    id="account-name-{{ $reservation->id }}">
                                                    a.n {{ $paymentMethods[0]->account_name }}</p>
                                            </div>
                                            <form action="{{ route('reservations.upload-payment', $reservation->id) }}"
                                                method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                <input type="hidden" name="payment_method_id"
                                                    id="selected-payment-method-{{ $reservation->id }}">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Upload Bukti Pembayaran
                                                    </label>
                                                    <input type="file" name="payment_proof" accept="image/*" required
                                                        class="w-full text-sm text-gray-500
                                                            file:mr-4 file:py-2.5 file:px-4
                                                            file:rounded-full file:border-0
                                                            file:text-sm file:font-semibold
                                                            file:bg-red-50 file:text-red-600
                                                            hover:file:bg-red-100 transition duration-300">
                                                </div>
                                                <button type="submit"
                                                    class="w-full px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition duration-300 font-medium">
                                                    Upload Bukti Pembayaran
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @elseif($reservation->status === 'confirmed')
                                    <div class="w-full bg-green-50 p-6 rounded-2xl border border-green-200">
                                        <p class="text-green-800 font-semibold">Pembayaran Dikonfirmasi</p>
                                        <p class="text-sm text-green-600 mt-2">Reservasi Anda telah dikonfirmasi</p>
                                    </div>
                                @else
                                    <div class="w-full bg-red-50 p-6 rounded-2xl border border-red-200">
                                        <p class="text-red-800 font-semibold">Reservasi Dibatalkan</p>
                                        <p class="text-sm text-red-600 mt-2">Silahkan hubungi admin untuk informasi lebih lanjut</p>
                                    </div>
                                @endif

                                <!-- Tombol Cetak Struk -->
                                <button onclick="showReceipt('receipt-{{ $reservation->id }}')"
                                    class="w-full px-6 py-3 bg-black text-white rounded-xl hover:bg-gray-800 transition duration-300 flex items-center justify-center font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Cetak Struk
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Struk -->
                    <div id="receipt-{{ $reservation->id }}"
                        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[9999] hidden">
                        <div class="min-h-screen flex items-start justify-center p-4">
                            <div
                                class="relative bg-white rounded-2xl max-w-xl w-full max-h-[85vh] overflow-y-auto mt-24 shadow-2xl">
                                <!-- Tombol Close -->
                                <button onclick="hideReceipt('receipt-{{ $reservation->id }}')"
                                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-[10000]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Struk Content -->
                                <div class="p-6" id="receipt-content-{{ $reservation->id }}">
                                    <x-reservation-receipt :reservation="$reservation" />

                                    <!-- Tombol Print -->
                                    <div class="mt-6 flex justify-center print:hidden">
                                        <button onclick="printReceipt('receipt-content-{{ $reservation->id }}')"
                                            class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition duration-300 flex items-center text-sm font-medium">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Print Struk
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Belum ada reservasi</h3>
                        <p class="mt-2 text-gray-500">Mulai pesan kamar sekarang!</p>
                        <div class="mt-8">
                            <a href="{{ route('reservasi') }}"
                                class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700 transition duration-300">
                                Buat Reservasi
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Script untuk Modal dan Print -->
    <script>
        function showReceipt(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideReceipt(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function printReceipt(id) {
            const printContents = document.getElementById(id).innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Reinitialize event listeners after printing
            initializeEventListeners();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.fixed');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                });
            }
        });
    </script>
</x-app-layout>

<script>
    @foreach ($reservations as $reservation)
        document.getElementById('payment-method-select-{{ $reservation->id }}').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('account-number-{{ $reservation->id }}').textContent = selectedOption
                .dataset.account;
            document.getElementById('account-name-{{ $reservation->id }}').textContent = 'a.n ' +
                selectedOption.dataset.name;
            document.getElementById('selected-payment-method-{{ $reservation->id }}').value = this.value;
        });
        // Set initial value
        document.getElementById('selected-payment-method-{{ $reservation->id }}').value = document.getElementById(
            'payment-method-select-{{ $reservation->id }}').value;
    @endforeach
</script>
