@extends('layouts.app')

@section('title', 'Daftar Barang Dipinjam')
@section('page_title', '🔄 Barang Dipinjam')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <p class="text-gray-600 text-sm">Kelola semua transaksi rental yang statusnya sedang dipinjam</p>
    </div>

    <!-- Search Bar -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
        <form method="GET" action="{{ route('borrowed.index') }}" class="flex gap-3 flex-col md:flex-row">
            <div class="flex-1 relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama customer..."
                    class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm">
                <span class="absolute left-3 top-3 text-gray-400">🔍</span>
            </div>
            <button type="submit"
                class="px-6 py-2.5 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors text-sm">
                Cari
            </button>
            @if (request('search'))
            <a href="{{ route('borrowed.index') }}"
                class="px-6 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors text-sm">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Table Barang Dipinjam -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah Sewa (Stok)</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Durasi Sewa</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status Rental</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status Bayar</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($rentals as $rental)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $rental->customer->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $rental->product->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-semibold">
                            {{ $rental->details->first()->qty ?? 0 }} Unit
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @php
                            $start = \Carbon\Carbon::parse($rental->rental_date);
                            $end = \Carbon\Carbon::parse($rental->return_date);
                            $hours = $start->diffInHours($end);
                            $days = ceil($hours / 24) ?: 1;
                            @endphp
                            <div class="font-medium text-xs text-cyan-600 bg-cyan-50 px-2.5 py-1 rounded-full inline-block mb-1">
                                ⏱️ {{ $days }} Hari
                            </div>
                            <div class="text-[11px] text-gray-500">Mulai: {{ $start->format('d M Y H:i') }}</div>
                            <div class="text-[11px] text-gray-500">Kembali: {{ $end->format('d M Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if ($rental->status == 'late')
                            <span class="inline-block px-2.5 py-1 bg-rose-50 text-rose-700 rounded-full text-xs font-semibold">
                                ⚠ Terlambat
                            </span>
                            @else
                            <span class="inline-block px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-semibold">
                                ⚙ Sedang Disewa
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if ($rental->payment_status == 'paid')
                            <span class="inline-block px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold">
                                Lunas
                            </span>
                            @elseif($rental->payment_status == 'dp')
                            <span class="inline-block px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-semibold">
                                DP (Down Payment)
                            </span>
                            @else
                            <span class="inline-block px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-semibold">
                                Belum Bayar
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Kembalikan Button -->
                                <form action="{{ route('borrowed.return', $rental->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan barang ini?');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-lg font-medium transition-colors text-xs">
                                        <span>✓</span> Kembalikan
                                    </button>
                                </form>

                                <!-- Batal Button -->
                                <form action="{{ route('borrowed.cancel', $rental->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi rental ini? Stok barang akan dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition-colors text-xs">
                                        <span>❌</span> Batal
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <span class="text-4xl">📭</span>
                                <p class="text-gray-600 font-medium">Tidak ada barang yang sedang dipinjam</p>
                                <p class="text-gray-500 text-sm">Semua produk saat ini tersedia di gudang</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($rentals->hasPages())
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">{{ $rentals->firstItem() }}</span> hingga
                <span class="font-semibold">{{ $rentals->lastItem() }}</span> dari
                <span class="font-semibold">{{ $rentals->total() }}</span> transaksi
            </div>
            <div class="flex gap-2">
                @if ($rentals->onFirstPage())
                <span class="px-3 py-1.5 border border-gray-300 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
                    ← Sebelumnya
                </span>
                @else
                <a href="{{ $rentals->previousPageUrl() }}&search={{ request('search') }}"
                    class="px-3 py-1.5 border border-cyan-300 text-cyan-600 rounded-lg text-sm font-medium hover:bg-cyan-50 transition-colors">
                    ← Sebelumnya
                </a>
                @endif

                @if ($rentals->hasMorePages())
                <a href="{{ $rentals->nextPageUrl() }}&search={{ request('search') }}"
                    class="px-3 py-1.5 border border-cyan-300 text-cyan-600 rounded-lg text-sm font-medium hover:bg-cyan-50 transition-colors">
                    Selanjutnya →
                </a>
                @else
                <span class="px-3 py-1.5 border border-gray-300 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
                    Selanjutnya →
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
