@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('page_title', '📦 Manajemen Produk')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div>
            <p class="text-slate-500 text-sm">Kelola semua produk rental event Anda di sini</p>
        </div>

        <!-- Form Tambah/Edit Produk -->
        <div id="productFormCard" class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 transition-all">
            <h2 id="formTitle" class="text-base font-bold text-slate-900 mb-5 flex items-center gap-2">
                <span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">➕</span> Tambah Produk Baru
            </h2>

            <form id="productForm" method="POST" action="{{ route('products.store') }}" class="space-y-5"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <!-- Row 1: Gambar, Nama, Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="image" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Gambar Produk
                        </label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('image') border-red-500 bg-red-50 @enderror">
                        <p class="text-[10px] text-slate-500 mt-1.5">Kosongkan jika tidak ingin mengubah/menambahkan gambar.</p>
                        @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Contoh: Tenda Premium 4x4" value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('name') border-red-500 bg-red-50 @enderror"
                            required>
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="Contoh: Tenda, Kursi, Meja"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('category') border-red-500 bg-red-50 @enderror"
                            required>
                        @error('category') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Row 2: Stock, Harga -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="stock" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Jumlah Stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('stock') border-red-500 bg-red-50 @enderror"
                            min="0" required>
                        @error('stock') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="price_per_day" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Harga per Hari (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="price_per_day" name="price_per_day" value="{{ old('price_per_day') }}" placeholder="0"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('price_per_day') border-red-500 bg-red-50 @enderror"
                            min="0" step="1000" required>
                        @error('price_per_day') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Row 3: Deskripsi -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Deskripsi <span class="text-slate-400 normal-case font-normal">(Opsional)</span>
                    </label>
                    <textarea id="description" name="description"
                        placeholder="Masukkan detail produk, spesifikasi, atau informasi penting lainnya..." rows="3"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all resize-none text-sm bg-slate-50 hover:bg-slate-100 focus:bg-white @error('description') border-red-500 bg-red-50 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" id="btn-cancel" onclick="resetForm()"
                        class="hidden px-5 py-2.5 border border-slate-300 bg-white text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:text-slate-900 transition-all focus:ring-2 focus:ring-slate-200 focus:outline-none">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all active:scale-95 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-3 flex-col md:flex-row">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama produk atau kategori..."
                        class="w-full px-4 py-2.5 pl-11 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-slate-50 focus:bg-white hover:bg-slate-100">
                    <svg class="w-5 h-5 absolute left-3.5 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-slate-800 text-white rounded-lg font-medium hover:bg-slate-900 transition-colors text-sm shadow-sm focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:outline-none">
                    Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('products.index') }}"
                        class="px-6 py-2.5 border border-slate-300 bg-white text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors text-sm flex items-center justify-center focus:ring-2 focus:ring-slate-200 focus:outline-none">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Produk -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-slate-50/80 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Harga/Hari</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($products as $product)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <!-- No -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                </td>

                                <!-- Gambar -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-12 h-12 object-cover rounded-lg shadow-sm border border-slate-200">
                                    @else
                                        <div class="bg-slate-100 border border-dashed border-slate-300 rounded-lg w-12 h-12 flex items-center justify-center text-[10px] text-slate-400 font-semibold uppercase">
                                            N/A
                                        </div>
                                    @endif
                                </td>

                                <!-- Nama Produk -->
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                                    {{ $product->name }}
                                </td>

                                <!-- Kategori -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <span class="inline-block px-2.5 py-1 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-600/20 rounded-md text-xs font-medium">
                                        {{ $product->category }}
                                    </span>
                                </td>

                                <!-- Stock -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    @php
                                        $stockClass = match (true) {
                                            $product->stock > 10 => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                            $product->stock > 0  => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                            default              => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                                        };
                                    @endphp
                                    <span class="inline-block px-2.5 py-1 ring-1 {{ $stockClass }} rounded-md text-xs font-semibold">
                                        {{ $product->stock }} Unit
                                    </span>
                                </td>

                                <!-- Harga/Hari -->
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                                    Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                                </td>

                                <!-- Status Ketersediaan -->
                                <td class="px-6 py-4 text-sm">
                                    @if ($product->stock > 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 ring-1 ring-rose-600/20 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Habis
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            onclick="editProduct({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ addslashes($product->category) }}', {{ $product->stock }}, {{ $product->price_per_day }}, '{{ addslashes($product->description) }}')"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
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
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                            <span class="text-3xl">📭</span>
                                        </div>
                                        <p class="text-slate-600 font-semibold">Belum ada produk</p>
                                        <p class="text-slate-500 text-sm">Silakan tambahkan produk pertama Anda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="border-t border-slate-200 px-6 py-4 flex items-center justify-between bg-slate-50/50">
                    <div class="text-sm text-slate-600">
                        Menampilkan <span class="font-semibold text-slate-900">{{ $products->firstItem() }}</span> hingga
                        <span class="font-semibold text-slate-900">{{ $products->lastItem() }}</span> dari
                        <span class="font-semibold text-slate-900">{{ $products->total() }}</span> produk
                    </div>
                    <div class="flex gap-2">
                        @if ($products->onFirstPage())
                            <span class="px-3 py-1.5 border border-slate-200 text-slate-400 rounded-lg text-sm font-medium cursor-not-allowed bg-white">
                                ← Sebelumnya
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}&search={{ request('search') }}"
                                class="px-3 py-1.5 border border-indigo-200 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-50 transition-colors bg-white">
                                ← Sebelumnya
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}&search={{ request('search') }}"
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

    <script>
        'use strict';

        /** @type {HTMLFormElement} */
        const productForm = document.getElementById('productForm');
        const formMethod = document.getElementById('formMethod');
        const formTitle = document.getElementById('formTitle');
        const btnCancel = document.getElementById('btn-cancel');

        /**
         * Mengisi form dengan data produk untuk mode edit.
         */
        function editProduct(id, name, category, stock, pricePerDay, description) {
            productForm.action = `products/${id}`;
            formMethod.value = 'PUT';
            formTitle.innerHTML = '<span class="p-1.5 bg-amber-50 text-amber-600 rounded-lg">✏️</span> Edit Produk: ' + name;
            btnCancel.classList.remove('hidden');

            document.getElementById('name').value = name;
            document.getElementById('category').value = category;
            document.getElementById('stock').value = stock;
            document.getElementById('price_per_day').value = pricePerDay;
            document.getElementById('description').value = description;

            document.getElementById('productFormCard').scrollIntoView({ behavior: 'smooth' });
        }

        /**
         * Mereset form kembali ke mode tambah produk baru.
         */
        function resetForm() {
            productForm.reset();
            productForm.action = "{{ route('products.store') }}";
            formMethod.value = 'POST';
            formTitle.innerHTML = '<span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">➕</span> Tambah Produk Baru';
            btnCancel.classList.add('hidden');
        }
    </script>
@endsection

