@props(['reservation'])

<div class="bg-white rounded-lg shadow-lg p-4 max-w-md mx-auto print:shadow-none print:p-0">
    <!-- Header Struk -->
    <div class="text-center mb-4">
        <h2 class="text-lg font-playfair font-bold text-gray-900">Sabaleh Homestay</h2>
        <p class="text-xs text-gray-600">Jl. Raya Padang-Bukittinggi</p>
        <p class="text-xs text-gray-600">Padang Panjang, Sumatera Barat</p>
        <p class="text-xs text-gray-600">Telp: (0752) 123456</p>
    </div>

    <!-- Nomor Reservasi dan Tanggal -->
    <div class="border-b border-gray-200 pb-2 mb-2">
        <div class="flex justify-between text-xs">
            <div>
                <p class="text-gray-600">No. Reservasi:</p>
                <p class="font-medium">#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="text-right">
                <p class="text-gray-600">Tanggal:</p>
                <p class="font-medium">{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Informasi Tamu -->
    <div class="border-b border-gray-200 pb-2 mb-2">
        <h3 class="font-bold mb-1.5 text-xs">Informasi Tamu</h3>
        <div class="grid grid-cols-2 gap-2 text-xs">
            <div>
                <p class="text-gray-600">Nama:</p>
                <p class="font-medium">{{ $reservation->user->name }}</p>
            </div>
            <div>
                <p class="text-gray-600">Email:</p>
                <p class="font-medium">{{ $reservation->user->email }}</p>
            </div>
            <div>
                <p class="text-gray-600">Telepon:</p>
                <p class="font-medium">{{ $reservation->user->phone }}</p>
            </div>
            <div>
                <p class="text-gray-600">Jumlah Tamu:</p>
                <p class="font-medium">{{ $reservation->total_guests }} Orang</p>
            </div>
        </div>
    </div>

    <!-- Detail Reservasi -->
    <div class="border-b border-gray-200 pb-2 mb-2">
        <h3 class="font-bold mb-1.5 text-xs">Detail Reservasi</h3>
        <div class="space-y-1 text-xs">
            <div class="flex justify-between">
                <span class="text-gray-600">Tipe Kamar:</span>
                <span class="font-medium">{{ $reservation->room->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Check-in:</span>
                <span class="font-medium">{{ $reservation->check_in->format('d/m/Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Check-out:</span>
                <span class="font-medium">{{ $reservation->check_out->format('d/m/Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Durasi:</span>
                <span class="font-medium">{{ $reservation->check_in->diffInDays($reservation->check_out) }} Malam</span>
            </div>
        </div>
    </div>

    <!-- Rincian Pembayaran -->
    <div class="border-b border-gray-200 pb-2 mb-2">
        <h3 class="font-bold mb-1.5 text-xs">Rincian Pembayaran</h3>
        <div class="space-y-1 text-xs">
            <div class="flex justify-between">
                <span class="text-gray-600">Harga per Malam:</span>
                <span class="font-medium">Rp {{ number_format($reservation->room->price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Jumlah Malam:</span>
                <span class="font-medium">{{ $reservation->check_in->diffInDays($reservation->check_out) }}
                    Malam</span>
            </div>
            <div class="flex justify-between font-bold text-sm mt-2">
                <span>Total:</span>
                <span>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Status Pembayaran -->
    <div class="text-center">
        <div
            class="inline-block px-2 py-1 rounded-full text-xs
            @if ($reservation->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
            @else bg-red-100 text-red-800 @endif">
            Status: {{ ucfirst($reservation->status) }}
        </div>
        @if ($reservation->payment)
            <p class="text-xs text-gray-600 mt-1">
                Pembayaran via {{ $reservation->payment->paymentMethod->name }}
            </p>
        @endif
    </div>

    <!-- Footer -->
    <div class="mt-4 text-center text-xs text-gray-600">
        <p>Terima kasih telah memilih Sabaleh Homestay</p>
        <p class="mt-0.5">Simpan struk ini sebagai bukti reservasi Anda</p>
        <p class="mt-1 print:block hidden">Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</div>
