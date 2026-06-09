@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Admin')

@section('content')
    <div class="space-y-8 animate-fade-in-up">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-3xl p-8 shadow-xl text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="font-bold text-3xl mb-2">Selamat datang kembali, Admin! 👋</p>
                <p class="text-gray-300 text-sm">Berikut adalah ringkasan performa rental Anda hari ini.</p>
            </div>
            <!-- Decorative circles -->
            <div class="absolute top-[-50px] right-[-50px] w-48 h-48 bg-cyan-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-50px] right-[10%] w-32 h-32 bg-blue-500/20 rounded-full blur-2xl"></div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Produk -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-bold tracking-wider mb-2 uppercase">Total Produk</p>
                        <p class="text-3xl font-extrabold text-gray-900">{{ $totalProduk }}</p>
                        <p class="text-emerald-500 text-xs font-semibold mt-2 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                            +12% <span class="text-gray-400 font-medium ml-1">dari bulan lalu</span>
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Customer -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-bold tracking-wider mb-2 uppercase">Total Customer</p>
                        <p class="text-3xl font-extrabold text-gray-900">{{ $totalCustomer }}</p>
                        <p class="text-emerald-500 text-xs font-semibold mt-2 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                            +8% <span class="text-gray-400 font-medium ml-1">dari bulan lalu</span>
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                    </div>
                </div>
            </div>

            <!-- Card 3: Rental Aktif -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-bold tracking-wider mb-2 uppercase">Rental Aktif</p>
                        <p class="text-3xl font-extrabold text-gray-900">{{ $rentalAktif }}</p>
                        <p class="text-amber-500 text-xs font-semibold mt-2 flex items-center">
                            <span class="relative flex h-2 w-2 mr-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                            </span>
                            Sedang berlangsung
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Revenue -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-bold tracking-wider mb-2 uppercase">Total Revenue</p>
                        <p class="text-3xl font-extrabold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-emerald-500 text-xs font-semibold mt-2 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                            +24% <span class="text-gray-400 font-medium ml-1">dari bulan lalu</span>
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Revenue Trend Chart -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100">
                <div class="mb-4 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Revenue Trend</h3>
                        <p class="text-gray-500 text-sm">7 hari terakhir</p>
                    </div>
                    <div class="p-2 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Rental Status Distribution -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex flex-col">
                <div class="mb-2">
                    <h3 class="text-lg font-bold text-gray-900">Status Rental</h3>
                    <p class="text-gray-500 text-sm">Distribusi status saat ini</p>
                </div>
                <div class="relative flex-1 w-full flex justify-center items-center min-h-[200px]">
                    <canvas id="statusChart"></canvas>
                    <!-- Overlay total text inside donut -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mt-2">
                        <span class="text-3xl font-bold text-gray-800">82</span>
                        <span class="text-xs text-gray-500 font-medium">Total</span>
                    </div>
                </div>
                <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                            <span class="font-medium text-gray-700">Aktif</span>
                        </div>
                        <span class="font-bold text-gray-900">67 <span class="text-gray-400 font-normal text-xs ml-1">(81%)</span></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <span class="font-medium text-gray-700">Selesai</span>
                        </div>
                        <span class="font-bold text-gray-900">12 <span class="text-gray-400 font-normal text-xs ml-1">(15%)</span></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                            <span class="font-medium text-gray-700">Dibatalkan</span>
                        </div>
                        <span class="font-bold text-gray-900">3 <span class="text-gray-400 font-normal text-xs ml-1">(4%)</span></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Rental Terbaru</h3>
                    <p class="text-gray-500 text-sm">10 transaksi terakhir</p>
                </div>
                <a href="{{ route('rentals.index') }}" class="px-4 py-2 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition-colors shadow-sm">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-4 font-semibold">ID</th>
                            <th class="px-6 py-4 font-semibold">Customer</th>
                            <th class="px-6 py-4 font-semibold">Produk</th>
                            <th class="px-6 py-4 font-semibold">Durasi Peminjaman</th>
                            <th class="px-6 py-4 font-semibold">Total Harga</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($dataRental as $rental)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="px-6 py-4 font-medium text-gray-900">#{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-100 to-cyan-100 text-blue-700 flex items-center justify-center font-bold text-xs">
                                            {{ substr($rental->customer->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $rental->customer->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700 font-medium">{{ $rental->product->name }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $start = \Carbon\Carbon::parse($rental->rental_date);
                                        $end = \Carbon\Carbon::parse($rental->return_date);
                                    @endphp
                                    <div class="flex flex-col gap-1">
                                        <span class="text-xs font-medium text-gray-700 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            {{ $start->format('d M Y, H:i') }}
                                        </span>
                                        <span class="text-xs font-medium text-gray-500 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            {{ $end->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($rental->status == 'active')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                            Sedang Dipinjam
                                        </span>
                                    @elseif ($rental->status == 'returned')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                        <p class="text-sm font-medium">Belum ada data rental</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup Revenue Trend Chart (Area Chart style)
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            
            // Create gradient for area chart
            const gradientRevenue = ctxRevenue.createLinearGradient(0, 0, 0, 300);
            gradientRevenue.addColorStop(0, 'rgba(59, 130, 246, 0.4)'); // blue-500
            gradientRevenue.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: [15200000, 17800000, 12100000, 21300000, 23500000, 18600000, 14200000],
                        borderColor: '#3b82f6', // blue-500
                        backgroundColor: gradientRevenue,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // smooth curve
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
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: { size: 13, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6',
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#6b7280',
                                font: { size: 11, family: "'Inter', sans-serif" },
                                callback: function(value) {
                                    if(value >= 1000000) return (value / 1000000) + 'M';
                                    return value;
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#6b7280',
                                font: { size: 12, family: "'Inter', sans-serif" }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });

            // Setup Status Chart (Donut Chart)
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Aktif', 'Selesai', 'Dibatalkan'],
                    datasets: [{
                        data: [67, 12, 3],
                        backgroundColor: [
                            '#3b82f6', // blue-500
                            '#10b981', // emerald-500
                            '#f43f5e'  // rose-500
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    
    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
