<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Akun | Rental Event</title>
    <meta name="description" content="Buat akun baru di Rental Event untuk mulai mengelola penyewaan peralatan event profesional.">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font: Plus Jakarta Sans — konsisten dengan halaman welcome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @php
        $user = App\Models\User::find(1);
    @endphp
    @if ($user && $user->image)
        <link rel="icon" href="{{ asset('storage/' . $user->image) }}" type="image/png">
    @else
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" type="image/png">
    @endif

    <style>
        /* ==================== BASE FONT ==================== */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ==================== ANIMASI FLOATING BLOBS ==================== */
        @keyframes float-slow {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -20px) scale(1.05); }
            66% { transform: translate(-20px, 15px) scale(0.95); }
        }

        @keyframes float-slow-reverse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-25px, 20px) scale(0.95); }
            66% { transform: translate(15px, -25px) scale(1.05); }
        }

        .blob-1 {
            animation: float-slow 12s ease-in-out infinite;
        }

        .blob-2 {
            animation: float-slow-reverse 14s ease-in-out infinite;
        }

        .blob-3 {
            animation: float-slow 16s ease-in-out infinite;
        }

        /* ==================== ANIMASI FADE-IN CARD ==================== */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out both;
        }

        .animate-delay-100 {
            animation-delay: 100ms;
        }

        .animate-delay-200 {
            animation-delay: 200ms;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 antialiased selection:bg-blue-600 selection:text-white flex items-center justify-center relative overflow-hidden">

    <!-- ==================== BACKGROUND DEKORATIF ==================== -->
    <!-- Gradient blobs — identik dengan hero section di welcome page -->
    <div class="absolute inset-0 pointer-events-none -z-10" aria-hidden="true">
        <div class="blob-1 absolute -top-32 -right-32 w-[500px] h-[500px] bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-[0.15]"></div>
        <div class="blob-2 absolute -bottom-32 -left-32 w-[500px] h-[500px] bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-[0.15]"></div>
        <div class="blob-3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-[0.08]"></div>
    </div>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <div class="w-full max-w-md mx-auto px-4 sm:px-0 py-12">

        <!-- Branding Header -->
        <div class="text-center mb-8 animate-fade-in-up">
            <!-- Logo — mengambil logo user dari database seperti welcome page -->
            <div class="mx-auto mb-6">
                @if ($user && $user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Logo"
                        class="w-16 h-16 rounded-full object-cover mx-auto shadow-lg shadow-blue-600/10 ring-4 ring-white">
                @else
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center mx-auto shadow-lg shadow-blue-600/20 ring-4 ring-white">
                        <span class="text-white font-extrabold text-xl">R</span>
                    </div>
                @endif
            </div>

            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                Buat Akun Baru
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Bergabunglah untuk mulai mengelola rental event Anda
            </p>
        </div>

        <!-- Card Register -->
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/60 border border-gray-100 p-8 sm:p-10 animate-fade-in-up animate-delay-100">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 text-sm transition-all duration-200 hover:bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none @error('name') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                            placeholder="Dannys Martha">
                    </div>
                    @error('name')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 text-sm transition-all duration-200 hover:bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none @error('email') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input id="password" name="password" type="password"
                            class="block w-full pl-11 pr-12 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 text-sm transition-all duration-200 hover:bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none @error('password') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                            placeholder="Minimal 8 karakter">
                        <!-- Toggle Password Visibility -->
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                            aria-label="Toggle password visibility">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>

                    <!-- Password Strength Indicator -->
                    <div class="mt-3">
                        <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div id="strengthBar" class="h-full w-0 rounded-full transition-all duration-300 ease-out"></div>
                        </div>
                        <p id="strengthText" class="mt-1.5 text-[11px] text-gray-400 font-medium">Kekuatan password akan ditampilkan di sini</p>
                    </div>

                    @error('password')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 text-sm transition-all duration-200 hover:bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none @error('password_confirmation') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                            placeholder="Ketik ulang password">
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 px-6 rounded-xl bg-gray-900 text-white font-semibold text-sm shadow-xl shadow-gray-900/10 hover:bg-gray-800 hover:shadow-2xl hover:-translate-y-0.5 transform transition-all duration-200 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                        Daftar Sekarang
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-100"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-4 text-gray-400">atau</span>
                    </div>
                </div>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center animate-fade-in-up animate-delay-200">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
            <p class="mt-4 text-xs text-gray-400">
                &copy; {{ date('Y') }} Rental Event. All rights reserved.
            </p>
        </div>
    </div>

    <!-- ==================== JAVASCRIPT ==================== -->
    <script>
        'use strict';

        // ==================== TOGGLE PASSWORD VISIBILITY ====================
        // Menampilkan atau menyembunyikan password saat ikon mata diklik.
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        toggleBtn.addEventListener('click', () => {
            // Toggle antara type 'password' dan 'text'
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Toggle ikon mata
            eyeIcon.classList.toggle('hidden', isPassword);
            eyeOffIcon.classList.toggle('hidden', !isPassword);
        });

        // ==================== PASSWORD STRENGTH INDICATOR ====================
        // Menampilkan indikator kekuatan password secara real-time.
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', () => {
            const password = passwordInput.value;
            let strength = 0;

            // Cek setiap kriteria dan tambahkan skor
            if (password.length >= 8) strength += 25;    // Minimal 8 karakter
            if (/[A-Z]/.test(password)) strength += 25;   // Huruf besar
            if (/[0-9]/.test(password)) strength += 25;   // Angka
            if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) strength += 25; // Simbol

            // Update lebar bar sesuai skor
            strengthBar.style.width = strength + '%';

            // Reset class lalu terapkan warna berdasarkan skor
            strengthBar.className = 'h-full rounded-full transition-all duration-300 ease-out';

            if (strength === 0) {
                // Tidak ada input — sembunyikan bar
                strengthBar.style.width = '0%';
                strengthText.textContent = 'Kekuatan password akan ditampilkan di sini';
                strengthText.className = 'mt-1.5 text-[11px] text-gray-400 font-medium';
            } else if (strength <= 25) {
                // Lemah — merah
                strengthBar.classList.add('bg-red-500');
                strengthText.textContent = 'Lemah — tambahkan huruf besar, angka, dan simbol';
                strengthText.className = 'mt-1.5 text-[11px] text-red-500 font-medium';
            } else if (strength <= 50) {
                // Cukup — orange
                strengthBar.classList.add('bg-amber-500');
                strengthText.textContent = 'Cukup — tambahkan variasi karakter';
                strengthText.className = 'mt-1.5 text-[11px] text-amber-500 font-medium';
            } else if (strength <= 75) {
                // Baik — biru
                strengthBar.classList.add('bg-blue-500');
                strengthText.textContent = 'Baik — hampir sempurna!';
                strengthText.className = 'mt-1.5 text-[11px] text-blue-500 font-medium';
            } else {
                // Kuat — hijau
                strengthBar.classList.add('bg-emerald-500');
                strengthText.textContent = 'Kuat — password Anda sangat aman!';
                strengthText.className = 'mt-1.5 text-[11px] text-emerald-500 font-medium';
            }
        });
    </script>
</body>

</html>
