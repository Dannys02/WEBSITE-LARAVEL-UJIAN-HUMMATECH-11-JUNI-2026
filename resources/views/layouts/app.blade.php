<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - Pusat Rental</title>
    @php
        $user = App\Models\User::find(1);
    @endphp
    @if ($user && $user->image)
        <link rel="icon" href="{{ asset('storage/' . $user->image) }}" type="image/png">
    @else
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" type="image/png">
    @endif
    <!-- Google Fonts: Inter for Modern SaaS Look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        // Custom Indigo accent palette for professional theme
                        indigo: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Scrollbar to maintain clean look */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 font-sans flex min-h-screen overflow-x-hidden">

    <!-- ==========================================
         NOTIFICATION SYSTEM 
         ========================================== -->

    <!-- Toast Notification Container (Success & Warning) -->
    <div id="toastContainer" class="fixed top-5 right-5 z-[80] flex flex-col gap-3 pointer-events-none">
        
        <!-- Success Toast -->
        @if (session('success'))
            <div class="toast-notification pointer-events-auto flex items-center w-full max-w-xs p-4 text-slate-800 bg-white rounded-xl shadow-lg shadow-emerald-100/50 border border-slate-100 transform transition-all duration-500 translate-x-full opacity-0">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-3 text-sm font-semibold">{{ session('success') }}</div>
                <button type="button" class="close-toast ml-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-200 p-1.5 hover:bg-slate-100 inline-flex h-8 w-8 items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif
        
        <!-- Warning Toast -->
        @if (session('warning'))
            <div class="toast-notification pointer-events-auto flex items-center w-full max-w-xs p-4 text-slate-800 bg-white rounded-xl shadow-lg shadow-amber-100/50 border border-slate-100 transform transition-all duration-500 translate-x-full opacity-0">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-amber-500 bg-amber-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="ml-3 text-sm font-semibold">{{ session('warning') }}</div>
                <button type="button" class="close-toast ml-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-200 p-1.5 hover:bg-slate-100 inline-flex h-8 w-8 items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Error Modal Alert (Validation Errors) -->
    @if ($errors->any())
        <div id="errorModal" class="fixed inset-0 z-[90] flex items-center justify-center bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300 opacity-100">
            <!-- Modal Content Wrapper -->
            <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300 m-4 scale-95 opacity-0">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-rose-50/50">
                    <div class="flex items-center gap-3 text-rose-600">
                        <div class="bg-rose-100 p-2 rounded-full">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Peringatan Kesalahan</h3>
                    </div>
                    <button type="button" id="closeErrorModal" class="text-slate-400 hover:text-slate-700 bg-slate-50 hover:bg-slate-100 p-1.5 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="px-6 py-5">
                    <p class="text-sm text-slate-600 mb-4 font-medium">Mohon perbaiki kesalahan berikut sebelum melanjutkan:</p>
                    <div class="bg-rose-50/80 rounded-xl p-4 border border-rose-100">
                        <ul class="list-disc pl-5 space-y-1.5 text-sm text-rose-700 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end">
                    <button type="button" id="btnUnderstandError" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition-all shadow-sm focus:ring-4 focus:ring-slate-200">
                        Saya Mengerti
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- ==========================================
         END NOTIFICATION SYSTEM 
         ========================================== -->

    <!-- Mobile Sidebar Overlay (Vanilla JS toggled) -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity duration-300 opacity-0 cursor-pointer"></div>

    <!-- Sidebar / Aside -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 flex flex-col shadow-2xl lg:shadow-none transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <!-- Brand/Logo Area -->
        <div class="flex h-16 shrink-0 items-center px-6 border-b border-slate-100">
            <a href="/" class="flex items-center gap-3 group">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white font-bold transition-transform group-hover:scale-105 shadow-md shadow-indigo-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="text-lg font-bold text-slate-900 tracking-tight">Pusat Rental</span>
            </a>
            <!-- Mobile Close Button inside sidebar -->
            <button id="closeSidebarBtn" class="lg:hidden ml-auto text-slate-400 hover:text-slate-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
            <!-- Dashboard Item -->
            <a href="{{ route('admin.dashboard') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50 ring-1 ring-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <!-- Produk Item -->
            <a href="{{ route('products.index') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50 ring-1 ring-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('products.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Produk
            </a>

            <!-- Customer Item -->
            <a href="{{ route('customers.index') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('customers.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50 ring-1 ring-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('customers.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Customer
            </a>

            <!-- Transaksi Rental Item -->
            <a href="{{ route('rentals.index') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('rentals.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50 ring-1 ring-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('rentals.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Transaksi Rental
            </a>

            <!-- Barang Dipinjam Item -->
            <a href="{{ route('borrowed.index') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('borrowed.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50 ring-1 ring-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('borrowed.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
                Barang Dipinjam
            </a>

            <!-- Setting Item -->
            <a href="{{ route('settings.show') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('settings.show') ? 'bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50 ring-1 ring-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('settings.show') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan
            </a>
        </nav>

        <!-- Logout Section -->
        <div class="mt-auto p-4 border-t border-slate-100 bg-slate-50/30">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition-all hover:bg-rose-50 hover:text-rose-600">
                    <svg class="h-5 w-5 shrink-0 text-slate-400 group-hover:text-rose-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Wrapper Area -->
    <div class="flex-1 flex flex-col lg:ml-64 bg-slate-50 min-h-screen transition-all duration-300">
        
        <!-- Sticky Navbar with background blur -->
        <header class="sticky top-0 z-40 bg-white/70 backdrop-blur-lg border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-8 transition-all shadow-sm">
            
            <!-- Left Side Navbar -->
            <div class="flex items-center gap-3 lg:gap-4">
                <!-- Mobile Hamburger Menu Button -->
                <button id="mobileMenuBtn" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 focus:outline-none transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">@yield('page_title', 'Dashboard')</h1>
            </div>
            
            <!-- Right Side Navbar (User Profile) -->
            <div class="flex items-center gap-4">
                <a href="{{ route('settings.show') }}" class="flex items-center gap-3 group bg-white/50 px-2 lg:px-3 py-1.5 rounded-full lg:rounded-2xl hover:bg-slate-100 transition-colors border border-transparent hover:border-slate-200">
                    <!-- User Info Text -->
                    <div class="hidden lg:block text-right">
                        <p class="text-sm font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors leading-tight">{{ Auth::user()->name }}</p>
                        <!-- Menampilkan email user sesuai instruksi -->
                        <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="relative">
                        <!-- Avatar Placeholder / Image -->
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}"
                                class="h-9 w-9 rounded-full object-cover border border-slate-200 shadow-sm group-hover:border-indigo-300 transition-all" />
                        @else
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-50 text-indigo-700 font-bold border border-indigo-100 shadow-sm group-hover:bg-indigo-100 transition-all text-sm">
                                {{ collect(explode(' ', Auth::user()->name))->map(fn($w) => $w[0])->join('') }}
                            </div>
                        @endif
                        <!-- Online Status Indicator -->
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                    </div>
                </a>
            </div>
        </header>

        <!-- Main Dashboard Content -->
        <main class="flex-1 p-4 lg:p-8 overflow-x-hidden relative">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Content Area injected by specific views -->
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Vanilla JavaScript Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ==========================================
            // NOTIFICATIONS & MODALS (TOASTS + ALERTS)
            // ==========================================

            // Handle Toast Notifications (Success & Warning)
            const toasts = document.querySelectorAll('.toast-notification');
            toasts.forEach(toast => {
                // 1. Entrance animation after DOM loads
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                }, 100);

                // 2. Logic to close a toast smoothly
                const closeToast = () => {
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 500); // Remove from DOM after CSS transition
                };

                // 3. Auto-close functionality (5 seconds)
                const autoCloseTimeout = setTimeout(closeToast, 5000);

                // 4. Manual close button functionality
                const closeBtn = toast.querySelector('.close-toast');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        clearTimeout(autoCloseTimeout); // Prevent double-trigger
                        closeToast();
                    });
                }
            });

            // Handle Error Modal Alert
            const errorModal = document.getElementById('errorModal');
            if (errorModal) {
                const modalContent = errorModal.querySelector('.modal-content');
                const closeErrorModalBtn = document.getElementById('closeErrorModal');
                const btnUnderstandError = document.getElementById('btnUnderstandError');

                // 1. Entrance animation for the modal box
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);

                // 2. Logic to close the modal smoothly
                const closeErrorModal = () => {
                    // Animate out
                    modalContent.classList.remove('scale-100', 'opacity-100');
                    modalContent.classList.add('scale-95', 'opacity-0');
                    errorModal.classList.add('opacity-0');
                    
                    // Remove from DOM after transition
                    setTimeout(() => errorModal.remove(), 300);
                };

                // 3. Add Event Listeners for closing the modal
                if (closeErrorModalBtn) closeErrorModalBtn.addEventListener('click', closeErrorModal);
                if (btnUnderstandError) btnUnderstandError.addEventListener('click', closeErrorModal);
                
                // 4. Allow closing by clicking the backdrop overlay
                errorModal.addEventListener('click', (e) => {
                    if (e.target === errorModal) closeErrorModal();
                });
            }

            // ==========================================
            // MOBILE SIDEBAR TOGGLE
            // ==========================================

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');

            // Function to toggle mobile sidebar visibility
            function toggleSidebar() {
                const isClosed = sidebar.classList.contains('-translate-x-full');
                if (isClosed) {
                    // Open Sidebar
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    // Small delay to allow display to apply before opacity transition
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                } else {
                    // Close Sidebar
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('opacity-0');
                    // Wait for transition to finish before hiding display
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                }
            }

            // Event Listeners for mobile sidebar navigation
            if(mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
            if(closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>
