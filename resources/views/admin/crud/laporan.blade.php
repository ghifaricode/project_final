@extends('admin.index')
@include('admin.layouts.notification')

@section('main')
{{-- Heading --}}
<div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <div class="w-full">
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-gray-700 transition-colors hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                        <svg class="w-5 h-5 mr-2.5 transition-transform hover:scale-110" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500">{{ $title }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white">Laporan Homestay</h1>
    </div>
</div>

{{-- Statistik Umum --}}
<div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-4">
    <div class="p-6 transition-all duration-300 bg-white rounded-xl shadow-lg hover:shadow-xl dark:bg-gray-800 hover:scale-105">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Users</h3>
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <p class="mt-4 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($total_users) }}</p>
    </div>

    <div class="p-6 transition-all duration-300 bg-white rounded-xl shadow-lg hover:shadow-xl dark:bg-gray-800 hover:scale-105">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Rooms</h3>
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </div>
        <p class="mt-4 text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($total_rooms) }}</p>
    </div>

    <div class="p-6 transition-all duration-300 bg-white rounded-xl shadow-lg hover:shadow-xl dark:bg-gray-800 hover:scale-105">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Reservations</h3>
            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <p class="mt-4 text-3xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($total_reservations) }}</p>
    </div>

    <div class="p-6 transition-all duration-300 bg-white rounded-xl shadow-lg hover:shadow-xl dark:bg-gray-800 hover:scale-105">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Payments</h3>
            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="mt-4 text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ number_format($total_payments) }}</p>
    </div>
</div>

{{-- Pendapatan Bulanan --}}
<div class="p-6">
    <div class="p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Pendapatan Bulanan</h3>
            <div class="p-2 bg-blue-100 rounded-lg dark:bg-blue-900">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs font-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 rounded-l-lg">Bulan</th>
                        <th class="px-6 py-4 rounded-r-lg">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($monthly_income as $income)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4 font-medium text-gray-200">{{ $income->month }}</td>
                        <td class="px-6 py-4 font-semibold text-green-600 dark:text-green-400">
                            Rp {{ number_format($income->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Kamar Populer --}}
<div class="p-6">
    <div class="p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Kamar Populer</h3>
            <div class="p-2 bg-purple-100 rounded-lg dark:bg-purple-900">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs font-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 rounded-l-lg">Nama Kamar</th>
                        <th class="px-6 py-4 rounded-r-lg">Jumlah Reservasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($popular_rooms as $room)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4 font-medium text-gray-200">{{ $room->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-300">
                                {{ $room->reservations_count }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Status Reservasi --}}
<div class="p-6">
    <div class="p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Status Reservasi</h3>
            <div class="p-2 bg-green-100 rounded-lg dark:bg-green-900">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs font-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 rounded-l-lg">Status</th>
                        <th class="px-6 py-4 rounded-r-lg">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($reservation_status as $status)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4 font-medium text-gray-200 capitalize">{{ $status->status }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                                {{ $status->total }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Metode Pembayaran --}}
<div class="p-6">
    <div class="p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Penggunaan Metode Pembayaran</h3>
            <div class="p-2 bg-yellow-100 rounded-lg dark:bg-yellow-900">
                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs font-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 rounded-l-lg">Metode Pembayaran</th>
                        <th class="px-6 py-4 rounded-r-lg">Jumlah Penggunaan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($payment_methods_usage as $method)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4 font-medium text-gray-200">{{ $method->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                {{ $method->payments_count }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Tombol Export --}}
<div class="flex gap-4 p-6">
    <a href="{{ route('admin.laporan.pdf') }}" class="inline-flex items-center px-6 py-3 text-white transition-colors duration-200 bg-red-600 rounded-lg shadow-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
        </svg>
        Export PDF
    </a>
</div>

@endsection
