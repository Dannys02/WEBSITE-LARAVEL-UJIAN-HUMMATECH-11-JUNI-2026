@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('page_title', 'Pengaturan Akun')

@section('content')

<div class="w-full mx-auto p-4 md:p-0">
    <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 mb-8 shadow-sm">
        <h3 class="text-xl font-semibold mb-6 text-gray-900 flex items-center gap-2 before:content-[''] before:inline-block before:w-1 before:h-6 before:bg-gradient-to-b before:from-cyan-500 before:to-blue-600 before:rounded-sm">
            Profil Saya
        </h3>

        <form action="{{ route('settings.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-start mb-8 pb-8 border-b border-gray-200">
                <div class="flex-shrink-0 text-center mx-auto md:mx-0">
                    <div class="w-[120px] h-[120px] rounded-xl border-2 border-gray-200 mb-4 bg-gray-100 flex items-center justify-center text-[3rem] overflow-hidden" id="previewImg">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-600 font-medium">{{collect(explode(' ', Auth::user()->name))->map(fn($w) => $w[0])->join('')}}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 m-0">
                        @if (Auth::user()->image)
                            <strong class="text-gray-700">{{ Auth::user()->name }}</strong>
                        @else
                            Belum ada foto
                        @endif
                    </p>
                </div>

                <div class="flex-1 w-full">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 cursor-pointer transition-all duration-200 ease-in-out hover:border-cyan-500 hover:bg-cyan-50/40" id="uploadArea">
                        <div class="text-[2rem] mb-2">📸</div>
                        <p class="text-sm text-cyan-500 font-medium my-1">Drag dan drop foto Anda di sini</p>
                        <p class="text-sm text-gray-500 my-1">atau</p>
                        <p class="text-sm text-cyan-500 font-medium my-1">Klik untuk memilih file</p>
                        <p class="text-[12px] text-gray-500 mt-3">
                            Format: JPEG, PNG, JPG, WebP | Maksimal: 2MB
                        </p>
                    </div>
                    <input type="file"
                           id="profilePictureInput"
                           name="image"
                           class="hidden"
                           accept="image/jpeg,image/png,image/webp">
                    @error('image')
                        <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-6 last:mb-0">
                    <label for="name" class="block text-xs font-medium text-gray-700 mb-2 uppercase tracking-wider">Nama (Username)</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="w-full px-4 py-3 border rounded-lg text-[0.95rem] text-gray-900 transition-all duration-200 ease-in-out bg-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:bg-cyan-50/50 focus:ring-3 focus:ring-cyan-500/10 @error('name') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                           value="{{ old('name', Auth::user()->name) }}"
                           placeholder="Masukkan nama Anda">
                    @error('name')
                        <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 last:mb-0">
                    <label for="email" class="block text-xs font-medium text-gray-700 mb-2 uppercase tracking-wider">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="w-full px-4 py-3 border rounded-lg text-[0.95rem] text-gray-900 transition-all duration-200 ease-in-out bg-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:bg-cyan-50/50 focus:ring-3 focus:ring-cyan-500/10 @error('email') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                           value="{{ old('email', Auth::user()->email) }}"
                           placeholder="dannys@email.com">
                    @error('email')
                        <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-6 last:mb-0">
                <label for="phone" class="block text-xs font-medium text-gray-700 mb-2 uppercase tracking-wider">Nomor HP (untuk WhatsApp)</label>
                <input type="tel"
                       id="phone"
                       name="phone"
                       class="w-full px-4 py-3 border rounded-lg text-[0.95rem] text-gray-900 transition-all duration-200 ease-in-out bg-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:bg-cyan-50/50 focus:ring-3 focus:ring-cyan-500/10 @error('phone') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                       value="{{ old('phone', Auth::user()->phone) }}"
                       placeholder="Contoh: 6285644882298">
                <small class="text-gray-500 block mt-1.5">
                    💡 Untuk nomor Indonesia, mulai dengan 62 (tanpa 0)
                </small>
                @error('phone')
                    <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-8 border-t border-gray-200">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-lg text-[0.95rem] font-medium cursor-pointer transition-all duration-200 ease-in-out capitalize bg-cyan-500 text-white hover:bg-cyan-600 hover:shadow-md hover:shadow-cyan-500/20 active:scale-[0.98]">💾 Simpan Perubahan</button>
                <button type="reset" class="w-full sm:w-auto px-6 py-3 rounded-lg text-[0.95rem] font-medium cursor-pointer transition-all duration-200 ease-in-out capitalize bg-gray-200 text-gray-700 hover:bg-gray-300">🔄 Reset</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 mb-8 shadow-sm">
        <h3 class="text-xl font-semibold mb-6 text-gray-900 flex items-center gap-2 before:content-[''] before:inline-block before:w-1 before:h-6 before:bg-gradient-to-b before:from-cyan-500 before:to-blue-600 before:rounded-sm">
            Ubah Password
        </h3>

        <form action="{{ route('settings.update-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6 last:mb-0">
                <label for="current_password" class="block text-xs font-medium text-gray-700 mb-2 uppercase tracking-wider">Password Saat Ini</label>
                <input type="password"
                       id="current_password"
                       name="current_password"
                       class="w-full px-4 py-3 border rounded-lg text-[0.95rem] text-gray-900 transition-all duration-200 ease-in-out bg-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:bg-cyan-50/50 focus:ring-3 focus:ring-cyan-500/10 @error('current_password') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                       placeholder="Masukkan password saat ini">
                @error('current_password')
                    <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6 last:mb-0">
                <label for="password" class="block text-xs font-medium text-gray-700 mb-2 uppercase tracking-wider">Password Baru</label>
                <input type="password"
                       id="password"
                       name="password"
                       class="w-full px-4 py-3 border rounded-lg text-[0.95rem] text-gray-900 transition-all duration-200 ease-in-out bg-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:bg-cyan-50/50 focus:ring-3 focus:ring-cyan-500/10 @error('password') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                       placeholder="Masukkan password baru (minimal 8 karakter)"
                       autocomplete="new-password">
                <div class="mt-2 h-1 bg-gray-200 rounded-sm overflow-hidden">
                    <div class="h-full w-0 transition-all duration-300 ease-in-out" id="passwordStrengthBar"></div>
                </div>
                <ul class="mt-4 text-[13px] text-gray-500 space-y-1 plan-list">
                    <li id="reqLength" class="relative pl-6 before:content-['○'] before:absolute before:left-0 before:text-gray-300 [&.met]:text-emerald-500 [&.met]:before:content-['✓'] [&.met]:before:text-emerald-500">Minimal 8 karakter</li>
                    <li id="reqUppercase" class="relative pl-6 before:content-['○'] before:absolute before:left-0 before:text-gray-300 [&.met]:text-emerald-500 [&.met]:before:content-['✓'] [&.met]:before:text-emerald-500">Mengandung huruf besar (A-Z)</li>
                    <li id="reqNumber" class="relative pl-6 before:content-['○'] before:absolute before:left-0 before:text-gray-300 [&.met]:text-emerald-500 [&.met]:before:content-['✓'] [&.met]:before:text-emerald-500">Mengandung angka (0-9)</li>
                    <li id="reqSpecial" class="relative pl-6 before:content-['○'] before:absolute before:left-0 before:text-gray-300 [&.met]:text-emerald-500 [&.met]:before:content-['✓'] [&.met]:before:text-emerald-500">Mengandung simbol (!@#$%^&*)</li>
                </ul>
                @error('password')
                    <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6 last:mb-0">
                <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-2 uppercase tracking-wider">Konfirmasi Password Baru</label>
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="w-full px-4 py-3 border rounded-lg text-[0.95rem] text-gray-900 transition-all duration-200 ease-in-out bg-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:bg-cyan-50/50 focus:ring-3 focus:ring-cyan-500/10 @error('password_confirmation') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                       placeholder="Ketik ulang password baru Anda"
                       autocomplete="new-password">
                @error('password_confirmation')
                    <div class="text-red-600 text-[13px] mt-1.5 flex items-center gap-1.5 before:content-['⚠'] before:inline-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-8 border-t border-gray-200">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-lg text-[0.95rem] font-medium cursor-pointer transition-all duration-200 ease-in-out capitalize bg-cyan-500 text-white hover:bg-cyan-600 hover:shadow-md hover:shadow-cyan-500/20 active:scale-[0.98]">🔐 Ubah Password</button>
                <button type="reset" class="w-full sm:w-auto px-6 py-3 rounded-lg text-[0.95rem] font-medium cursor-pointer transition-all duration-200 ease-in-out capitalize bg-gray-200 text-gray-700 hover:bg-gray-300">🔄 Reset</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ==================== PROFILE PICTURE UPLOAD ====================
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('profilePictureInput');
    const previewImg = document.getElementById('previewImg');

    uploadArea.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('!border-cyan-500', '!bg-cyan-50');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('!border-cyan-500', '!bg-cyan-50');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('!border-cyan-500', '!bg-cyan-50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
                uploadArea.style.borderColor = '#10b981';
                uploadArea.style.backgroundColor = '#ecfdf5';
            };
            reader.readAsDataURL(file);
        } else {
            alert('Hanya file gambar yang diizinkan!');
            fileInput.value = '';
        }
    }

    // ==================== PASSWORD STRENGTH CHECKER ====================
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const reqLength = document.getElementById('reqLength');
    const reqUppercase = document.getElementById('reqUppercase');
    const reqNumber = document.getElementById('reqNumber');
    const reqSpecial = document.getElementById('reqSpecial');

    passwordInput.addEventListener('input', checkPasswordStrength);

    function checkPasswordStrength() {
        const password = passwordInput.value;
        let strength = 0;

        // Check requirements
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);

        // Update requirement indicators
        updateRequirement(reqLength, hasLength);
        updateRequirement(reqUppercase, hasUppercase);
        updateRequirement(reqNumber, hasNumber);
        updateRequirement(reqSpecial, hasSpecial);

        // Calculate strength
        if (hasLength) strength += 25;
        if (hasUppercase) strength += 25;
        if (hasNumber) strength += 25;
        if (hasSpecial) strength += 25;

        // Update strength bar
        strengthBar.style.width = strength + '%';

        // Reset dynamic classes
        strengthBar.className = 'h-full transition-all duration-300 ease-in-out';

        if (strength <= 25) {
            strengthBar.classList.add('w-1/3', 'bg-red-500');
        } else if (strength <= 75) {
            strengthBar.classList.add('w-2/3', 'bg-amber-500');
        } else {
            strengthBar.classList.add('w-full', 'bg-emerald-500');
        }
    }

    function updateRequirement(element, met) {
        if (met) {
            element.classList.add('met');
        } else {
            element.classList.remove('met');
        }
    }
</script>

@endsection
