<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            @page {
                size: 80mm 297mm;
                margin: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-4 print:bg-white print:p-0">
    <div class="bg-white rounded-lg shadow-lg p-4 max-w-md mx-auto print:shadow-none print:p-2">
        <!-- Header Struk -->
        <div class="text-center mb-4">
            <h2 class="text-lg font-bold text-gray-900">Sabaleh Homestay</h2>
            <p class="text-xs text-gray-600">Jl. Raya Padang-Bukittinggi</p>
            <p class="text-xs text-gray-600">Padang Panjang, Sumatera Barat</p>
            <p class="text-xs text-gray-600">Telp: (0752) 123456</p>
        </div>

        <!-- Nomor Pembayaran dan Tanggal -->
        <div class="border-b border-gray-200 pb-2 mb-2">
            <div class="flex justify-between text-xs">
                <div>
                    <p class="text-gray-600">No. Pembayaran:</p>
                    <p class="font-medium">#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-600">Tanggal Pembayaran:</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Pembayar -->
        <div class="border-b border-gray-200 pb-2 mb-2">
            <h3 class="font-bold mb-1.5 text-xs">Informasi Pembayar</h3>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div>
                    <p class="text-gray-600">Nama:</p>
                    <p class="font-medium">{{ $payment->reservation->user->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email:</p>
                    <p class="font-medium">{{ $payment->reservation->user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Detail Pembayaran -->
        <div class="border-b border-gray-200 pb-2 mb-2">
            <h3 class="font-bold mb-1.5 text-xs">Detail Pembayaran</h3>
            <div class="space-y-1 text-xs">
                <div class="flex justify-between">
                    <span class="text-gray-600">Metode Pembayaran:</span>
                    <span class="font-medium">{{ $payment->paymentMethod->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Tagihan:</span>
                    <span class="font-medium">Rp {{ number_format($payment->reservation->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Jumlah Dibayar:</span>
                    <span class="font-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Status Pembayaran -->
        <div class="text-center mb-4">
            <div class="inline-block px-2 py-1 rounded-full text-xs
                @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($payment->status === 'confirmed') bg-green-100 text-green-800
                @else bg-red-100 text-red-800
                @endif">
                Status: {{ ucfirst($payment->status) }}
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-4 text-center text-xs text-gray-600">
            <p>Terima kasih telah memilih Sabaleh Homestay</p>
            <p class="mt-0.5">Simpan struk ini sebagai bukti pembayaran Anda</p>
            <p class="mt-1 print:block hidden">Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <div class="mt-4 text-center">
        <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Cetak Struk
        </button>
    </div>
</body>
</html>
