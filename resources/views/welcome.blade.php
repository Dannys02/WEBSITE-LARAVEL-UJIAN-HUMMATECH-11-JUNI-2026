<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Peralatan Event Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .dark-glass { background: rgba(17, 24, 39, 0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .animate-on-scroll.is-visible { opacity: 1; transform: translateY(0); }
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
        .faq-content { display: none; }
        .faq-content.open { display: block; }
        .faq-btn.active .icon { transform: rotate(180deg); }
    </style>
    @php
        $user = App\Models\User::find(1);
    @endphp
    @if ($user && $user->image)
        <link rel="icon" href="{{ asset('storage/' . $user->image) }}" type="image/png">
    @else
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" type="image/png">
    @endif
</head>
<body class="bg-gray-50 text-gray-900 antialiased selection:bg-blue-600 selection:text-white">

@php
    $products = App\Models\Product::latest()->take(6)->get();
    $totalProducts = App\Models\Product::count();
    $totalCustomers = App\Models\Customer::count();
    $totalRentals = App\Models\Rental::count();
    $totalTransactions = App\Models\Rental::where('payment_status', 'paid')->count();
@endphp

<!-- Navbar -->
<nav id="navbar" class="fixed w-full z-50 transition-all duration-300 glass-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-600/30">
                    R
                </div>
                <span class="text-xl font-extrabold tracking-tight text-gray-900">Rental<span class="text-blue-600">Event</span></span>
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Beranda</a>
                <a href="#products" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Produk</a>
                <a href="#about" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Tentang</a>
                <a href="#faq" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">FAQ</a>
            </div>

            <div class="hidden md:flex items-center">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-full bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition shadow-lg hover:shadow-xl">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50">Masuk</a>
                @endauth
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-gray-700 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full shadow-xl pb-6">
        <div class="px-4 py-4 space-y-3 flex flex-col">
            <a href="#home" class="text-base font-semibold text-gray-700 hover:text-blue-600 mobile-link">Beranda</a>
            <a href="#products" class="text-base font-semibold text-gray-700 hover:text-blue-600 mobile-link">Produk</a>
            <a href="#about" class="text-base font-semibold text-gray-700 hover:text-blue-600 mobile-link">Tentang</a>
            <a href="#faq" class="text-base font-semibold text-gray-700 hover:text-blue-600 mobile-link">FAQ</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="inline-block mt-2 px-6 py-3 rounded-xl bg-gray-900 text-white text-center font-semibold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="inline-block mt-2 px-6 py-3 rounded-xl bg-blue-600 text-white text-center font-semibold">Masuk</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute top-40 -left-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2 animate-on-scroll">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-semibold mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                    Sewa Peralatan Event No.1
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                    Solusi Rental Peralatan Event <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Profesional</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-xl leading-relaxed">
                    Sewa berbagai kebutuhan event mulai dari tenda, sound system, lighting, kamera, dan perlengkapan lainnya dengan mudah dan terpercaya.
                </p>
                
                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="#products" class="px-8 py-4 rounded-full bg-gray-900 text-white font-semibold hover:bg-gray-800 transition shadow-xl hover:shadow-2xl hover:-translate-y-1 transform duration-200">
                        Lihat Produk
                    </a>
                    <a href="#contact" class="px-8 py-4 rounded-full bg-white text-gray-900 border border-gray-200 font-semibold hover:border-gray-300 hover:bg-gray-50 transition shadow-sm hover:shadow-md hover:-translate-y-1 transform duration-200">
                        Hubungi Kami
                    </a>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-gray-600">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center">✓</div> Mudah
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center">✓</div> Cepat
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center">✓</div> Terpercaya
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 animate-on-scroll delay-200">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&q=80" alt="Event Equipment" class="w-full h-full object-cover aspect-[4/3] transform hover:scale-105 transition duration-700">
                    
                    <div class="absolute bottom-6 left-6 right-6 z-20 dark-glass rounded-2xl p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-md">
                                <span class="text-white text-xl">⭐</span>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Kualitas Premium</h3>
                                <p class="text-gray-300 text-sm">Peralatan dirawat dan dikalibrasi rutin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $totalProducts ?: '0' }}</div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Produk</div>
            </div>
            <div class="text-center animate-on-scroll delay-100">
                <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $totalCustomers ?: '0' }}</div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Customer</div>
            </div>
            <div class="text-center animate-on-scroll delay-200">
                <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $totalRentals ?: '0' }}</div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Rental</div>
            </div>
            <div class="text-center animate-on-scroll delay-300">
                <div class="text-4xl font-extrabold text-blue-600 mb-2">{{ $totalTransactions ?: '0' }}</div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Transaksi Lunas</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section id="products" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Produk Unggulan Kami</h2>
            <p class="text-lg text-gray-600">Pilih dari koleksi perlengkapan event premium kami yang selalu terawat dan siap pakai.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $index => $product)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group animate-on-scroll" style="transition-delay: {{ $index * 50 }}ms;">
                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1505236858219-8359eb29e329?w=500&q=80" alt="Placeholder" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 grayscale opacity-70">
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-900 shadow-sm">
                            {{ $product->category ?? 'Peralatan' }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $product->description ?? 'Peralatan berkualitas tinggi untuk menunjang kesuksesan event Anda.' }}</p>
                        
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase">Harga / Hari</p>
                                <p class="text-lg font-extrabold text-blue-600">Rp {{ number_format($product->price_per_day, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 font-semibold uppercase">Stok</p>
                                <p class="text-sm font-bold text-gray-900">{{ $product->stock }} Unit</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Dummy Products if Empty -->
                @for($i=1; $i<=6; $i++)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group animate-on-scroll">
                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=500&q=80" alt="Dummy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 grayscale opacity-70">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Peralatan Dummy {{ $i }}</h3>
                        <p class="text-gray-500 text-sm mb-4">Speaker aktif dengan kualitas suara jernih dan bass yang mendalam.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase">Harga / Hari</p>
                                <p class="text-lg font-extrabold text-blue-600">Rp 500.000</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 font-semibold uppercase">Stok</p>
                                <p class="text-sm font-bold text-gray-900">5 Unit</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            @endforelse
        </div>
        
    </div>
</section>

<!-- Why Choose Us -->
<section id="about" class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Kenapa Memilih Kami</h2>
            <p class="text-lg text-gray-600">Kami berkomitmen memberikan layanan terbaik untuk memastikan setiap event Anda berjalan sempurna tanpa kendala teknis.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="bg-gray-50 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-100 animate-on-scroll">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Peralatan Lengkap</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Berbagai kebutuhan event tersedia, mulai dari skala kecil hingga konser besar.</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-gray-50 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-100 animate-on-scroll delay-100">
                <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Terjangkau</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Harga kompetitif dan transparan. Tidak ada biaya tersembunyi yang memberatkan.</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-gray-50 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-100 animate-on-scroll delay-200">
                <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Mudah Disewa</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Proses rental cepat, sederhana, dan digital. Pesan dari mana saja dan kapan saja.</p>
            </div>
            <!-- Card 4 -->
            <div class="bg-gray-50 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-100 animate-on-scroll delay-300">
                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Terpercaya</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Dikelola secara profesional dengan rekam jejak menyukseskan ribuan acara.</p>
            </div>
        </div>
    </div>
</section>

<!-- Rental Flow Timeline -->
<section class="py-24 bg-gray-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 z-0 opacity-10">
        <svg class="absolute w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-20 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Alur Rental Mudah</h2>
            <p class="text-lg text-gray-400">Proses peminjaman barang kami desain semudah mungkin untuk menghemat waktu Anda.</p>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative">
            <!-- Connecting Line (Desktop) -->
            <div class="hidden md:block absolute top-8 left-0 w-full h-1 bg-gray-800 -z-10"></div>
            
            <!-- Step 1 -->
            <div class="flex flex-col items-center text-center w-full md:w-1/5 mb-10 md:mb-0 relative animate-on-scroll">
                <div class="w-16 h-16 rounded-full bg-blue-600 border-4 border-gray-900 flex items-center justify-center text-xl font-bold mb-4 shadow-lg shadow-blue-600/50">1</div>
                <h4 class="text-lg font-bold mb-2">Pilih Produk</h4>
                <p class="text-sm text-gray-400">Cari perlengkapan sesuai kebutuhan event Anda.</p>
            </div>
            
            <!-- Step 2 -->
            <div class="flex flex-col items-center text-center w-full md:w-1/5 mb-10 md:mb-0 relative animate-on-scroll delay-100">
                <div class="w-16 h-16 rounded-full bg-gray-800 border-4 border-gray-900 flex items-center justify-center text-xl font-bold mb-4">2</div>
                <h4 class="text-lg font-bold mb-2">Ajukan Rental</h4>
                <p class="text-sm text-gray-400">Isi formulir dan tentukan durasi peminjaman.</p>
            </div>
            
            <!-- Step 3 -->
            <div class="flex flex-col items-center text-center w-full md:w-1/5 mb-10 md:mb-0 relative animate-on-scroll delay-200">
                <div class="w-16 h-16 rounded-full bg-gray-800 border-4 border-gray-900 flex items-center justify-center text-xl font-bold mb-4">3</div>
                <h4 class="text-lg font-bold mb-2">Barang Dipinjam</h4>
                <p class="text-sm text-gray-400">Ambil barang atau kami kirimkan ke lokasi Anda.</p>
            </div>

            <!-- Step 4 -->
            <div class="flex flex-col items-center text-center w-full md:w-1/5 mb-10 md:mb-0 relative animate-on-scroll delay-300">
                <div class="w-16 h-16 rounded-full bg-gray-800 border-4 border-gray-900 flex items-center justify-center text-xl font-bold mb-4">4</div>
                <h4 class="text-lg font-bold mb-2">Pengembalian Barang</h4>
                <p class="text-sm text-gray-400">Kembalikan barang sesuai batas waktu penyewaan.</p>
            </div>

            <!-- Step 5 -->
            <div class="flex flex-col items-center text-center w-full md:w-1/5 relative animate-on-scroll delay-400">
                <div class="w-16 h-16 rounded-full bg-green-500 border-4 border-gray-900 flex items-center justify-center text-xl font-bold mb-4 shadow-lg shadow-green-500/50">5</div>
                <h4 class="text-lg font-bold mb-2">Selesai</h4>
                <p class="text-sm text-gray-400">Transaksi selesai, event Anda berjalan lancar.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Testimoni</h2>
            <p class="text-lg text-gray-600">Kepercayaan pelanggan adalah bukti kualitas pelayanan kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testi 1 -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 animate-on-scroll">
                <div class="flex items-center gap-1 text-yellow-400 mb-6">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-gray-600 mb-8 italic">"Sangat puas dengan pelayanan rental ini! Alatnya bersih, terawat, dan kualitasnya benar-benar standar profesional. Event konser kami sukses besar berkat sound system dari sini."</p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/150?img=11" alt="Budi Santoso" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h5 class="font-bold text-gray-900">Budi Santoso</h5>
                        <p class="text-sm text-gray-500">Event Organizer</p>
                    </div>
                </div>
            </div>

            <!-- Testi 2 -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 animate-on-scroll delay-100">
                <div class="flex items-center gap-1 text-yellow-400 mb-6">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-gray-600 mb-8 italic">"Sangat membantu! Kemarin butuh proyektor mendadak untuk presentasi, proses rental cepat banget nggak ribet sama sekali. The best deh pokoknya."</p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/150?img=47" alt="Siti Aminah" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h5 class="font-bold text-gray-900">Siti Aminah</h5>
                        <p class="text-sm text-gray-500">Corporate Manager</p>
                    </div>
                </div>
            </div>

            <!-- Testi 3 -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 animate-on-scroll delay-200">
                <div class="flex items-center gap-1 text-yellow-400 mb-6">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-gray-600 mb-8 italic">"Peralatan lighting-nya juara! Acara pernikahan kami jadi terlihat sangat mewah dan elegan. Harga sewa juga sangat masuk akal dibandingkan vendor lain."</p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/150?img=32" alt="Andi Pratama" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h5 class="font-bold text-gray-900">Andi Pratama</h5>
                        <p class="text-sm text-gray-500">Wedding Planner</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">FAQ</h2>
            <p class="text-lg text-gray-600">Temukan jawaban untuk pertanyaan yang sering diajukan oleh pelanggan kami.</p>
        </div>

        <div class="space-y-4 animate-on-scroll">
            <!-- FAQ 1 -->
            <div class="border border-gray-200 rounded-2xl overflow-hidden faq-item">
                <button class="faq-btn w-full px-6 py-5 text-left flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition focus:outline-none">
                    <span class="font-bold text-gray-900 text-lg">Bagaimana cara melakukan rental?</span>
                    <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300 icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content px-6 py-5 bg-white border-t border-gray-100">
                    <p class="text-gray-600">Anda dapat langsung melihat katalog produk, memilih barang yang diinginkan, kemudian menghubungi nomor kami atau mendaftar dan memesan langsung melalui sistem jika fitur tersebut diaktifkan.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="border border-gray-200 rounded-2xl overflow-hidden faq-item">
                <button class="faq-btn w-full px-6 py-5 text-left flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition focus:outline-none">
                    <span class="font-bold text-gray-900 text-lg">Apakah tersedia sistem DP?</span>
                    <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300 icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content px-6 py-5 bg-white border-t border-gray-100">
                    <p class="text-gray-600">Ya, kami menyediakan sistem DP (Down Payment) untuk mengamankan pesanan barang Anda pada tanggal event. Pelunasan dapat dilakukan saat pengambilan barang.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="border border-gray-200 rounded-2xl overflow-hidden faq-item">
                <button class="faq-btn w-full px-6 py-5 text-left flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition focus:outline-none">
                    <span class="font-bold text-gray-900 text-lg">Bagaimana jika terlambat mengembalikan barang?</span>
                    <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300 icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content px-6 py-5 bg-white border-t border-gray-100">
                    <p class="text-gray-600">Keterlambatan pengembalian akan dikenakan denda sesuai dengan syarat dan ketentuan yang berlaku. Biasanya dihitung sebagai perpanjangan masa sewa per hari.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="border border-gray-200 rounded-2xl overflow-hidden faq-item">
                <button class="faq-btn w-full px-6 py-5 text-left flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition focus:outline-none">
                    <span class="font-bold text-gray-900 text-lg">Apakah stok diperbarui secara otomatis?</span>
                    <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300 icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content px-6 py-5 bg-white border-t border-gray-100">
                    <p class="text-gray-600">Betul, sistem kami mencatat setiap transaksi sehingga ketersediaan stok produk yang tampil di website selalu up-to-date dan real-time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative overflow-hidden bg-gray-900">
    <div class="absolute inset-0 z-0">
        <svg class="absolute w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="cta-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#cta-grid)" />
        </svg>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center animate-on-scroll">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Siap Menyukseskan Event Anda?</h2>
        <p class="text-xl text-gray-400 mb-10">Temukan berbagai perlengkapan event terbaik untuk kebutuhan acara Anda.</p>
        <a href="#products" class="inline-flex items-center justify-center px-10 py-4 rounded-full bg-blue-600 text-white font-bold text-lg hover:bg-blue-700 hover:-translate-y-1 transform transition shadow-xl hover:shadow-blue-600/50">
            Lihat Produk
        </a>
    </div>
</section>

    {{-- Footer --}}
    <footer class="bg-black border-t border-slate-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                {{-- Column 1: Logo & Description --}}
                <div>
                    <h3 class="text-2xl font-bold mb-4">
                        <span>Event Rental</span>
                    </h3>
                    <p class="text-gray-400 text-sm mb-6">
                        Solusi rental perlengkapan event profesional yang terpercaya sejak 2026. Kami siap membuat acara
                        Anda sukses.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-blue-500 flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>

                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-blue-500 flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.918 6.064-6.918Zm-1.293 19.49h2.039L6.482 3.24H4.298l13.31 17.403Z" />
                            </svg>
                        </a>

                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-blue-500 flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Column 2: Quick Links --}}
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="#home"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Beranda</a>
                        </li>
                        <li><a href="#products"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Produk</a>
                        </li>
                        <li><a href="#about"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Tentang
                                Kami</a></li>
                        <li><a href="#contact"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Kontak</a>
                        </li>
                    </ul>
                </div>

                {{-- Column 3: Services --}}
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Layanan</h4>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Rental
                                Harian</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Paket
                                Event</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Pengiriman
                                Gratis</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Dukungan
                                Teknis</a></li>
                    </ul>
                </div>

                {{-- Column 4: Contact --}}
                <div id="contact">
                    <h4 class="text-white font-bold text-lg mb-6">Kontak Kami</h4>
                    <ul class="space-y-3">
                        <li class="text-gray-400 text-sm">
                            <strong class="text-white">Telepon:</strong><br>
                            @php
                                $user = \App\Models\User::find(1);
                            @endphp

                            @if ($user && $user->phone)
                                {{ $user->formatPhoneInWelcome() }}
                            @else
                                +62 812-3456-7890
                            @endif
                        </li>
                        <li class="text-gray-400 text-sm">
                            <strong class="text-white">Email:</strong><br>
                            info@Event Rental.com
                        </li>
                        <li class="text-gray-400 text-sm">
                            <strong class="text-white">Alamat:</strong><br>
                            Jl. Nasional No. 3, Jawa Timur
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        &copy; 2026 Event Rental. Semua hak cipta dilindungi.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#"
                            class="text-gray-400 hover:text-blue-400 text-sm transition-colors duration-300">Kebijakan
                            Privasi</a>
                        <a href="#"
                            class="text-gray-400 hover:text-blue-400 text-sm transition-colors duration-300">Syarat &
                            Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar Scrolled Effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md');
                navbar.classList.replace('h-20', 'h-16');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.replace('h-16', 'h-20');
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Intersection Observer for Scroll Animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // FAQ Accordion Logic
        const faqBtns = document.querySelectorAll('.faq-btn');
        faqBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const content = btn.nextElementSibling;
                const isActive = btn.classList.contains('active');

                // Close all
                document.querySelectorAll('.faq-content').forEach(c => {
                    c.classList.remove('open');
                });
                document.querySelectorAll('.faq-btn').forEach(b => {
                    b.classList.remove('active');
                });

                // Open clicked if it wasn't already open
                if (!isActive) {
                    content.classList.add('open');
                    btn.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
