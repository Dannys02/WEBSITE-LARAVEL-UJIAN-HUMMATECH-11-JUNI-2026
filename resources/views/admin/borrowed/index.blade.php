@extends('layouts.app')

@section('title', 'Daftar Barang Dipinjam')
@section('page_title', '🔄 Barang Dipinjam')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <p class="text-slate-500 text-sm">Kelola semua transaksi rental yang statusnya sedang dipinjam</p>
    </div>

    <!-- Search Bar -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4">
        <form method="GET" action="{{ route('borrowed.index') }}" class="flex gap-3 flex-col md:flex-row">
            <div class="flex-1 relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama customer..."
                    class="w-full px-4 py-2.5 pl-11 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white">
                <svg class="w-5 h-5 absolute left-3.5 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <button type="submit"
                class="px-6 py-2.5 bg-slate-800 text-white rounded-lg font-medium hover:bg-slate-900 transition-colors text-sm shadow-sm focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:outline-none">
                Cari
            </button>
            @if (request('search'))
            <a href="{{ route('borrowed.index') }}"
                class="px-6 py-2.5 border border-slate-300 bg-white text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors text-sm flex items-center justify-center focus:ring-2 focus:ring-slate-200 focus:outline-none">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Table Barang Dipinjam -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/80 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Jumlah Sewa (Stok)</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Durasi Sewa</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Rental</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Bayar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($rentals as $rental)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                            {{ $rental->customer->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $rental->product->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                            {{ $rental->details->first()->qty ?? 0 }} Unit
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            @php
                            $start = \Carbon\Carbon::parse($rental->rental_date);
                            $end = \Carbon\Carbon::parse($rental->return_date);
                            $hours = $start->diffInHours($end);
                            $days = ceil($hours / 24) ?: 1;
                            @endphp
                            <div class="font-medium text-xs text-indigo-700 bg-indigo-50 ring-1 ring-indigo-600/20 px-2.5 py-1 rounded-full inline-flex items-center gap-1 mb-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $days }} Hari
                            </div>
                            <div class="text-[11px] text-slate-500 font-medium">Mulai: {{ $start->format('d M Y H:i') }}</div>
                            <div class="text-[11px] text-slate-500 font-medium">Kembali: {{ $end->format('d M Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if ($rental->status == 'active' && now()->gt($rental->return_date))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Terlambat
                            </span>
                            @elseif ($rental->status == 'cancelled')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg> Dibatalkan
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 ring-1 ring-blue-600/20 rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Sedang Dipinjam
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if ($rental->payment_status == 'paid')
                            <span class="inline-block px-2.5 py-1 bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 rounded-md text-xs font-semibold">
                                Lunas
                            </span>
                            @elseif($rental->payment_status == 'dp')
                            <span class="inline-block px-2.5 py-1 bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 rounded-md text-xs font-semibold">
                                DP (Down Payment)
                            </span>
                            @else
                            <span class="inline-block px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-md text-xs font-semibold">
                                Belum Bayar
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <!-- Kembalikan Button -->
                                <form action="{{ route('borrowed.return', $rental->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan barang ini?');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-lg transition-colors" title="Selesai">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>

                                <!-- Batal Button -->
                                <form action="{{ route('borrowed.cancel', $rental->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi rental ini? Stok barang akan dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg transition-colors" title="Batal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-3xl">📭</span>
                                </div>
                                <p class="text-slate-600 font-semibold">Tidak ada barang yang sedang dipinjam</p>
                                <p class="text-slate-500 text-sm">Semua produk saat ini tersedia di gudang</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($rentals->hasPages())
        <div class="border-t border-slate-200 px-6 py-4 flex items-center justify-between bg-slate-50/50">
            <div class="text-sm text-slate-600">
                Menampilkan <span class="font-semibold text-slate-900">{{ $rentals->firstItem() }}</span> hingga
                <span class="font-semibold text-slate-900">{{ $rentals->lastItem() }}</span> dari
                <span class="font-semibold text-slate-900">{{ $rentals->total() }}</span> transaksi
            </div>
            <div class="flex gap-2">
                @if ($rentals->onFirstPage())
                <span class="px-3 py-1.5 border border-slate-200 text-slate-400 rounded-lg text-sm font-medium cursor-not-allowed bg-white">
                    ← Sebelumnya
                </span>
                @else
                <a href="{{ $rentals->previousPageUrl() }}&search={{ request('search') }}"
                    class="px-3 py-1.5 border border-indigo-200 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-50 transition-colors bg-white">
                    ← Sebelumnya
                </a>
                @endif

                @if ($rentals->hasMorePages())
                <a href="{{ $rentals->nextPageUrl() }}&search={{ request('search') }}"
                    class="px-3 py-1.5 border border-indigo-200 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-50 transition-colors bg-white">
                    Selanjutnya →
                </a>
                @else
                <span class="px-3 py-1.5 border border-slate-200 text-slate-400 rounded-lg text-sm font-medium cursor-not-allowed bg-white">
                    Selanjutnya →
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
