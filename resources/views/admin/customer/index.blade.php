@extends('layouts.app')

@section('title', 'Manajemen Customer')
@section('page_title', '👥 Manajemen Customer')

@section('content')
    <div class="space-y-6">
        <!-- Header dengan Button Tambah dan Search -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <p class="text-gray-600 text-sm">Kelola semua customer rental event Anda di sini</p>
            </div>
            <button id="btn-create" onclick="openModal('create')"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg font-medium hover:shadow-lg transition-all hover:scale-105 active:scale-95">
                <span class="text-lg">+</span>
                <span>Tambah Customer</span>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <form method="GET" action="{{ route('customers.index') }}" class="flex gap-3 flex-col md:flex-row">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama atau nomor HP..."
                        class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all text-sm">
                    <span class="absolute left-3 top-3 text-gray-400">🔍</span>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors text-sm">
                    Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('customers.index') }}"
                        class="px-6 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors text-sm">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Customer -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nomor HP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                No. KTP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Alamat</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($customers as $index => $customer)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $customer->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $customer->phone }}</span>
                                        <!-- WhatsApp Chat Button -->
                                        <a href="https://wa.me/{{ $customer->phone }}?text=Halo%20{{ urlencode($customer->name) }}%2C%20ini%20adalah%20pesan%20dari%20Pusat%20Rental%20Event"
                                            target="_blank"
                                            class="inline-flex items-center justify-center p-1.5 bg-green-50 hover:bg-green-100 text-green-600 rounded-lg transition-colors"
                                            title="Chat WhatsApp">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span
                                        class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                        {{ $customer->identity_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="line-clamp-2">{{ $customer->address }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Button -->
                                        <button
                                            onclick="editCustomer({{ $customer->id }}, '{{ addslashes($customer->name) }}', '{{ $customer->phone }}', '{{ addslashes($customer->address) }}', '{{ $customer->identity_number }}')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg font-medium transition-colors text-xs">
                                            <span>✏️</span> Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">
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
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <span class="text-4xl">👥</span>
                                        <p class="text-gray-600 font-medium">Belum ada customer</p>
                                        <p class="text-gray-500 text-sm">Silakan tambahkan customer pertama Anda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($customers->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">{{ $customers->firstItem() }}</span> hingga
                        <span class="font-semibold">{{ $customers->lastItem() }}</span> dari
                        <span class="font-semibold">{{ $customers->total() }}</span> customer
                    </div>
                    <div class="flex gap-2">
                        @if ($customers->onFirstPage())
                            <span
                                class="px-3 py-1.5 border border-gray-300 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
                                ← Sebelumnya
                            </span>
                        @else
                            <a href="{{ $customers->previousPageUrl() }}&search={{ request('search') }}"
                                class="px-3 py-1.5 border border-cyan-300 text-cyan-600 rounded-lg text-sm font-medium hover:bg-cyan-50 transition-colors">
                                ← Sebelumnya
                            </a>
                        @endif

                        @if ($customers->hasMorePages())
                            <a href="{{ $customers->nextPageUrl() }}&search={{ request('search') }}"
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

    <!-- MODAL CREATE/EDIT -->
    <div id="customerModal"
        class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 md:p-0 md:pt-12">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div
                class="sticky top-0 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-5 flex items-center justify-between">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900">Tambah Customer Baru</h2>
                <button onclick="closeModal()"
                    class="flex items-center justify-center w-8 h-8 rounded-lg hover:bg-gray-200 transition-colors text-gray-600">
                    ✕
                </button>
            </div>

            <!-- Modal Body -->
            <form id="customerForm" method="POST" action="{{ route('customers.store') }}" class="p-6 space-y-5">
                @csrf
                <input type="hidden" id="formMethod" value="POST">
                <input type="hidden" id="customerId" value="">

                <!-- Row 1: Nama & Nomor HP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Customer <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Contoh: Budi Santoso"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor HP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="phone" name="phone" placeholder="Contoh: 6281234567890"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                            pattern="^62[0-9]{9,12}$" required>
                        <p class="text-gray-500 text-xs mt-1">Format: 62 diikuti 9-12 digit (contoh: 6281234567890)</p>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: No. KTP -->
                <div>
                    <label for="identity_number" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Identitas (KTP) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="identity_number" name="identity_number" placeholder="Masukkan nomor KTP"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all"
                        required>
                    @error('identity_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Row 3: Alamat -->
                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea id="address" name="address" placeholder="Masukkan alamat lengkap customer..." rows="4"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition-all resize-none"
                        required></textarea>
                    @error('address')
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
                        Simpan Customer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('customerModal');
        const form = document.getElementById('customerForm');
        const modalTitle = document.getElementById('modalTitle');

        // Buka Modal Create
        function openModal(mode) {
            form.reset();
            form.action = "{{ route('customers.store') }}";
            document.getElementById('formMethod').value = 'POST';
            modalTitle.textContent = '➕ Tambah Customer Baru';

            // Hapus hidden input method jika ada
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Edit Customer
        function editCustomer(id, name, phone, address, identity_number) {
            form.reset();
            form.action = `customers/${id}`;

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
            document.getElementById('customerId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('phone').value = phone;
            document.getElementById('address').value = address;
            document.getElementById('identity_number').value = identity_number;

            modalTitle.textContent = '✏️ Edit Customer: ' + name;
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
