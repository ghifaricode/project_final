@extends('admin.index')

@section('main')
<div class="px-4 pt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-blue-500 dark:text-blue-500 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-500 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Total Admin
        </h3>
        <div class="mt-4">
            <span class="text-3xl font-bold text-blue-500 dark:text-blue-500">{{ $totalAdmins ?? '0' }}</span>
        </div>
    </div>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-green-500 dark:text-green-500 flex items-center">
            <svg class="w-6 h-6 mr-2 text-green-500 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Total User
        </h3>
        <div class="mt-4">
            <span class="text-3xl font-bold text-green-500 dark:text-green-500">{{ $totalUsers ?? '0' }}</span>
        </div>
    </div>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-purple-500 dark:text-purple-500 flex items-center">
            <svg class="w-6 h-6 mr-2 text-purple-500 dark:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            Total Room
        </h3>
        <div class="mt-4">
            <span class="text-3xl font-bold text-purple-500 dark:text-purple-500">{{ $totalRooms ?? '0' }}</span>
        </div>
    </div>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-red-500 dark:text-red-500 flex items-center">
            <svg class="w-6 h-6 mr-2 text-red-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            Total Reservasi
        </h3>
        <div class="mt-4">
            <span class="text-3xl font-bold text-red-500 dark:text-red-500">{{ $totalReservasi ?? '0' }}</span>
        </div>
    </div>
</div>

<!-- Statistik Pemesanan Kamar -->
<div class="px-4 pt-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
    <!-- Chart Pemesanan per Kamar -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Statistik Pemesanan per Kamar</h3>
        <div class="chart-container" style="position: relative; height:300px; width:100%">
            <canvas id="roomBookingChart"></canvas>
        </div>
    </div>

    <!-- Tabel Detail Pemesanan -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Detail Pemesanan Kamar</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Kamar</th>
                        <th scope="col" class="px-6 py-3">Total Pemesanan</th>
                        <th scope="col" class="px-6 py-3">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roomStats ?? [] as $stat)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $stat->room_name ?? '0' }}</td>
                        <td class="px-6 py-4">{{ $stat->total_bookings ?? '0' }}</td>
                        <td class="px-6 py-4">{{ number_format($stat->percentage ?? 0, 1) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Trend Pemesanan -->
<div class="px-4 pt-6 pb-6">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Trend Pemesanan Bulanan</h3>
        <div class="chart-container" style="position: relative; height:300px; width:100%">
            <canvas id="bookingTrendChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    try {
        const roomStats = {!! json_encode($roomStats ?? []) !!};
        const monthlyStats = {!! json_encode($monthlyStats ?? []) !!};
        
        // Warna-warna modern untuk chart
        const colors = {
            blue: {
                fill: 'rgba(59, 130, 246, 0.2)',
                stroke: 'rgba(59, 130, 246, 1)'
            },
            green: {
                fill: 'rgba(16, 185, 129, 0.2)',
                stroke: 'rgba(16, 185, 129, 1)'
            }
        };

        // Chart Pemesanan Kamar
        if (document.getElementById('roomBookingChart')) {
            const roomCtx = document.getElementById('roomBookingChart').getContext('2d');
            new Chart(roomCtx, {
                type: 'bar',
                data: {
                    labels: roomStats.map(item => item.room_name ?? ''),
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: roomStats.map(item => item.total_bookings ?? 0),
                        backgroundColor: colors.blue.fill,
                        borderColor: colors.blue.stroke,
                        borderWidth: 2,
                        borderRadius: 8,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Chart Trend Bulanan
        if (document.getElementById('bookingTrendChart')) {
            const trendCtx = document.getElementById('bookingTrendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: monthlyStats.map(item => item.month ?? ''),
                    datasets: [{
                        label: 'Jumlah Pemesanan per Bulan',
                        data: monthlyStats.map(item => item.total_bookings ?? 0),
                        fill: true,
                        backgroundColor: colors.green.fill,
                        borderColor: colors.green.stroke,
                        borderWidth: 3,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: colors.green.stroke,
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: colors.green.stroke,
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error creating charts:', error);
    }
});
</script>
@endpush

@endsection