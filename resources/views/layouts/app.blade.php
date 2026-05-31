<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - Rental Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-50 text-gray-900">
    <!-- SIDEBAR/ASIDE -->
    <aside
        class="h-screen fixed w-64 overflow-y-auto bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-lg z-50">
        <!-- Brand/Logo -->
        <div class="border-b border-gray-700 px-5 py-5">
            <div class="flex items-center gap-3">
                @if (Auth::user()->image)
                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}"
                        class="h-12 w-12 rounded-full object-cover" />
                @else
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-cyan-400 to-blue-600 text-lg">
                        📦
                    </div>
                @endif
                <span class="text-xl font-bold">Pusat Rental</span>
            </div>
        </div>

        <!-- Menu Items -->
        <ul class="list-none space-y-0 pt-5 pb-24">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
                    <span class="text-lg">📊</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}"
                    class="{{ request()->routeIs('products.*') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
                    <span class="text-lg">📦</span>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
                    <span class="text-lg">👥</span>
                    <span>Customer</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
                    <span class="text-lg">🔄</span>
                    <span>Transaksi Rental</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.show') }}"
                    class="{{ request()->routeIs('settings.show') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
                    <span class="text-lg">⚙️</span>
                    <span>Setting</span>
                </a>
            </li>
        </ul>

        <!-- Logout Button -->
        <div class="absolute bottom-0 left-0 right-0 border-t border-gray-700 bg-black/20 p-5">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-lg border border-red-400/30 bg-red-500/10 px-4 py-2 text-sm font-medium text-red-500 transition-all hover:border-red-400 hover:bg-red-500/20">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="ml-64 flex flex-1 flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-gray-200 bg-white px-8 py-5 shadow-sm">
            <h1 class="text-2xl font-bold text-gray-900">@yield('page_title', 'Dashboard')</h1>
            <div class="flex items-center gap-3 text-sm text-gray-600">
                <span>👋 Halo, {{ Auth::user()->name }}</span>
                <a href="{{ route('settings.show') }}">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}"
                            class="h-9 w-9 rounded-full object-cover" />
                    @else
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 font-bold text-white">
                            {{ collect(explode(' ', Auth::user()->name))->map(fn($w) => $w[0])->join('') }}</div>
                    @endif
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto px-8 py-8">
            @if ($errors->any())
                <div class="notif bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg mb-6">
                    <strong class="block mb-2">❌ Terjadi kesalahan:</strong>
                    <ul class="margin-0 pl-6 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="notif bg-emerald-50 border border-emerald-100 text-emerald-800 p-4 rounded-lg mb-6 flex items-center gap-3 before:content-['✓'] before:inline-flex before:items-center before:justify-center before:w-5 before:h-5 before:bg-emerald-500 before:text-white before:rounded-full before:text-[12px] before:flex-shrink-0">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        setTimeout(() => {
            document.querySelectorAll('.notif').forEach(el => el.remove());
        }, 5000);
    </script>
</body>

</html>
