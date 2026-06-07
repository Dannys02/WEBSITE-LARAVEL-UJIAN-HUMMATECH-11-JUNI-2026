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
                        <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-700 rounded"></div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Aktif</p>
                            <div class="w-full h-1 bg-gray-200 rounded-full mt-1">
                                <div class="w-3/5 h-full bg-gradient-to-r from-green-500 to-green-700 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 min-w-fit">67 (65%)</p>
                    </div>

                    <!-- Status 2: Pending -->
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gradient-to-br from-amber-500 to-amber-700 rounded"></div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Pending</p>
                            <div class="w-full h-1 bg-gray-200 rounded-full mt-1">
                                <div class="w-1/5 h-full bg-gradient-to-r from-amber-500 to-amber-700 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 min-w-fit">21 (20%)</p>
                    </div>

                    <!-- Status 3: Selesai -->
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-700 rounded"></div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Selesai</p>
                            <div class="w-full h-1 bg-gray-200 rounded-full mt-1">
                                <div class="w-1/12 h-full bg-gradient-to-r from-blue-500 to-blue-700 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 min-w-fit">12 (12%)</p>
                    </div>

                    <!-- Status 4: Dibatalkan -->
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
                <a href="#"
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
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Tanggal Rental</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Nilai Rental</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-001</td>
                            <td class="px-6 py-3 text-gray-900">Budi Santoso</td>
                            <td class="px-6 py-3 text-gray-900">Sony A6700</td>
                            <td class="px-6 py-3 text-gray-600">28 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 450,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-green-100 text-green-900 rounded text-xs font-semibold">Aktif</span>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-002</td>
                            <td class="px-6 py-3 text-gray-900">Ani Wijaya</td>
                            <td class="px-6 py-3 text-gray-900">Canon EOS R5</td>
                            <td class="px-6 py-3 text-gray-600">29 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 750,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-green-100 text-green-900 rounded text-xs font-semibold">Aktif</span>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-003</td>
                            <td class="px-6 py-3 text-gray-900">Citra Dewi</td>
                            <td class="px-6 py-3 text-gray-900">Nikon Z9</td>
                            <td class="px-6 py-3 text-gray-600">25 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 950,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-blue-100 text-blue-900 rounded text-xs font-semibold">Selesai</span>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-004</td>
                            <td class="px-6 py-3 text-gray-900">Dodi Rahman</td>
                            <td class="px-6 py-3 text-gray-900">Fujifilm X-T5</td>
                            <td class="px-6 py-3 text-gray-600">30 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 550,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-amber-100 text-amber-900 rounded text-xs font-semibold">Pending</span>
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-005</td>
                            <td class="px-6 py-3 text-gray-900">Eka Putra</td>
                            <td class="px-6 py-3 text-gray-900">Panasonic S5II</td>
                            <td class="px-6 py-3 text-gray-600">20 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 650,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-blue-100 text-blue-900 rounded text-xs font-semibold">Selesai</span>
                            </td>
                        </tr>
                        <!-- Row 6 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-006</td>
                            <td class="px-6 py-3 text-gray-900">Fitria Nur</td>
                            <td class="px-6 py-3 text-gray-900">Leica M11</td>
                            <td class="px-6 py-3 text-gray-600">27 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 1,200,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-green-100 text-green-900 rounded text-xs font-semibold">Aktif</span>
                            </td>
                        </tr>
                        <!-- Row 7 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-007</td>
                            <td class="px-6 py-3 text-gray-900">Gita Langit</td>
                            <td class="px-6 py-3 text-gray-900">RED Komodo</td>
                            <td class="px-6 py-3 text-gray-600">22 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 2,500,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-blue-100 text-blue-900 rounded text-xs font-semibold">Selesai</span>
                            </td>
                        </tr>
                        <!-- Row 8 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-008</td>
                            <td class="px-6 py-3 text-gray-900">Hendra Jaya</td>
                            <td class="px-6 py-3 text-gray-900">Hasselblad 907X</td>
                            <td class="px-6 py-3 text-gray-600">26 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 1,800,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-red-100 text-red-900 rounded text-xs font-semibold">Dibatalkan</span>
                            </td>
                        </tr>
                        <!-- Row 9 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-009</td>
                            <td class="px-6 py-3 text-gray-900">Ina Widya</td>
                            <td class="px-6 py-3 text-gray-900">Phase One XF IQ4</td>
                            <td class="px-6 py-3 text-gray-600">23 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 3,200,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-blue-100 text-blue-900 rounded text-xs font-semibold">Selesai</span>
                            </td>
                        </tr>
                        <!-- Row 10 -->
                        <tr>
                            <td class="px-6 py-3 font-semibold text-gray-900">#RNT-010</td>
                            <td class="px-6 py-3 text-gray-900">Joko Sandy</td>
                            <td class="px-6 py-3 text-gray-900">Pentax 645Z</td>
                            <td class="px-6 py-3 text-gray-600">30 May 2026</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">Rp 500,000</td>
                            <td class="px-6 py-3"><span
                                    class="inline-block px-2 py-1 bg-green-100 text-green-900 rounded text-xs font-semibold">Aktif</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
