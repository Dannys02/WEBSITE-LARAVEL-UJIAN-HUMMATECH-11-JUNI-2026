<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Banyuwangi - Premium Event Equipment Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Smooth Transitions & Premium Effects */
        .premium-transition {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .text-glow:hover {
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="bg-black text-white antialiased selection:bg-white selection:text-black">

    {{-- Navbar Section --}}
    <nav class="fixed w-full top-0 z-50 bg-black/30 backdrop-blur-md border-b border-white/5 premium-transition"
        id="navbar">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <span class="text-xl font-extrabold tracking-widest text-white uppercase">
                        Rental Banyuwangi<span class="text-blue-500">.</span>
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-12">
                    <a href="#home"
                        class="text-xs font-medium uppercase tracking-widest text-neutral-400 hover:text-white text-glow premium-transition">Home</a>
                    <a href="#products"
                        class="text-xs font-medium uppercase tracking-widest text-neutral-400 hover:text-white text-glow premium-transition">Produk</a>
                    <a href="#about"
                        class="text-xs font-medium uppercase tracking-widest text-neutral-400 hover:text-white text-glow premium-transition">Tentang</a>
                    <a href="#contact"
                        class="text-xs font-medium uppercase tracking-widest text-neutral-400 hover:text-white text-glow premium-transition">Kontak</a>
                </div>

                <button class="md:hidden text-neutral-400 hover:text-white premium-transition" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16M4 16h16">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="md:hidden hidden pb-6 bg-black/90 backdrop-blur-lg" id="mobile-menu">
                <div class="flex flex-col space-y-4 pt-2">
                    <a href="#home"
                        class="text-sm font-medium tracking-wide text-neutral-400 hover:text-white">Home</a>
                    <a href="#products"
                        class="text-sm font-medium tracking-wide text-neutral-400 hover:text-white">Produk</a>
                    <a href="#about"
                        class="text-sm font-medium tracking-wide text-neutral-400 hover:text-white">Tentang</a>
                    <a href="#contact"
                        class="text-sm font-medium tracking-wide text-neutral-400 hover:text-white">Kontak</a>
                    <a href="/login"
                        class="inline-block text-center text-sm font-semibold bg-white text-black py-2 rounded">Login
                        Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="home" class="relative w-full h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=1600&q=80" alt="Event Equipment"
                class="w-full h-full object-cover opacity-35 grayscale brightness-75">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-black/40"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center mt-12">
            <span class="text-xs font-bold tracking-[0.4em] text-neutral-400 uppercase inline-block mb-6">Elevate Your
                Event</span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-8 text-white tracking-tight leading-none uppercase">
                Perlengkapan Event<br>
                <span class="text-neutral-500 font-light italic lowercase font-serif">by</span> Profesional
            </h1>
            <p
                class="text-sm md:text-lg text-neutral-400 font-light max-w-2xl mx-auto tracking-wide leading-relaxed mb-12">
                Sewa sound system, lighting, kamera, dan perlengkapan event premium. Kemudahan akses teknologi panggung
                dalam genggaman Anda.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                <a href="#products"
                    class="w-full sm:w-auto px-10 py-4 bg-white text-black hover:bg-neutral-200 text-xs font-bold tracking-widest uppercase premium-transition shadow-2xl">
                    Jelajahi Produk
                </a>
                <button
                    class="w-full sm:w-auto px-10 py-4 border border-white/20 text-white hover:border-blue-500 hover:shadow-[0_0_20px_rgba(59,130,246,0.2)] text-xs font-bold tracking-widest uppercase premium-transition">
                    Pesan Sekarang
                </button>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-32 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
                <div>
                    <span class="text-xs font-bold tracking-[0.3em] text-neutral-500 uppercase block mb-3">Curated
                        Collection</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight uppercase">Kategori Perlengkapan</h2>
                </div>
                <p class="text-neutral-400 max-w-md font-light text-sm tracking-wide">Infrastruktur pendukung acara
                    terbaik yang dikelompokkan berdasarkan presisi fungsi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                {{-- Category Card Wrapper Macro --}}
                @php
                    $categories = [
                        [
                            'title' => 'Sound System',
                            'desc' => 'Speaker, amplifier, mixer',
                            'icon' =>
                                'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z',
                        ],
                        [
                            'title' => 'Lighting',
                            'desc' => 'Lampu panggung, efek',
                            'icon' =>
                                'M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-20C5.13 1 2 4.13 2 8c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm0 2c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5z',
                        ],
                        [
                            'title' => 'Kamera',
                            'desc' => 'DSLR, mirrorless, aksesoris',
                            'icon' =>
                                'M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z',
                        ],
                        [
                            'title' => 'Proyektor',
                            'desc' => 'Proyektor laser, LED',
                            'icon' =>
                                'M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h18v14zm-10-7l-5 5h3v3h4v-3h3l-5-5z',
                        ],
                        [
                            'title' => 'Panggung & Dekorasi',
                            'desc' => 'Scaffold, backdrop, banner',
                            'icon' =>
                                'M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H4V5h16v14zm-6-4l-4-4-4 4-3-3v8h16V8l-5 5z',
                        ],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <div
                        class="group bg-neutral-950 p-8 border border-white/5 hover:border-white/20 premium-transition cursor-pointer flex flex-col justify-between h-56">
                        <div class="text-neutral-400 group-hover:text-white premium-transition">
                            <svg class="w-8 h-8 stroke-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $cat['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white mb-1 uppercase tracking-wide">{{ $cat['title'] }}
                            </h3>
                            <p class="text-neutral-500 text-xs font-light tracking-wide">{{ $cat['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products Section --}}
    <section id="products" class="py-32 bg-neutral-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center mb-24">
                <span class="text-xs font-bold tracking-[0.3em] text-neutral-500 uppercase block mb-3">Premium
                    Standard</span>
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight uppercase mb-4">Produk Unggulan</h2>
                <div class="w-12 h-[1px] bg-white mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Product 1 --}}
                <div
                    class="group bg-black border border-white/5 overflow-hidden premium-transition flex flex-col justify-between">
                    <div class="relative overflow-hidden aspect-[4/3] bg-neutral-900">
                        <img src="https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=500&q=80"
                            alt="Speaker System"
                            class="w-full h-full object-cover opacity-80 group-hover:scale-105 premium-transition">
                        <span
                            class="absolute top-4 left-4 bg-white text-black text-[9px] font-bold tracking-widest uppercase px-3 py-1">Tersedia</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-lg font-bold uppercase tracking-wide text-white mb-2">Sistem Speaker Profesional
                        </h3>
                        <p class="text-neutral-400 text-xs font-light mb-6 tracking-wide">Speaker aktif 2000W dengan
                            built-in mixer</p>
                        <div class="flex items-center justify-between border-t border-white/5 pt-4">
                            <div>
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Harga / Hari</p>
                                <p class="text-lg font-bold text-white">Rp 500K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Stok</p>
                                <p class="text-sm font-medium text-neutral-300">8 Unit</p>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 bg-transparent hover:bg-white text-white hover:text-black border border-white/10 hover:border-white py-3 text-xs font-bold tracking-widest uppercase premium-transition">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 2 --}}
                <div
                    class="group bg-black border border-white/5 overflow-hidden premium-transition flex flex-col justify-between">
                    <div class="relative overflow-hidden aspect-[4/3] bg-neutral-900">
                        <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=500&q=80"
                            alt="Lighting System"
                            class="w-full h-full object-cover opacity-80 group-hover:scale-105 premium-transition">
                        <span
                            class="absolute top-4 left-4 bg-neutral-800 text-neutral-300 text-[9px] font-bold tracking-widest uppercase px-3 py-1">Terbatas</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-lg font-bold uppercase tracking-wide text-white mb-2">Sistem Pencahayaan LED
                        </h3>
                        <p class="text-neutral-400 text-xs font-light mb-6 tracking-wide">LED lighting berkualitas
                            tinggi dengan efek RGB</p>
                        <div class="flex items-center justify-between border-t border-white/5 pt-4">
                            <div>
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Harga / Hari</p>
                                <p class="text-lg font-bold text-white">Rp 350K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Stok</p>
                                <p class="text-sm font-medium text-neutral-300">3 Unit</p>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 bg-transparent hover:bg-white text-white hover:text-black border border-white/10 hover:border-white py-3 text-xs font-bold tracking-widest uppercase premium-transition">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 3 --}}
                <div
                    class="group bg-black border border-white/5 overflow-hidden premium-transition flex flex-col justify-between">
                    <div class="relative overflow-hidden aspect-[4/3] bg-neutral-900">
                        <img src="https://images.unsplash.com/photo-1499364615650-ec38552f4f34?w=500&q=80"
                            alt="Camera Kit"
                            class="w-full h-full object-cover opacity-80 group-hover:scale-105 premium-transition">
                        <span
                            class="absolute top-4 left-4 bg-white text-black text-[9px] font-bold tracking-widest uppercase px-3 py-1">Tersedia</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-lg font-bold uppercase tracking-wide text-white mb-2">Paket Kamera DSLR Pro
                        </h3>
                        <p class="text-neutral-400 text-xs font-light mb-6 tracking-wide">DSLR 4K dengan lensa dan
                            tripod profesional</p>
                        <div class="flex items-center justify-between border-t border-white/5 pt-4">
                            <div>
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Harga / Hari</p>
                                <p class="text-lg font-bold text-white">Rp 750K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Stok</p>
                                <p class="text-sm font-medium text-neutral-300">5 Unit</p>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 bg-transparent hover:bg-white text-white hover:text-black border border-white/10 hover:border-white py-3 text-xs font-bold tracking-widest uppercase premium-transition">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 4 --}}
                <div
                    class="group bg-black border border-white/5 overflow-hidden premium-transition flex flex-col justify-between">
                    <div class="relative overflow-hidden aspect-[4/3] bg-neutral-900">
                        <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&q=80"
                            alt="Microphone"
                            class="w-full h-full object-cover opacity-80 group-hover:scale-105 premium-transition">
                        <span
                            class="absolute top-4 left-4 bg-white text-black text-[9px] font-bold tracking-widest uppercase px-3 py-1">Tersedia</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-lg font-bold uppercase tracking-wide text-white mb-2">Sistem Mikrofon Nirkabel
                        </h3>
                        <p class="text-neutral-400 text-xs font-light mb-6 tracking-wide">4 channel wireless microphone
                            dengan jangkauan luas</p>
                        <div class="flex items-center justify-between border-t border-white/5 pt-4">
                            <div>
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Harga / Hari</p>
                                <p class="text-lg font-bold text-white">Rp 400K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Stok</p>
                                <p class="text-sm font-medium text-neutral-300">10 Unit</p>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 bg-transparent hover:bg-white text-white hover:text-black border border-white/10 hover:border-white py-3 text-xs font-bold tracking-widest uppercase premium-transition">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 5 --}}
                <div
                    class="group bg-black border border-white/5 overflow-hidden premium-transition flex flex-col justify-between opacity-60">
                    <div class="relative overflow-hidden aspect-[4/3] bg-neutral-900">
                        <img src="https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=500&q=80"
                            alt="Projector" class="w-full h-full object-cover opacity-50 grayscale">
                        <span
                            class="absolute top-4 left-4 bg-neutral-900 text-neutral-500 text-[9px] font-bold tracking-widest uppercase px-3 py-1">Maintenance</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-lg font-bold uppercase tracking-wide text-neutral-500 mb-2">Proyektor Laser
                            5000 Lumen</h3>
                        <p class="text-neutral-500 text-xs font-light mb-6 tracking-wide">Proyektor laser dengan
                            kualitas 4K HD</p>
                        <div class="flex items-center justify-between border-t border-white/5 pt-4">
                            <div>
                                <p class="text-neutral-600 text-[10px] uppercase tracking-wider mb-1">Harga / Hari</p>
                                <p class="text-lg font-bold text-neutral-600">Rp 1.2M</p>
                            </div>
                            <div class="text-right">
                                <p class="text-neutral-600 text-[10px] uppercase tracking-wider mb-1">Stok</p>
                                <p class="text-sm font-medium text-neutral-600">2 Unit</p>
                            </div>
                        </div>
                        <button disabled
                            class="w-full mt-6 bg-neutral-900 text-neutral-600 border border-neutral-800 py-3 text-xs font-bold tracking-widest uppercase cursor-not-allowed">
                            Sedang Diperbaiki
                        </button>
                    </div>
                </div>

                {{-- Product 6 --}}
                <div
                    class="group bg-black border border-white/5 overflow-hidden premium-transition flex flex-col justify-between">
                    <div class="relative overflow-hidden aspect-[4/3] bg-neutral-900">
                        <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=500&q=80"
                            alt="Stage Rig"
                            class="w-full h-full object-cover opacity-80 group-hover:scale-105 premium-transition">
                        <span
                            class="absolute top-4 left-4 bg-white text-black text-[9px] font-bold tracking-widest uppercase px-3 py-1">Tersedia</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-lg font-bold uppercase tracking-wide text-white mb-2">Rig Pencahayaan Panggung
                        </h3>
                        <p class="text-neutral-400 text-xs font-light mb-6 tracking-wide">Truss lengkap dengan beban
                            hingga 500kg</p>
                        <div class="flex items-center justify-between border-t border-white/5 pt-4">
                            <div>
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Harga / Hari</p>
                                <p class="text-lg font-bold text-white">Rp 600K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-neutral-500 text-[10px] uppercase tracking-wider mb-1">Stok</p>
                                <p class="text-sm font-medium text-neutral-300">6 Unit</p>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 bg-transparent hover:bg-white text-white hover:text-black border border-white/10 hover:border-white py-3 text-xs font-bold tracking-widest uppercase premium-transition">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-32 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center mb-24">
                <span class="text-xs font-bold tracking-[0.3em] text-neutral-500 uppercase block mb-3">Seamless
                    Process</span>
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight uppercase">Cara Kerja Rental</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                {{-- Step 1 --}}
                <div class="relative p-2 border-l border-white/10 hover:border-white premium-transition pl-8">
                    <div class="text-xs font-bold text-neutral-500 mb-4 tracking-widest uppercase">Phase 01</div>
                    <h3 class="text-xl font-bold text-white mb-3 uppercase tracking-wide">Pilih Perlengkapan</h3>
                    <p class="text-neutral-400 text-sm font-light leading-relaxed tracking-wide">Jelajahi katalog
                        digital terkurasi kami dan amankan aset esensial untuk kebutuhan acara Anda.</p>
                </div>

                {{-- Step 2 --}}
                <div class="relative p-2 border-l border-white/10 hover:border-white premium-transition pl-8">
                    <div class="text-xs font-bold text-neutral-500 mb-4 tracking-widest uppercase">Phase 02</div>
                    <h3 class="text-xl font-bold text-white mb-3 uppercase tracking-wide">Pesan & Pembayaran</h3>
                    <p class="text-neutral-400 text-sm font-light leading-relaxed tracking-wide">Konfirmasi tanggal
                        sewa melalui gerbang enkripsi pesanan instan kami dengan aman.</p>
                </div>

                {{-- Step 3 --}}
                <div class="relative p-2 border-l border-white/10 hover:border-white premium-transition pl-8">
                    <div class="text-xs font-bold text-neutral-500 mb-4 tracking-widest uppercase">Phase 03</div>
                    <h3 class="text-xl font-bold text-white mb-3 uppercase tracking-wide">Distribusi Logistik</h3>
                    <p class="text-neutral-400 text-sm font-light leading-relaxed tracking-wide">Pilih pengantaran
                        presisi langsung ke *venue* atau penjemputan mandiri di pusat logistik kami.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us Section --}}
    <section id="about" class="py-32 bg-neutral-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row gap-16 justify-between items-start">
                <div class="w-full lg:w-1/3">
                    <span class="text-xs font-bold tracking-[0.3em] text-neutral-500 uppercase block mb-3">Our
                        Values</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight uppercase leading-tight mb-6">Mengapa
                        Bermitra Dengan Kami</h2>
                    <div class="w-12 h-[1px] bg-white"></div>
                </div>

                <div class="w-full lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="border border-white/5 p-8 bg-black">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-3">Kualitas Premium Terjaga
                        </h3>
                        <p class="text-neutral-400 font-light text-xs leading-relaxed">Seluruh armada teknologi kami
                            melewati kalibrasi rutin dan pengujian performa ketat sebelum dikirim.</p>
                    </div>
                    <div class="border border-white/5 p-8 bg-black">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-3">Transparansi Budget</h3>
                        <p class="text-neutral-400 font-light text-xs leading-relaxed">Harga yang bersaing tanpa biaya
                            tersembunyi. Struktur penawaran yang dirancang fleksibel bagi korporasi maupun individu.</p>
                    </div>
                    <div class="border border-white/5 p-8 bg-black">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-3">Dukungan Teknis 24/7
                        </h3>
                        <p class="text-neutral-400 font-light text-xs leading-relaxed">Insinyur sistem berpengalaman
                            yang selalu siap sedia merespon segala kebutuhan darurat panggung Anda.</p>
                    </div>
                    <div class="border border-white/5 p-8 bg-black">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-3">Integritas Reputasi</h3>
                        <p class="text-neutral-400 font-light text-xs leading-relaxed">Telah dipercaya menangani
                            ratusan perhelatan berskala masif dengan tingkat kepuasan sempurna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-32 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center mb-24">
                <span class="text-xs font-bold tracking-[0.3em] text-neutral-500 uppercase block mb-3">Verified
                    Experience</span>
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight uppercase">Testimoni Pelanggan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div class="border border-white/5 p-8 bg-neutral-950 flex flex-col justify-between">
                    <p class="text-neutral-300 font-light text-sm leading-relaxed mb-8">
                        "Sangat profesional dalam menangani instalasi sound system. Peralatan bekerja tanpa kendala
                        sedikit pun. Sangat direkomendasikan!"
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?img=12" alt="Pelanggan 1"
                            class="w-10 h-10 rounded-full grayscale border border-white/10">
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-wide">Budi Santoso</h4>
                            <p class="text-neutral-500 text-[10px] uppercase tracking-wider">Corporate Event Organizer
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="border border-white/5 p-8 bg-neutral-950 flex flex-col justify-between">
                    <p class="text-neutral-300 font-light text-sm leading-relaxed mb-8">
                        "Paket pencahayaan mereka mentransformasi ruang pesta pernikahan menjadi sangat elegan. Tim
                        lapangan sangat responsif."
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?img=22" alt="Pelanggan 2"
                            class="w-10 h-10 rounded-full grayscale border border-white/10">
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-wide">Siti Nurhaliza</h4>
                            <p class="text-neutral-500 text-[10px] uppercase tracking-wider">Wedding Planner</p>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div class="border border-white/5 p-8 bg-neutral-950 flex flex-col justify-between">
                    <p class="text-neutral-300 font-light text-sm leading-relaxed mb-8">
                        "Harga kompetitif dengan aset perangkat panggung berstandar global. Mitra andalan kami untuk
                        puluhan event tahunan."
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?img=32" alt="Pelanggan 3"
                            class="w-10 h-10 rounded-full grayscale border border-white/10">
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-wide">Roni Wijaya</h4>
                            <p class="text-neutral-500 text-[10px] uppercase tracking-wider">Event Director</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-36 bg-neutral-950 relative overflow-hidden border-t border-white/5">
        <div class="relative max-w-4xl mx-auto px-6 text-center z-10">
            <h2 class="text-3xl sm:text-5xl md:text-6xl font-extrabold uppercase tracking-tight mb-6">
                Siap Mewujudkan Acara Spektakuler Anda?
            </h2>
            <p class="text-sm sm:text-base text-neutral-400 font-light mb-12 max-w-xl mx-auto tracking-wide">
                Hubungi kami sekarang dan diskusikan konfigurasi perangkat terbaik bersama spesialis teknis kami.
            </p>
            <a href="#products"
                class="inline-block px-12 py-4 bg-white text-black hover:bg-neutral-200 text-xs font-bold tracking-widest uppercase premium-transition">
                Sewa Sekarang
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

    {{-- JavaScript --}}
    <script>
        const navbar = document.getElementById('navbar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        // window.addEventListener('scroll', () => {
        //     if (window.scrollY > 50) {
        //         navbar.classList.add('bg-black/80', 'py-4');
        //         navbar.classList.remove('bg-black/30', 'py-6');
        //     } else {
        //         navbar.classList.add('bg-black/30', 'py-6');
        //         navbar.classList.remove('bg-black/80', 'py-4');
        //     }
        // });

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
