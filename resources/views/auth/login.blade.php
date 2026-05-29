<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login | Rental Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="flex flex-col justify-center py-12 sm:px-6 lg:px-8 text-white antialiased selection:bg-blue-500 selection:text-white">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <!-- Logo Placeholder / Icon Modern -->
        <div
            class="mx-auto h-12 w-12 rounded-lg bg-gradient-to-br from-blue-600 to-slate-800 flex items-center justify-center border border-slate-700 shadow-lg shadow-blue-500/10">
            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-12h9.75c1.057 0 1.913.856 1.913 1.913v9.174c0 1.057-.856 1.913-1.913 1.913H7.5c-1.057 0-1.913-.856-1.913-1.913V7.913C5.587 6.856 6.443 6 7.5 6z" />
            </svg>
        </div>
        <h2 class="mt-6 text-2xl font-bold tracking-tight text-slate-100">
            Rental Event
        </h2>
        <p class="mt-2 text-sm text-slate-400">
            Masuk untuk mengelola event Anda
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <!-- Card Login -->
        <div
            class="bg-slate-900/50 backdrop-blur-md px-6 py-8 border border-slate-800/80 rounded-xl shadow-2xl sm:px-10">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Email Address
                    </label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                            value="{{ old('email') }}"
                            class="block w-full rounded-md border-0 bg-slate-950/60 py-2.5 px-3.5 text-slate-200 placeholder-slate-600 shadow-sm ring-1 ring-inset ring-slate-800 focus:ring-2 focus:ring-inset focus:ring-blue-500 text-sm transition-all duration-200"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs text-red-400 flex items-center gap-1">
                            <span class="inline-block w-1 h-1 rounded-full bg-red-400"></span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password"
                            class="block text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Password
                        </label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            class="block w-full rounded-md border-0 bg-slate-950/60 py-2.5 px-3.5 text-slate-200 placeholder-slate-600 shadow-sm ring-1 ring-inset ring-slate-800 focus:ring-2 focus:ring-inset focus:ring-blue-500 text-sm transition-all duration-200"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs text-red-400 flex items-center gap-1">
                            <span class="inline-block w-1 h-1 rounded-full bg-red-400"></span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/10 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all duration-200 active:scale-[0.98]">
                        Masuk
                    </button>
                </div>

                <p class="text-center">Belum memiliki akun? <a href="{{ route('register') }}"
                        class="font-medium text-blue-400 hover:text-blue-300 transition-colors">Daftar di sini</a></p>
            </form>
        </div>

        <!-- Footer / Link Tambahan -->
        <p class="mt-8 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Rental Event. All rights reserved.
        </p>
    </div>
</body>

</html>
