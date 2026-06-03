<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Banyuwangi - Sistem Rental Perlengkapan Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-transparent {
            background-color: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .navbar-solid {
            background-color: rgba(0, 0, 0, 0.95);
        }

        .hero-overlay {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(15, 23, 42, 0.7) 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .statue-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-black text-gray-100 font-sans antialiased">

    {{-- Navbar Section --}}
    <nav class="navbar-transparent fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">Rental
                        Banyuwangi</span>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-300 hover:text-white transition-colors duration-300">Home</a>
                    <a href="#products" class="text-gray-300 hover:text-white transition-colors duration-300">Produk</a>
                    <a href="#about" class="text-gray-300 hover:text-white transition-colors duration-300">Tentang</a>
                    <a href="#contact" class="text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
                </div>

                <!-- Login Button -->
                {{-- <div class="hidden md:flex gap-2">
                    <a href="/login" class="btn-primary px-6 py-2 rounded-lg font-semibold text-white">
                        Login
                    </a>
                    <a href="/daftar" class="border border-blue-400 px-6 py-2 rounded-lg font-semibold transform text-white transition-all ease duration-300 hover:shadow-[0_10px_25px_rgba(59,130,246,0.3)] hover:translate-y-[-2px]">
                     Daftar
                    </a>
                </div> --}}

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-300 hover:text-white" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden hidden pb-4" id="mobile-menu">
                <a href="#home" class="block px-4 py-2 text-gray-300 hover:text-white">Home</a>
                <a href="#products" class="block px-4 py-2 text-gray-300 hover:text-white">Produk</a>
                <a href="#about" class="block px-4 py-2 text-gray-300 hover:text-white">Tentang</a>
                <a href="#contact" class="block px-4 py-2 text-gray-300 hover:text-white">Kontak</a>
                <a href="/login" class="block px-4 py-2 mt-2 btn-primary rounded-lg text-white">Login Dashboard</a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="home" class="relative w-full h-screen flex items-center justify-center overflow-hidden pt-20">
        <!-- Background Image dengan Overlay -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=1600&q=80" alt="Event Equipment"
                class="w-full h-full object-cover">
            <div class="hero-overlay absolute inset-0"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white leading-tight">
                Perlengkapan Event<br>
                <span
                    class="bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">Profesional</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Sewa sound system, lighting, kamera, dan perlengkapan event dengan mudah, cepat, dan terpercaya.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="#products" class="btn-primary px-8 py-3 rounded-lg font-semibold text-white text-lg">
                    Jelajahi Produk
                </a>
                <button
                    class="px-8 py-3 rounded-lg font-semibold text-blue-400 border-2 border-blue-400 hover:bg-blue-400 hover:text-black transition-all duration-300">
                    Pesan Sekarang
                </button>
            </div>

            <!-- Statistics -->
            {{-- <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                <div>
                    <div class="statue-number">300+</div>
                    <p class="text-gray-300 text-sm mt-2">Penyewaan Sukses</p>
                </div>
                <div>
                    <div class="statue-number">120+</div>
                    <p class="text-gray-300 text-sm mt-2">Klien Puas</p>
                </div>
                <div>
                    <div class="statue-number">50+</div>
                    <p class="text-gray-300 text-sm mt-2">Jenis Alat</p>
                </div>
            </div> --}}
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-20 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="section-title text-4xl md:text-5xl font-bold mb-4">
                    Kategori Perlengkapan
                </h2>
                <p class="text-gray-400 text-lg">Temukan perlengkapan event yang Anda butuhkan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                {{-- Category 1: Sound System --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-center cursor-pointer border border-slate-700 hover:border-blue-500">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Sound System</h3>
                    <p class="text-gray-400 text-sm">Speaker, amplifier, mixer</p>
                </div>

                {{-- Category 2: Lighting --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-center cursor-pointer border border-slate-700 hover:border-blue-500">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-20C5.13 1 2 4.13 2 8c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm0 2c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Lighting</h3>
                    <p class="text-gray-400 text-sm">Lampu panggung, efek cahaya</p>
                </div>

                {{-- Category 3: Camera --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-center cursor-pointer border border-slate-700 hover:border-blue-500">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Kamera</h3>
                    <p class="text-gray-400 text-sm">DSLR, mirrorless, aksesoris</p>
                </div>

                {{-- Category 4: Projector --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-center cursor-pointer border border-slate-700 hover:border-blue-500">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h18v14zm-10-7l-5 5h3v3h4v-3h3l-5-5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Proyektor</h3>
                    <p class="text-gray-400 text-sm">Proyektor laser, LED</p>
                </div>

                {{-- Category 5: Stage Equipment --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-center cursor-pointer border border-slate-700 hover:border-blue-500">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-cyan-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H4V5h16v14zm-6-4l-4-4-4 4-3-3v8h16V8l-5 5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Panggung & Dekorasi</h3>
                    <p class="text-gray-400 text-sm">Scaffold, backdrop, banner</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products Section --}}
    <section id="products" class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="section-title text-4xl md:text-5xl font-bold mb-4">
                    Produk Unggulan
                </h2>
                <p class="text-gray-400 text-lg">Peralatan berkualitas premium dengan harga terjangkau</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Product 1: Professional Speaker System --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-900 to-slate-950 rounded-xl overflow-hidden border border-slate-800">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=500&q=80"
                            alt="Speaker System" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">Tersedia</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Sistem Speaker Profesional</h3>
                        <p class="text-gray-400 text-sm mb-4">Speaker aktif 2000W dengan built-in mixer</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Harga per hari</p>
                                <p class="text-2xl font-bold text-blue-400">Rp 500K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-xl font-bold text-white">8</p>
                            </div>
                        </div>
                        <button class="w-full mt-4 btn-primary px-4 py-2 rounded-lg font-semibold text-white">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 2: LED Lighting System --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-900 to-slate-950 rounded-xl overflow-hidden border border-slate-800">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=500&q=80"
                            alt="Lighting System" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold">Terbatas</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Sistem Pencahayaan LED</h3>
                        <p class="text-gray-400 text-sm mb-4">LED lighting berkualitas tinggi dengan efek RGB</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Harga per hari</p>
                                <p class="text-2xl font-bold text-blue-400">Rp 350K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-xl font-bold text-white">3</p>
                            </div>
                        </div>
                        <button class="w-full mt-4 btn-primary px-4 py-2 rounded-lg font-semibold text-white">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 3: Professional Camera Kit --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-900 to-slate-950 rounded-xl overflow-hidden border border-slate-800">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1499364615650-ec38552f4f34?w=500&q=80"
                            alt="Camera Kit" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">Tersedia</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Paket Kamera DSLR Pro</h3>
                        <p class="text-gray-400 text-sm mb-4">DSLR 4K dengan lensa dan tripod profesional</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Harga per hari</p>
                                <p class="text-2xl font-bold text-blue-400">Rp 750K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-xl font-bold text-white">5</p>
                            </div>
                        </div>
                        <button class="w-full mt-4 btn-primary px-4 py-2 rounded-lg font-semibold text-white">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 4: Wireless Microphone System --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-900 to-slate-950 rounded-xl overflow-hidden border border-slate-800">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&q=80"
                            alt="Microphone" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">Tersedia</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Sistem Mikrofon Nirkabel</h3>
                        <p class="text-gray-400 text-sm mb-4">4 channel wireless microphone dengan jangkauan luas</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Harga per hari</p>
                                <p class="text-2xl font-bold text-blue-400">Rp 400K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-xl font-bold text-white">10</p>
                            </div>
                        </div>
                        <button class="w-full mt-4 btn-primary px-4 py-2 rounded-lg font-semibold text-white">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                {{-- Product 5: Laser Projector --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-900 to-slate-950 rounded-xl overflow-hidden border border-slate-800">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=500&q=80"
                            alt="Projector" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">Maintenance</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Proyektor Laser 5000 Lumen</h3>
                        <p class="text-gray-400 text-sm mb-4">Proyektor laser dengan kualitas 4K HD</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Harga per hari</p>
                                <p class="text-2xl font-bold text-blue-400">Rp 1.2M</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-xl font-bold text-white">2</p>
                            </div>
                        </div>
                        <button disabled
                            class="w-full mt-4 px-4 py-2 rounded-lg font-semibold text-gray-500 bg-gray-800 cursor-not-allowed">
                            Sedang Diperbaiki
                        </button>
                    </div>
                </div>

                {{-- Product 6: Stage Lighting Rig --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-900 to-slate-950 rounded-xl overflow-hidden border border-slate-800">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=500&q=80"
                            alt="Stage Rig" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">Tersedia</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Rig Pencahayaan Panggung</h3>
                        <p class="text-gray-400 text-sm mb-4">Truss lengkap dengan beban hingga 500kg</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Harga per hari</p>
                                <p class="text-2xl font-bold text-blue-400">Rp 600K</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-xl font-bold text-white">6</p>
                            </div>
                        </div>
                        <button class="w-full mt-4 btn-primary px-4 py-2 rounded-lg font-semibold text-white">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-20 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="section-title text-4xl md:text-5xl font-bold mb-4">
                    Cara Kerja Event Rental
                </h2>
                <p class="text-gray-400 text-lg">Proses penyewaan yang mudah dan cepat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Step 1 --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-8 border border-slate-700 relative">
                    <div
                        class="absolute top-6 right-6 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        1
                    </div>
                    <div class="mb-6">
                        <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Pilih Perlengkapan</h3>
                    <p class="text-gray-400">Jelajahi katalog lengkap kami dan pilih perlengkapan yang sesuai dengan
                        kebutuhan acara Anda.</p>
                </div>

                {{-- Step 2 --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-8 border border-slate-700 relative">
                    <div
                        class="absolute top-6 right-6 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        2
                    </div>
                    <div class="mb-6">
                        <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Pesan & Pembayaran</h3>
                    <p class="text-gray-400">Isi formulir pemesanan Anda, pilih tanggal rental, dan lakukan pembayaran
                        dengan aman.</p>
                </div>

                {{-- Step 3 --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-8 border border-slate-700 relative">
                    <div
                        class="absolute top-6 right-6 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        3
                    </div>
                    <div class="mb-6">
                        <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Pengiriman atau Ambil</h3>
                    <p class="text-gray-400">Pilih opsi pengiriman ke lokasi acara Anda atau ambil langsung di kantor
                        kami.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us Section --}}
    <section id="about" class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="section-title text-4xl md:text-5xl font-bold mb-4">
                    Mengapa Pilih Event Rental
                </h2>
                <p class="text-gray-400 text-lg">Komitmen kami untuk memberikan layanan terbaik</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Reason 1 --}}
                <div
                    class="card-hover flex gap-6 p-8 rounded-xl bg-gradient-to-br from-slate-900 to-slate-950 border border-slate-800">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-blue-500">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Peralatan Berkualitas Premium</h3>
                        <p class="text-gray-400">Semua peralatan kami dipilih dan dirawat dengan standar profesional
                            tertinggi untuk memastikan kualitas terbaik.</p>
                    </div>
                </div>

                {{-- Reason 2 --}}
                <div
                    class="card-hover flex gap-6 p-8 rounded-xl bg-gradient-to-br from-slate-900 to-slate-950 border border-slate-800">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-green-500">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Harga Terjangkau</h3>
                        <p class="text-gray-400">Kami menawarkan paket harga yang kompetitif dan fleksibel sesuai
                            dengan budget acara Anda.</p>
                    </div>
                </div>

                {{-- Reason 3 --}}
                <div
                    class="card-hover flex gap-6 p-8 rounded-xl bg-gradient-to-br from-slate-900 to-slate-950 border border-slate-800">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-purple-500">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Dukungan Cepat</h3>
                        <p class="text-gray-400">Tim support kami siap membantu 24/7 untuk memastikan acara Anda
                            berjalan lancar tanpa hambatan.</p>
                    </div>
                </div>

                {{-- Reason 4 --}}
                <div
                    class="card-hover flex gap-6 p-8 rounded-xl bg-gradient-to-br from-slate-900 to-slate-950 border border-slate-800">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-pink-500">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Layanan Terpercaya</h3>
                        <p class="text-gray-400">Kami telah melayani ratusan acara dengan kepuasan pelanggan yang
                            tinggi dan track record terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-20 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="section-title text-4xl md:text-5xl font-bold mb-4">
                    Testimoni Pelanggan
                </h2>
                <p class="text-gray-400 text-lg">Kepuasan pelanggan adalah prioritas utama kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-8 border border-slate-700">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/150?img=12" alt="Pelanggan 1"
                            class="w-14 h-14 rounded-full border-2 border-blue-500">
                        <div class="ml-4">
                            <h4 class="text-white font-bold">Budi Santoso</h4>
                            <p class="text-gray-400 text-sm">Organizer Acara Korporat</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <span class="text-yellow-400">★ ★ ★ ★ ★</span>
                    </div>
                    <p class="text-gray-300">
                        "Event Rental sangat profesional dalam menangani kebutuhan sound system kami. Peralatan
                        berkualitas dan delivery tepat waktu. Highly recommended!"
                    </p>
                </div>

                {{-- Testimonial 2 --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-8 border border-slate-700">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/150?img=22" alt="Pelanggan 2"
                            class="w-14 h-14 rounded-full border-2 border-blue-500">
                        <div class="ml-4">
                            <h4 class="text-white font-bold">Siti Nurhaliza</h4>
                            <p class="text-gray-400 text-sm">Event Organizer Pernikahan</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <span class="text-yellow-400">★ ★ ★ ★ ★</span>
                    </div>
                    <p class="text-gray-300">
                        "Paket lengkap lighting mereka membuat pernikahan saya terlihat spektakuler. Tim support mereka
                        sangat responsif dan helpful. Terima kasih!"
                    </p>
                </div>

                {{-- Testimonial 3 --}}
                <div
                    class="card-hover bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-8 border border-slate-700">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/150?img=32" alt="Pelanggan 3"
                            class="w-14 h-14 rounded-full border-2 border-blue-500">
                        <div class="ml-4">
                            <h4 class="text-white font-bold">Roni Wijaya</h4>
                            <p class="text-gray-400 text-sm">Wedding & Event Planner</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <span class="text-yellow-400">★ ★ ★ ★ ★</span>
                    </div>
                    <p class="text-gray-300">
                        "Harga kompetitif dengan kualitas terbaik. Saya sudah pakai Event Rental untuk puluhan acara.
                        Selalu memuaskan dan reliable!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 bg-gradient-to-r from-slate-900 to-slate-950 relative overflow-hidden">
        <!-- Decorative elements -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -mr-40">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -ml-40">
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="section-title text-5xl md:text-6xl font-bold mb-6">
                Siap Untuk Acara Berikutnya Anda?
            </h2>
            <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                Jangan lewatkan kesempatan untuk membuat acara Anda menjadi luar biasa dengan perlengkapan berkualitas
                dari Event Rental.
            </p>
            <a href="#products" class="btn-primary inline-block px-10 py-4 rounded-lg font-bold text-white text-lg">
                Sewa Sekarang
            </a>
        </div>
    </section>

    {{-- Footer Section --}}
    <footer class="bg-black border-t border-slate-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                {{-- Column 1: Logo & Description --}}
                <div>
                    <h3 class="text-2xl font-bold mb-4">
                        <span class="bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">Event
                            Rental</span>
                    </h3>
                    <p class="text-gray-400 text-sm mb-6">
                        Solusi rental perlengkapan event profesional yang terpercaya sejak 2020. Kami siap membuat acara
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
                                    d="M23 3a10.9 10.9 0 11-3.14 1.53 4.48 4.48 0 00.33-2.82v-.2A10.64 10.64 0 0023 3z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-blue-500 flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <rect width="24" height="24" fill="none" />
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z" />
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
                            {{-- +62 812-3456-7890 --}}
                            {{ Auth::user()->formatPhoneInWelcome() }}
                        </li>
                        <li class="text-gray-400 text-sm">
                            <strong class="text-white">Email:</strong><br>
                            info@Event Rental.com
                        </li>
                        <li class="text-gray-400 text-sm">
                            <strong class="text-white">Alamat:</strong><br>
                            Jl. Event No. 123, Jakarta Tim
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
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
        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-solid');
            } else {
                navbar.classList.remove('navbar-solid');
                navbar.classList.add('navbar-transparent');
            }
        });

        // Mobile Menu Toggle
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>
