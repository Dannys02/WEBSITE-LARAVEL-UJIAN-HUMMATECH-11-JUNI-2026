@extends('layouts.app')

@section('title', 'Manajemen Transaksi Rental')
@section('page_title', '📦 Manajemen Transaksi')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <p class="text-gray-600 text-sm">Kelola semua transaksi penyewaan event (Multi-Produk) Anda di sini</p>
            </div>
            <button id="btn-create" onclick="openModal('create')"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg font-medium hover:shadow-lg transition-all hover:scale-105 active:scale-95">
                <span class="text-lg">+</span>
                <span>Buat Transaksi</span>
            </button>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <form method="GET" action="{{ route('rentals.index') }}" class="flex gap-3 flex-col md:flex-row">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama customer..."
                        class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none text-sm">
                    <span class="absolute left-3 top-3 text-gray-400">🔍</span>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-cyan-500 text-white rounded-lg font-medium text-sm">Cari</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Item Sewa (Barang)
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Durasi Sewa</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Total & Pembayaran
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($rentals as $rental)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $rental->customer->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <ul class="list-disc list-inside space-y-0.5">
                                        @foreach ($rental->details as $detail)
                                            <li>{{ $detail->product->name ?? 'Produk Terhapus' }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div
                                        class="font-medium text-xs text-cyan-600 bg-cyan-50 px-2 py-1 rounded inline-block mb-1">
                                        ⏱️
                                        {{ \Carbon\Carbon::parse($rental->rental_date)->diffInDays(\Carbon\Carbon::parse($rental->return_date)) ?: 1 }}
                                        Hari
                                    </div>
                                    <div class="text-xs text-gray-500">Mulai:
                                        {{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">Kembali:
                                        {{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-bold text-gray-900">Rp
                                        {{ number_format($rental->total_price, 0, ',', '.') }}</div>
                                    <div class="mt-1">
                                        @if ($rental->payment_status == 'paid')
                                            <span
                                                class="inline-block px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs font-semibold">Lunas</span>
                                        @elseif($rental->payment_status == 'dp')
                                            <span
                                                class="inline-block px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded text-xs font-semibold">DP</span>
                                        @else
                                            <span
                                                class="inline-block px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs font-semibold">Belum
                                                Bayar</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="editRental({{ $rental->id }}, {{ $rental->customer_id }}, {{ json_encode($rental->details->pluck('product_id')) }}, '{{ $rental->rental_date }}', '{{ $rental->return_date }}', '{{ $rental->status }}', '{{ $rental->payment_status }}')"
                                            class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg font-medium text-xs">
                                            ✏️ Edit
                                        </button>
                                        <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus transaksi ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-medium text-xs">🗑️
                                                Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="rentalModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[92vh] overflow-y-auto">
            <div class="sticky top-0 border-b border-gray-200 bg-white px-6 py-5 flex items-center justify-between z-10">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900">Buat Transaksi Baru</h2>
                <button onclick="closeModal()" class="w-8 h-8 rounded-lg hover:bg-gray-100 text-gray-500">✕</button>
            </div>

            <form id="rentalForm" method="POST" action="{{ route('rentals.store') }}" class="p-6 space-y-5">
                @csrf
                <div id="methodContainer"></div>

                <div>
                    <label for="customer_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Customer <span
                            class="text-red-500">*</span></label>
                    <select id="customer_id" name="customer_id"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none"
                        required>
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Produk Yang Disewa (Bisa Pilih
                        Banyak) <span class="text-red-500">*</span></label>
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 max-h-48 overflow-y-auto space-y-2.5">
                        @foreach ($products as $product)
                            <label
                                class="flex items-start gap-3 p-2 bg-white rounded border border-gray-100 shadow-sm cursor-pointer hover:bg-cyan-50/50 transition-colors">
                                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}"
                                    data-price="{{ $product->price_per_day }}" onchange="calculateTotal()"
                                    class="product-checkbox mt-1 w-4 h-4 rounded text-cyan-600 border-gray-300 focus:ring-cyan-500">
                                <div class="text-sm">
                                    <span class="font-medium text-gray-900">{{ $product->name }}</span>
                                    <span class="block text-xs text-gray-500 font-medium">Rp
                                        {{ number_format($product->price_per_day, 0, ',', '.') }} / hari</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="rental_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai Sewa
                            <span class="text-red-500">*</span></label>
                        <input type="date" id="rental_date" name="rental_date" onchange="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none"
                            required>
                    </div>
                    <div>
                        <label for="return_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal
                            Pengembalian <span class="text-red-500">*</span></label>
                        <input type="date" id="return_date" name="return_date" onchange="calculateTotal()"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none"
                            required>
                    </div>
                </div>

                <div class="bg-cyan-50/70 border border-cyan-100 rounded-lg p-4 grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs font-semibold text-cyan-700 uppercase tracking-wider">Durasi Sewa</span>
                        <span id="liveDays" class="text-xl font-bold text-cyan-900">1 Hari</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-cyan-700 uppercase tracking-wider">Estimasi Total
                            Harga</span>
                        <span id="liveTotalPrice" class="text-xl font-extrabold text-cyan-600">Rp 0</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status Rental</label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                            <option value="rented">Sedang Disewa</option>
                            <option value="returned">Dikembalikan</option>
                            <option value="late">Terlambat</option>
                        </select>
                    </div>
                    <div>
                        <label for="payment_status" class="block text-sm font-semibold text-gray-700 mb-2">Status
                            Pembayaran</label>
                        <select id="payment_status" name="payment_status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                            <option value="unpaid">Belum Bayar</option>
                            <option value="dp">DP (Down Payment)</option>
                            <option value="paid">Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-300 bg-white text-gray-700 font-medium rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:shadow-lg">Simpan
                        Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('rentalModal');
        const form = document.getElementById('rentalForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodContainer = document.getElementById('methodContainer');

        function calculateTotal() {
            const rentalDateVal = document.getElementById('rental_date').value;
            const returnDateVal = document.getElementById('return_date').value;

            if (!rentalDateVal || !returnDateVal) return;

            const start = new Date(rentalDateVal);
            const end = new Date(returnDateVal);

            // Hitung selisih hari
            const timeDiff = end.getTime() - start.getTime();
            let days = Math.ceil(timeDiff / (1000 * 3600 * 24));

            // Proteksi: Jika tanggal kembali diatur sebelum tanggal sewa atau di hari yang sama, hitung 1 hari
            if (days <= 0 || isNaN(days)) {
                days = 1;
            }

            document.getElementById('liveDays').textContent = days + " Hari";

            // Hitung total harga berdasarkan produk yang diceklis
            let totalPrice = 0;
            const checkboxes = document.querySelectorAll('.product-checkbox:checked');

            checkboxes.forEach(cb => {
                const pricePerDay = parseFloat(cb.getAttribute('data-price')) || 0;
                totalPrice += (pricePerDay * days);
            });

            // Tampilkan live format Rupiah
            document.getElementById('liveTotalPrice').textContent = "Rp " + totalPrice.toLocaleString('id-ID');
        }

        function openModal(mode) {
            form.reset();
            form.action = "{{ route('rentals.store') }}";
            methodContainer.innerHTML = ''; // POST default
            modalTitle.textContent = '➕ Buat Transaksi Baru (Multi-Produk)';

            // Uncheck semua produk
            document.querySelectorAll('.product-checkbox').forEach(cb => cb.checked = false);

            // Set default tanggal hari ini
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('rental_date').value = today;
            document.getElementById('return_date').value = today;

            calculateTotal();
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function editRental(id, customer_id, product_ids, rental_date, return_date, status, payment_status) {
            form.reset();
            form.action = `/admin/rentals/${id}`;
            methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            modalTitle.textContent = '✏️ Edit Transaksi';

            document.getElementById('customer_id').value = customer_id;
            document.getElementById('rental_date').value = rental_date;
            document.getElementById('return_date').value = return_date;
            document.getElementById('status').value = status;
            document.getElementById('payment_status').value = payment_status;

            // Ceklis otomatis produk-produk yang terdaftar sebelumnya
            document.querySelectorAll('.product-checkbox').forEach(cb => {
                cb.checked = product_ids.includes(parseInt(cb.value));
            });

            calculateTotal();
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Event listener penutup modal klik luar/ESC
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    </script>
@endsection
