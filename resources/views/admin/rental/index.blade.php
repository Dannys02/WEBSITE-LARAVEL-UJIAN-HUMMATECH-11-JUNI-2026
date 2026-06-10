@extends('layouts.app')

@section('title', 'Manajemen Transaksi Rental')
@section('page_title', '📦 Manajemen Transaksi')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div>
            <p class="text-slate-500 text-sm">Kelola semua transaksi penyewaan event Anda di sini</p>
        </div>

        <!-- Form Tambah/Edit Rental -->
        <div id="rentalFormCard" class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 transition-all">
            <h2 id="formTitle" class="text-base font-bold text-slate-900 mb-5 flex items-center gap-2">
                <span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">➕</span> Tambah Transaksi Rental Baru
            </h2>

            <form id="rentalForm" method="POST" action="{{ route('rentals.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <!-- Row 1: Customer, Product & Qty -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="customer_id" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Pilih Customer <span class="text-red-500">*</span>
                        </label>
                        <select id="customer_id" name="customer_id"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all bg-slate-50 hover:bg-slate-100 focus:bg-white text-sm @error('customer_id') border-red-500 bg-red-50 @enderror"
                            required>
                            <option value="">-- Pilih Customer --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="product_id" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Pilih Produk <span class="text-red-500">*</span>
                        </label>
                        <select id="product_id" name="product_id" onchange="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all bg-slate-50 hover:bg-slate-100 focus:bg-white text-sm @error('product_id') border-red-500 bg-red-50 @enderror"
                            required>
                            <option value="" data-price="0">-- Pilih Produk --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price_per_day }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                    (Rp {{ number_format($product->price_per_day, 0, ',', '.') }}/Hari
                                    - Stok: {{ $product->stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="qty" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Jumlah Sewa (Stok) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="qty" name="qty" min="1" value="{{ old('qty') }}" placeholder="1"
                            onchange="calculateTotal()" oninput="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('qty') border-red-500 bg-red-50 @enderror"
                            required>
                        @error('qty') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Row 2: Tanggal Sewa & Tanggal Pengembalian -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="rental_date" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Tanggal & Jam Sewa <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" id="rental_date" name="rental_date" value="{{ old('rental_date') }}"
                            onchange="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('rental_date') border-red-500 bg-red-50 @enderror"
                            required>
                        <p class="text-[10px] text-slate-500 mt-1.5">Tanggal mulai tidak boleh hari yang sudah lalu.</p>
                        @error('rental_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="return_date" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Tanggal & Jam Pengembalian <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" id="return_date" name="return_date" value="{{ old('return_date') }}"
                            onchange="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('return_date') border-red-500 bg-red-50 @enderror"
                            required>
                        @error('return_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Live Calculator UI -->
                <div class="bg-indigo-50/70 border border-indigo-100 rounded-xl p-5 grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs font-bold text-indigo-700 uppercase tracking-wider mb-1">Durasi Sewa</span>
                        <span id="liveDays" class="text-lg font-bold text-indigo-900">1 Hari</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-indigo-700 uppercase tracking-wider mb-1">Estimasi Total
                            Harga</span>
                        <span id="liveTotalPrice" class="text-lg font-extrabold text-indigo-600">Rp 0</span>
                    </div>
                </div>

                <!-- Row 3: Status & Payment Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Status Rental
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all bg-slate-50 hover:bg-slate-100 focus:bg-white text-sm">
                            <option value="active">⚙ Sedang Dipinjam</option>
                            <option value="returned">✓ Dikembalikan</option>
                            <option value="cancelled">✗ Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label for="payment_status" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Status Pembayaran
                        </label>
                        <select id="payment_status" name="payment_status"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all bg-slate-50 hover:bg-slate-100 focus:bg-white text-sm">
                            <option value="dp">DP (Down Payment)</option>
                            <option value="paid">Lunas</option>
                        </select>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" id="btn-cancel" onclick="resetForm()"
                        class="hidden px-5 py-2.5 border border-slate-300 bg-white text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:text-slate-900 transition-all focus:ring-2 focus:ring-slate-200 focus:outline-none">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all active:scale-95 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4">
            <form method="GET" action="{{ route('rentals.index') }}" class="flex gap-3 flex-col md:flex-row">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama customer..."
                        class="w-full px-4 py-2.5 pl-11 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 focus:bg-white hover:bg-slate-100">
                    <svg class="w-5 h-5 absolute left-3.5 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-slate-800 text-white rounded-lg font-medium hover:bg-slate-900 transition-colors text-sm shadow-sm focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:outline-none">
                    Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('rentals.index') }}"
                        class="px-6 py-2.5 border border-slate-300 bg-white text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors text-sm flex items-center justify-center focus:ring-2 focus:ring-slate-200 focus:outline-none">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Rental -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-slate-50/80 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Durasi Sewa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Total Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Rental</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Bayar</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($rentals as $rental)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <!-- No -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}
                                </td>

                                <!-- Customer -->
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                                    {{ $rental->customer->name ?? 'N/A' }}
                                </td>

                                <!-- Produk -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $rental->product->name ?? 'N/A' }}
                                </td>

                                <!-- Stok / Qty -->
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                    {{ $rental->details->first()->qty ?? 0 }} Unit
                                </td>

                                <!-- Durasi Sewa -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    @php
                                        $start = \Carbon\Carbon::parse($rental->rental_date);
                                        $end = \Carbon\Carbon::parse($rental->return_date);
                                        $hours = $start->diffInHours($end);
                                        $days = ceil($hours / 24) ?: 1;
                                    @endphp
                                    <div
                                        class="font-medium text-xs text-indigo-700 bg-indigo-50 ring-1 ring-indigo-600/20 px-2.5 py-1 rounded-full inline-flex items-center gap-1 mb-1.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $days }} Hari
                                    </div>
                                    <div class="text-[11px] text-slate-500 font-medium">Mulai: {{ $start->format('d M Y H:i') }}</div>
                                    <div class="text-[11px] text-slate-500 font-medium">Kembali: {{ $end->format('d M Y H:i') }}</div>
                                </td>

                                <!-- Total Harga -->
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                                    Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Status Rental -->
                                <td class="px-6 py-4 text-sm">
                                    @if ($rental->status == 'active' && now()->gt($rental->return_date))
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Terlambat
                                        </span>
                                    @elseif ($rental->status == 'returned')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Dikembalikan
                                        </span>
                                    @elseif ($rental->status == 'cancelled')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg> Dibatalkan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 ring-1 ring-blue-600/20 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Sedang Dipinjam
                                        </span>
                                    @endif
                                </td>

                                <!-- Status Bayar -->
                                <td class="px-6 py-4 text-sm">
                                    @if ($rental->payment_status == 'paid')
                                        <span
                                            class="inline-block px-2.5 py-1 bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 rounded-md text-xs font-semibold">
                                            Lunas
                                        </span>
                                    @elseif ($rental->payment_status == 'dp')
                                        <span
                                            class="inline-block px-2.5 py-1 bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 rounded-md text-xs font-semibold">
                                            DP (Down Payment)
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-md text-xs font-semibold">
                                            Belum Bayar
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            onclick="editRental({{ $rental->id }}, {{ $rental->customer_id }}, {{ $rental->product_id }}, '{{ \Carbon\Carbon::parse($rental->rental_date)->format('Y-m-d\TH:i') }}', '{{ \Carbon\Carbon::parse($rental->return_date)->format('Y-m-d\TH:i') }}', '{{ $rental->status }}', '{{ $rental->payment_status }}', '{{ addslashes($rental->customer->name ?? 'N/A') }}', {{ $rental->details->first()->qty ?? 0 }})"
                                            class="{{ $rental->status == 'returned' && $rental->payment_status == 'paid' ? 'hidden' : ''}} inline-flex items-center justify-center w-8 h-8 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>

                                        <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi rental ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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
                                        <p class="text-slate-600 font-semibold">Belum ada transaksi rental</p>
                                        <p class="text-slate-500 text-sm">Silakan buat transaksi rental pertama Anda</p>
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
                            <span
                                class="px-3 py-1.5 border border-slate-200 text-slate-400 rounded-lg text-sm font-medium cursor-not-allowed bg-white">
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
                            <span
                                class="px-3 py-1.5 border border-slate-200 text-slate-400 rounded-lg text-sm font-medium cursor-not-allowed bg-white">
                                Selanjutnya →
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        
    </div>

    <script>
        'use strict';

        /** @type {HTMLFormElement} */
        const rentalForm = document.getElementById('rentalForm');
        const formMethod = document.getElementById('formMethod');
        const formTitle = document.getElementById('formTitle');
        const btnCancel = document.getElementById('btn-cancel');

        /**
         * Memformat angka menjadi format datetime-local (YYYY-MM-DDTHH:MM).
         */
        function formatDateTimeLocal(date) {
            const pad = (n) => n.toString().padStart(2, '0');
            const yyyy = date.getFullYear();
            const mm = pad(date.getMonth() + 1);
            const dd = pad(date.getDate());
            const hh = pad(date.getHours());
            const min = pad(date.getMinutes());
            return `${yyyy}-${mm}-${dd}T${hh}:${min}`;
        }

        /**
         * Menghitung dan menampilkan estimasi durasi sewa dan total harga secara live.
         */
        function calculateTotal() {
            const rentalDateVal = document.getElementById('rental_date').value;
            const returnDateVal = document.getElementById('return_date').value;
            const productSelect = document.getElementById('product_id');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const pricePerDay = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const qty = parseInt(document.getElementById('qty').value) || 1;

            if (!rentalDateVal || !returnDateVal) {
                document.getElementById('liveTotalPrice').textContent = "Rp 0";
                return;
            }

            const start = new Date(rentalDateVal);
            const end = new Date(returnDateVal);
            const timeDiff = end.getTime() - start.getTime();
            let days = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (days <= 0 || isNaN(days)) {
                days = 1;
            }

            document.getElementById('liveDays').textContent = days + " Hari";

            const totalPrice = pricePerDay * days * qty;
            document.getElementById('liveTotalPrice').textContent = "Rp " + totalPrice.toLocaleString('id-ID');
        }

        /**
         * Mengisi form dengan data rental untuk mode edit.
         */
        function editRental(id, customerId, productId, rentalDate, returnDate, status, paymentStatus, customerName, qty) {
            rentalForm.action = `rentals/${id}`;
            formMethod.value = 'PUT';
            formTitle.innerHTML = '<span class="p-1.5 bg-amber-50 text-amber-600 rounded-lg">✏️</span> Edit Transaksi Rental: ' + customerName;
            btnCancel.classList.remove('hidden');

            document.getElementById('customer_id').value = customerId;
            document.getElementById('product_id').value = productId;
            document.getElementById('qty').value = qty;
            document.getElementById('rental_date').value = rentalDate;
            document.getElementById('return_date').value = returnDate;
            document.getElementById('status').value = status;
            document.getElementById('payment_status').value = paymentStatus;

            calculateTotal();

            document.getElementById('rentalFormCard').scrollIntoView({
                behavior: 'smooth'
            });
        }

        /**
         * Mereset form kembali ke mode tambah transaksi baru.
         */
        function resetForm() {
            rentalForm.reset();
            rentalForm.action = "{{ route('rentals.store') }}";
            formMethod.value = 'POST';
            formTitle.innerHTML = '<span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">➕</span> Tambah Transaksi Rental Baru';
            btnCancel.classList.add('hidden');
            document.getElementById('qty').value = 1;

            initDefaultDates();
            calculateTotal();
        }

        /**
         * Menginisialisasi tanggal default pada form (hari ini & besok).
         */
        function initDefaultDates() {
            const now = new Date();
            
            // Baris penentuan min dihapus agar bisa input tanggal masa lalu
            document.getElementById('rental_date').value = formatDateTimeLocal(now);

            const tomorrow = new Date(now);
            tomorrow.setDate(now.getDate() + 1);
            document.getElementById('return_date').value = formatDateTimeLocal(tomorrow);
        }

        window.addEventListener('DOMContentLoaded', () => {
            initDefaultDates();
        });
    </script>
@endsection
