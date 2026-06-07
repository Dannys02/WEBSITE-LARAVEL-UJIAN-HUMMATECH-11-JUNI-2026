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
        <div class="border-b border-gray-700 px-5 {{ Auth::user()->image ? 'py-3.5' : 'py-5' }} flex items-center">
            <a href="/" class="flex items-center gap-3">
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
            </a>
        </div>

        <!-- Menu Items -->
        <ul class="list-none space-y-0 pt-5 pb-24">
    <li>
        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('products.index') }}"
            class="{{ request()->routeIs('products.*') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            <span>Produk</span>
        </a>
    </li>
    <li>
        <a href="{{ route('customers.index') }}"
            class="{{ request()->routeIs('customers.*') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <span>Customer</span>
        </a>
    </li>
    <li>
        <a href="{{ route('rentals.index') }}"
            class="{{ request()->routeIs('rentals.*') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
            <span>Transaksi Rental</span>
        </a>
    </li>
    <li>
        <a href="{{ route('borrowed.index') }}"
            class="{{ request()->routeIs('borrowed.*') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
            </svg>
            <span>Barang Dipinjam</span>
        </a>
    </li>
    <li>
        <a href="{{ route('settings.show') }}"
            class="{{ request()->routeIs('settings.show') ? 'bg-cyan-500/10 text-white' : '' }} flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-300 transition-all hover:bg-cyan-500/10 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
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
                <div class="error-alert bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg mb-6">
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
