@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Admin')

@section('content')
    <div class="space-y-8">
        <!-- Welcome Section -->
        <div>
            <p class="font-bold text-4xl">Selamat datang kembali! 👋</p>
            <p class="text-sm mt-1">Terakhir login: 30 May 2026, 14:32</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Produk -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-semibold mb-2">TOTAL PRODUK</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalProduk }}</p>
                        <p class="text-green-600 text-xs mt-2">+12% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl">📦</div>
                </div>
            </div>

            <!-- Card 2: Total Customer -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-semibold mb-2">TOTAL CUSTOMER</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalCustomer }}</p>
                        <p class="text-green-600 text-xs mt-2">+8% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl">👥</div>
                </div>
            </div>

            <!-- Card 3: Rental Aktif -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-semibold mb-2">RENTAL AKTIF</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $rentalAktif }}</p>
                        <p class="text-amber-600 text-xs mt-2">Sedang berlangsung</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl">🔄</div>
                </div>
            </div>

            <!-- Card 4: Total Revenue -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-xs font-semibold mb-2">TOTAL REVENUE</p>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                        <p class="text-green-600 text-xs mt-2">+24% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl">💰</div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Revenue Trend Chart -->
            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="mb-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-1">📈 Revenue Trend (7 Hari Terakhir)</h3>
                    <p class="text-gray-500 text-xs">Perkembangan pendapatan harian</p>
                </div>

                <!-- Bar Chart -->
                <div class="flex items-end justify-between h-56 gap-2 border-b-2 border-gray-200 pb-4">
                    <!-- Bar 1 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 40%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Sen</p>
                        <p class="text-xs font-semibold text-gray-700">15.2M</p>
                    </div>
                    <!-- Bar 2 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 45%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Sel</p>
                        <p class="text-xs font-semibold text-gray-700">17.8M</p>
                    </div>
                    <!-- Bar 3 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 30%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Rab</p>
                        <p class="text-xs font-semibold text-gray-700">12.1M</p>
                    </div>
                    <!-- Bar 4 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 55%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Kam</p>
                        <p class="text-xs font-semibold text-gray-700">21.3M</p>
                    </div>
                    <!-- Bar 5 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 60%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Jum</p>
                        <p class="text-xs font-semibold text-gray-700">23.5M</p>
                    </div>
                    <!-- Bar 6 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 47%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Sab</p>
                        <p class="text-xs font-semibold text-gray-700">18.6M</p>
                    </div>
                    <!-- Bar 7 -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-b from-blue-500 to-blue-700 rounded-t-lg" style="height: 37%;">
                        </div>
                        <p class="text-xs text-gray-500 font-medium mt-2">Min</p>
                        <p class="text-xs font-semibold text-gray-700">14.2M</p>
                    </div>
                </div>
            </div>

            <!-- Rental Status Distribution -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="mb-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-1">📊 Status Rental</h3>
                    <p class="text-gray-500 text-xs">Distribusi status saat ini</p>
                </div>

                <div class="space-y-4">
                    <!-- Status 1: Aktif -->
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-700 rounded"></div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Aktif / Sedang Berlangsung</p>
                            <div class="w-full h-1 bg-gray-200 rounded-full mt-1">
                                <div class="w-3/5 h-full bg-gradient-to-r from-blue-500 to-blue-700 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 min-w-fit">67 (65%)</p>
                    </div>

                    <!-- Status 2: Selesai -->
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-700 rounded"></div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Selesai / Dikembalikan</p>
                            <div class="w-full h-1 bg-gray-200 rounded-full mt-1">
                                <div class="w-1/12 h-full bg-gradient-to-r from-green-500 to-green-700 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 min-w-fit">12 (12%)</p>
                    </div>

                    <!-- Status 3: Dibatalkan -->
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gradient-to-br from-red-500 to-red-700 rounded"></div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Dibatalkan</p>
                            <div class="w-full h-1 bg-gray-200 rounded-full mt-1">
                                <div class="w-[3%] h-full bg-gradient-to-r from-red-500 to-red-700 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 min-w-fit">3 (3%)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 mb-1">📋 Rental Terbaru</h3>
                    <p class="text-gray-500 text-xs">Data 10 rental terakhir</p>
                </div>
                <a href="{{ route('rentals.index') }}"
                    class="px-4 py-2 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition-colors">Lihat
                    Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b-2 border-gray-200 bg-gray-50">
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">ID Rental</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Customer</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Produk</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Tanggal Dipinjam</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Total Harga</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($dataRental as $rental)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-3 font-semibold text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3 text-gray-900">{{ $rental->customer->name }}</td>
                                <td class="px-6 py-3 text-gray-900">{{ $rental->product->name }}</td>
                                <td class="px-6 py-3 text-gray-600">
                                    @php
                                        $start = \Carbon\Carbon::parse($rental->rental_date);
                                        $end = \Carbon\Carbon::parse($rental->return_date);
                                        $hours = $start->diffInHours($end);
                                        $days = ceil($hours / 24) ?: 1;
                                    @endphp
                                    <div class="text-gray-900">Mulai: {{ $start->format('d M Y H:i') }}</div>
                                    <div class="text-gray-900">Kembali: {{ $end->format('d M Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-3 font-semibold text-gray-900">Rp
                                    {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3">
                                    <span
                                        class="inline-block px-2 py-1 bg-green-100 text-blue-600 rounded text-xs font-semibold">
                                        @if ($rental->status == 'active')
                                            ⚙ Sedang Dipinjam
                                        @elseif ($rental->status == 'returned')
                                            <span class="bg-blue-100 text-green-600">✅ Dikembalikan</span>
                                        @else
                                            <span class="bg-gray-100 text-red-400">❌ Dibatalkan</span>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data rental.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
