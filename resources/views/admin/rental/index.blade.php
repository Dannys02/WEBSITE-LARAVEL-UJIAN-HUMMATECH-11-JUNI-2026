@extends('layouts.app')

@section('title', 'Manajemen Transaksi Rental')
@section('page_title', '📦 Manajemen Transaksi')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div>
            <p class="text-gray-600 text-sm">Kelola semua transaksi penyewaan event Anda di sini</p>
        </div>

        <!-- Form Tambah/Edit Rental -->
        <div id="rentalFormCard" class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 transition-all">
            <h2 id="formTitle" class="text-base font-bold text-gray-900 mb-4">➕ Tambah Transaksi Rental Baru</h2>

            <form id="rentalForm" method="POST" action="{{ route('rentals.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <!-- Row 1: Customer, Product & Qty -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="customer_id" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Pilih Customer <span class="text-red-500">*</span>
                        </label>
                        <select id="customer_id" name="customer_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all bg-white text-sm"
                            required>
                            <option value="">-- Pilih Customer --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="product_id" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Pilih Produk <span class="text-red-500">*</span>
                        </label>
                        <select id="product_id" name="product_id" onchange="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all bg-white text-sm"
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
                    </div>

                    <div>
                        <label for="qty" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Jumlah Sewa (Stok) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="qty" name="qty" min="1" value="{{ old('qty') }}"
                            onchange="calculateTotal()" oninput="calculateTotal()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            required>
                    </div>
                </div>

                <!-- Row 2: Tanggal Sewa & Tanggal Pengembalian -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="rental_date" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Tanggal & Jam Sewa <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" id="rental_date" name="rental_date" value="{{ old('rental_date') }}"
                            onchange="calculateTotal()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            required>
                        <p class="text-[10px] text-gray-500 mt-1">Tanggal mulai tidak boleh hari yang sudah lalu.</p>
                    </div>

                    <div>
                        <label for="return_date" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Tanggal & Jam Pengembalian <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" id="return_date" name="return_date" value="{{ old('return_date') }}"
                            onchange="calculateTotal()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            required>
                    </div>
                </div>

                <!-- Live Calculator UI -->
                <div class="bg-cyan-50/70 border border-cyan-100 rounded-lg p-4 grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs font-semibold text-cyan-700 uppercase tracking-wider">Durasi Sewa</span>
                        <span id="liveDays" class="text-base font-bold text-cyan-900">1 Hari</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-cyan-700 uppercase tracking-wider">Estimasi Total
                            Harga</span>
                        <span id="liveTotalPrice" class="text-base font-extrabold text-cyan-600">Rp 0</span>
                    </div>
                </div>

                <!-- Row 3: Status & Payment Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Status Rental
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all bg-white text-sm">
                            <option value="active">⚙ Sedang Dipinjam</option>
                            <option value="returned">✓ Dikembalikan</option>
                            <option value="cancelled">✗ Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label for="payment_status" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Status Pembayaran
                        </label>
                        <select id="payment_status" name="payment_status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all bg-white text-sm">
                            <option value="unpaid">Belum Bayar</option>
                            <option value="dp">DP (Down Payment)</option>
                            <option value="paid">Lunas</option>
                        </select>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" id="btn-cancel" onclick="resetForm()"
                        class="hidden px-5 py-2 border border-gray-300 bg-white text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit"
                        class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:shadow-lg transition-all active:scale-95">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <form method="GET" action="{{ route('rentals.index') }}" class="flex gap-3 flex-col md:flex-row">
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
                    <a href="{{ route('rentals.index') }}"
                        class="px-6 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors text-sm">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Rental -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Stok</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Durasi Sewa</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Total Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status Rental</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status Bayar</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($rentals as $rental)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- No -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}
                                </td>

                                <!-- Customer -->
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $rental->customer->name ?? 'N/A' }}
                                </td>

                                <!-- Produk -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $rental->product->name ?? 'N/A' }}
                                </td>

                                <!-- Stok / Qty -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $rental->details->first()->qty ?? 0 }}
                                </td>

                                <!-- Durasi Sewa -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @php
                                        $start = \Carbon\Carbon::parse($rental->rental_date);
                                        $end = \Carbon\Carbon::parse($rental->return_date);
                                        $hours = $start->diffInHours($end);
                                        $days = ceil($hours / 24) ?: 1;
                                    @endphp
                                    <div
                                        class="font-medium text-xs text-cyan-600 bg-cyan-50 px-2.5 py-1 rounded-full inline-block mb-1">
                                        ⏱️ {{ $days }} Hari
                                    </div>
                                    <div class="text-[11px] text-gray-500">Mulai: {{ $start->format('d M Y H:i') }}</div>
                                    <div class="text-[11px] text-gray-500">Kembali: {{ $end->format('d M Y H:i') }}</div>
                                </td>

                                <!-- Total Harga -->
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Status Rental -->
                                <td class="px-6 py-4 text-sm">
                                    @if ($rental->status == 'active' && now()->gt($rental->return_date))
                                        <span
                                            class="inline-block px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-semibold">
                                            ⚠ Terlambat
                                        </span>
                                    @elseif ($rental->status == 'returned')
                                        <span
                                            class="inline-block px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold">
                                            ✓ Dikembalikan
                                        </span>
                                    @elseif ($rental->status == 'cancelled')
                                        <span
                                            class="inline-block px-2.5 py-1 bg-rose-50 text-rose-700 rounded-full text-xs font-semibold">
                                            ✗ Dibatalkan
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-semibold">
                                            ⚙ Sedang Dipinjam
                                        </span>
                                    @endif
                                </td>

                                <!-- Status Bayar -->
                                <td class="px-6 py-4 text-sm">
                                    @if ($rental->payment_status == 'paid')
                                        <span
                                            class="inline-block px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold">
                                            Lunas
                                        </span>
                                    @elseif ($rental->payment_status == 'dp')
                                        <span
                                            class="inline-block px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-semibold">
                                            DP (Down Payment)
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-semibold">
                                            Belum Bayar
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="editRental({{ $rental->id }}, {{ $rental->customer_id }}, {{ $rental->product_id }}, '{{ \Carbon\Carbon::parse($rental->rental_date)->format('Y-m-d\TH:i') }}', '{{ \Carbon\Carbon::parse($rental->return_date)->format('Y-m-d\TH:i') }}', '{{ $rental->status }}', '{{ $rental->payment_status }}', '{{ addslashes($rental->customer->name ?? 'N/A') }}', {{ $rental->details->first()->qty ?? 0 }})"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg font-medium transition-colors text-xs">
                                            <span>✏️</span> Edit
                                        </button>

                                        <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi rental ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition-colors text-xs">
                                                <span>🗑️</span> Hapus
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
                                        <p class="text-gray-600 font-medium">Belum ada transaksi rental</p>
                                        <p class="text-gray-500 text-sm">Silakan buat transaksi rental pertama Anda</p>
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
                            <span
                                class="px-3 py-1.5 border border-gray-300 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
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
                            <span
                                class="px-3 py-1.5 border border-gray-300 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
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
            formTitle.textContent = '✏️ Edit Transaksi Rental: ' + customerName;
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
            formTitle.textContent = '➕ Tambah Transaksi Rental Baru';
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
            const todayStart = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0);

            document.getElementById('rental_date').min = formatDateTimeLocal(todayStart);
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
