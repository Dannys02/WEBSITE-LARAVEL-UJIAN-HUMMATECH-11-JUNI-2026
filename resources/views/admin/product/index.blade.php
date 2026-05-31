@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('page_title', '📦 Manajemen Produk')

@section('content')
    <div class="space-y-6">
        <!-- Header dengan Button Tambah -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Kelola semua produk rental event Anda di sini</p>
            </div>
            <button id="btn-create" onclick="openModal('create')"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg font-medium hover:shadow-lg transition-all hover:scale-105 active:scale-95">
                <span class="text-lg">➕</span>
                <span>Tambah Produk</span>
            </button>
        </div>

        <!-- Table Produk -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Stock</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Harga/Hari</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($products as $index => $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                        {{ $product->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-block px-2 py-1 {{ $product->stock > 10 ? 'bg-green-50 text-green-700' : ($product->stock > 0 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }} rounded text-xs font-semibold">
                                        {{ $product->stock }} Unit
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($product->status === 'tersedia')
                                        <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold">
                                            ✓ Tersedia
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-semibold">
                                            ✗ Tidak Tersedia
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Button -->
                                        <button onclick="editProduct({{ $product->id }}, '{{ $product->name }}', '{{ $product->category }}', {{ $product->stock }}, {{ $product->price_per_day }}, '{{ $product->description }}', '{{ $product->status }}')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg font-medium transition-colors text-xs">
                                            <span>✏️</span> Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
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
                                <td colspan="7" class="px-6 py-12 text-center">
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
                            <a href="{{ $products->previousPageUrl() }}"
                                class="px-3 py-1.5 border border-cyan-300 text-cyan-600 rounded-lg text-sm font-medium hover:bg-cyan-50 transition-colors">
                                ← Sebelumnya
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
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

    <!-- MODAL CREATE/EDIT -->
    <div id="productModal"
        class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 md:p-0 md:pt-12">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-5 flex items-center justify-between">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900">Tambah Produk Baru</h2>
                <button onclick="closeModal()"
                    class="flex items-center justify-center w-8 h-8 rounded-lg hover:bg-gray-200 transition-colors text-gray-600">
                    ✕
                </button>
            </div>

            <!-- Modal Body -->
            <form id="productForm" method="POST" action="{{ route('products.store') }}" class="p-6 space-y-5">
                @csrf
                <input type="hidden" id="formMethod" value="POST">
                <input type="hidden" id="productId" value="">

                <!-- Row 1: Nama & Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Contoh: Tenda Premium 4x4"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="category" name="category" placeholder="Contoh: Tenda, Kursi, Meja"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                            required>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: Stock & Harga -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah Stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" placeholder="0"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                            min="0" required>
                        @error('stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price_per_day" class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga per Hari (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="price_per_day" name="price_per_day" placeholder="0"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                            min="0" step="1000" required>
                        @error('price_per_day')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 3: Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all bg-white"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="tersedia">✓ Tersedia</option>
                        <option value="tidak tersedia">✗ Tidak Tersedia</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Row 4: Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi <span class="text-gray-500 text-xs">(Opsional)</span>
                    </label>
                    <textarea id="description" name="description" placeholder="Masukkan detail produk, spesifikasi, atau informasi penting lainnya..."
                        rows="5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all resize-none"></textarea>
                    <p class="text-gray-500 text-xs mt-1">Maksimal 500 karakter</p>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modal Footer -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-300 bg-white text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Batalkan
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:shadow-lg transition-all active:scale-95">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('productModal');
        const form = document.getElementById('productForm');
        const modalTitle = document.getElementById('modalTitle');

        // Buka Modal Create
        function openModal(mode) {
            form.reset();
            form.action = "{{ route('products.store') }}";
            document.getElementById('formMethod').value = 'POST';
            modalTitle.textContent = '➕ Tambah Produk Baru';

            // Hapus hidden input method jika ada
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Edit Product
        function editProduct(id, name, category, stock, price, description, status) {
            form.reset();
            form.action = `/products/${id}`;

            // Ada method PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';

            // Hapus method input lama jika ada
            const oldMethod = form.querySelector('input[name="_method"]');
            if (oldMethod) oldMethod.remove();
            form.appendChild(methodInput);

            // Isi form
            document.getElementById('productId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('category').value = category;
            document.getElementById('stock').value = stock;
            document.getElementById('price_per_day').value = price;
            document.getElementById('description').value = description;
            document.getElementById('status').value = status;

            modalTitle.textContent = '✏️ Edit Produk: ' + name;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Tutup Modal
        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            form.reset();
        }

        // Tutup modal jika klik di luar
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Tutup modal dengan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
@endsection
