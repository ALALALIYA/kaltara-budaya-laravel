<x-guest-layout>

    {{-- Judul form --}}
    <div class="mb-7">
        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Selamat Datang Kembali!</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Masuk untuk melanjutkan petualangan budayamu.</p>
    </div>

    {{-- Status sesi (misal: link reset password berhasil dikirim) --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email"
                          class="block mt-1 w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username"
                          placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Kata Sandi')" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-green-600 hover:text-green-500 dark:text-green-400 dark:hover:text-green-300 font-medium transition-colors"
                       href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>
            <x-text-input id="password"
                          class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password"
                          placeholder="Masukkan kata sandi" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Ingat saya --}}
        <div>
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 dark:border-gray-600 text-green-600 shadow-sm focus:ring-green-500 dark:bg-gray-700"
                       name="remember">
                <span class="text-sm text-gray-600 dark:text-gray-400 select-none">Ingat saya</span>
            </label>
        </div>

        {{-- Tombol masuk --}}
        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-3 text-base font-bold btn-glow">
                🚀 Masuk Sekarang
            </x-primary-button>
        </div>
    </form>

    {{-- Link ke register --}}
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}"
               class="font-bold text-green-700 hover:text-green-600 dark:text-green-400 dark:hover:text-green-300 transition-colors">
                Daftar Gratis →
            </a>
        </p>
    </div>

    {{-- Divider estetis --}}
    <div class="mt-6 flex items-center gap-3">
        <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
        <span class="text-xs text-gray-400 dark:text-gray-600 font-medium">4 SUKU · 1 PLATFORM</span>
        <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
    </div>

    <div class="mt-4 flex justify-center gap-4 text-xl" title="Dayak · Banjar · Kutai · Tidung">
        <span class="animate-float">🦅</span>
        <span class="animate-float-delay">🎋</span>
        <span class="animate-float-delay-2">🐉</span>
        <span class="animate-float-slow">🌊</span>
    </div>

</x-guest-layout>
