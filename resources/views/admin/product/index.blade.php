@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('page_title', '📦 Manajemen Produk')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div>
            <p class="text-gray-600 text-sm">Kelola semua produk rental event Anda di sini</p>
        </div>

        <!-- Form Tambah/Edit Produk -->
        <div id="productFormCard" class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 transition-all">
            <h2 id="formTitle" class="text-base font-bold text-gray-900 mb-4">➕ Tambah Produk Baru</h2>

            <form id="productForm" method="POST" action="{{ route('products.store') }}" class="space-y-4"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <!-- Row 1: Gambar, Nama, Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="image" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Gambar Produk
                        </label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm bg-white">
                        <p class="text-[10px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah/menambahkan gambar.</p>
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Contoh: Tenda Premium 4x4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            required>
                    </div>

                    <div>
                        <label for="category" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="category" name="category" placeholder="Contoh: Tenda, Kursi, Meja"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            required>
                    </div>
                </div>

                <!-- Row 2: Stock, Harga -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="stock" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Jumlah Stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" placeholder="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            min="0" required>
                    </div>

                    <div>
                        <label for="price_per_day" class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Harga per Hari (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="price_per_day" name="price_per_day" placeholder="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm"
                            min="0" step="1000" required>
                    </div>
                </div>

                <!-- Row 3: Deskripsi -->
                <div>
                    <label for="description" class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Deskripsi <span class="text-gray-500 text-[10px]">(Opsional)</span>
                    </label>
                    <textarea id="description" name="description"
                        placeholder="Masukkan detail produk, spesifikasi, atau informasi penting lainnya..." rows="2"
                        class="w-full h-32 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all resize-none text-sm"></textarea>
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" id="btn-cancel" onclick="resetForm()"
                        class="hidden px-5 py-2 border border-gray-300 bg-white text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit"
                        class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:shadow-lg transition-all active:scale-95">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-3 flex-col md:flex-row">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama produk atau kategori..."
                        class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm">
                    <span class="absolute left-3 top-3 text-gray-400">🔍</span>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors text-sm">
                    Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('products.index') }}"
                        class="px-6 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors text-sm">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Produk -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga/Hari</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- No -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                </td>

                                <!-- Gambar -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-12 h-12 object-cover rounded-md shadow-sm border">
                                    @else
                                        <div class="bg-gray-100 border border-dashed rounded-md w-12 h-12 flex items-center justify-center text-[10px] text-gray-400 font-semibold uppercase">
                                            No Image
                                        </div>
                                    @endif
                                </td>

                                <!-- Nama Produk -->
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $product->name }}
                                </td>

                                <!-- Kategori -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-block px-2.5 py-0.5 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                        {{ $product->category }}
                                    </span>
                                </td>

                                <!-- Stock -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @php
                                        $stockClass = match (true) {
                                            $product->stock > 10 => 'bg-green-50 text-green-700',
                                            $product->stock > 0  => 'bg-amber-50 text-amber-700',
                                            default              => 'bg-red-50 text-red-700',
                                        };
                                    @endphp
                                    <span class="inline-block px-2 py-0.5 {{ $stockClass }} rounded text-xs font-semibold">
                                        {{ $product->stock }} Unit
                                    </span>
                                </td>

                                <!-- Harga/Hari -->
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                                </td>

                                <!-- Status Ketersediaan -->
                                <td class="px-6 py-4 text-sm">
                                    @if ($product->stock > 0)
                                        <span class="inline-block px-2.5 py-0.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold">
                                            ✓ Tersedia
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-0.5 bg-red-50 text-red-700 rounded-full text-xs font-semibold">
                                            ✗ Habis
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="editProduct({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ addslashes($product->category) }}', {{ $product->stock }}, {{ $product->price_per_day }}, '{{ addslashes($product->description) }}')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg font-medium transition-colors text-xs">
                                            <span>✏️</span> Edit
                                        </button>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
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
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <span class="text-4xl">📭</span>
                                        <p class="text-gray-600 font-medium">Belum ada produk</p>
                                        <p class="text-gray-500 text-sm">Silakan tambahkan produk pertama Anda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">{{ $products->firstItem() }}</span> hingga
                        <span class="font-semibold">{{ $products->lastItem() }}</span> dari
                        <span class="font-semibold">{{ $products->total() }}</span> produk
                    </div>
                    <div class="flex gap-2">
                        @if ($products->onFirstPage())
                            <span class="px-3 py-1.5 border border-gray-300 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
                                ← Sebelumnya
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}&search={{ request('search') }}"
                                class="px-3 py-1.5 border border-cyan-300 text-cyan-600 rounded-lg text-sm font-medium hover:bg-cyan-50 transition-colors">
                                ← Sebelumnya
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}&search={{ request('search') }}"
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
            formTitle.textContent = '✏️ Edit Produk: ' + name;
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
            formTitle.textContent = '➕ Tambah Produk Baru';
            btnCancel.classList.add('hidden');
        }
    </script>
@endsection
