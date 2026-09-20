<x-app-layout>
    <x-slot name="title">Profil Saya</x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu identitas --}}
            <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-8 py-8 text-white flex items-center gap-5"
                     style="background: linear-gradient(135deg, #1a4731 0%, #7c2d12 100%);">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center text-white font-black text-2xl shadow-lg shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold">{{ auth()->user()->name }}</h1>
                        <p class="text-green-200 text-sm">{{ auth()->user()->email }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            @if(auth()->user()->isTeacherOrAdmin())
                                <span class="text-xs bg-yellow-400 text-green-900 font-extrabold px-3 py-0.5 rounded-full">👩‍🏫 Guru</span>
                            @else
                                <span class="text-xs bg-green-400 text-green-900 font-extrabold px-3 py-0.5 rounded-full">🎓 Siswa</span>
                                <span class="text-xs bg-yellow-400/30 text-yellow-200 border border-yellow-400/40 font-bold px-3 py-0.5 rounded-full">
                                    ⚡ {{ number_format(auth()->user()->xp) }} XP
                                </span>
                                @if(auth()->user()->streak > 0)
                                    <span class="text-xs bg-orange-400/30 text-orange-200 border border-orange-400/40 font-bold px-3 py-0.5 rounded-full">
                                        🔥 {{ auth()->user()->streak }} hari streak
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informasi Profil --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
                <h2 class="text-base font-extrabold text-gray-900 dark:text-white mb-1">Informasi Profil</h2>
                <p class="text-sm text-gray-500 mb-6">Perbarui nama dan alamat email akunmu.</p>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" required autofocus autocomplete="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" required autocomplete="username"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />

                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                            <p class="text-sm mt-2 text-gray-800">
                                Email belum diverifikasi.
                                <button form="send-verification" class="underline text-orange-600 hover:text-orange-800">
                                    Kirim ulang verifikasi
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">Link verifikasi sudah dikirim ke emailmu.</p>
                            @endif
                        @endif
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-bold rounded-xl shadow text-sm transition">
                            💾 Simpan Perubahan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                               x-init="setTimeout(() => show = false, 3000)"
                               class="text-sm text-green-600 font-semibold">✅ Tersimpan!</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Ubah Password --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
                <h2 class="text-base font-extrabold text-gray-900 dark:text-white mb-1">Ubah Password</h2>
                <p class="text-sm text-gray-500 mb-6">Gunakan password yang kuat dan tidak mudah ditebak.</p>

                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                               class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                        <x-input-error :messages="$errors->get('current_password')" class="mt-1" />
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Password Baru</label>
                        <input id="password" name="password" type="password" autocomplete="new-password"
                               class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                               class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-bold rounded-xl shadow text-sm transition">
                            🔒 Ganti Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                               x-init="setTimeout(() => show = false, 3000)"
                               class="text-sm text-green-600 font-semibold">✅ Password berhasil diperbarui!</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Hapus Akun --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-red-100 dark:border-red-900/40 p-6 sm:p-8">
                <h2 class="text-base font-extrabold text-red-700 dark:text-red-400 mb-1">Hapus Akun</h2>
                <p class="text-sm text-gray-500 mb-4">Setelah akun dihapus, semua data akan hilang permanen dan tidak dapat dipulihkan.</p>

                <button x-data=""
                        @click="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl text-sm transition">
                    🗑️ Hapus Akun Saya
                </button>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf @method('delete')
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Yakin ingin menghapus akun?</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Semua data, nilai, dan progress belajarmu akan terhapus permanen.
                        </p>
                        <div class="mt-4">
                            <label for="delete_password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Masukkan password untuk konfirmasi</label>
                            <input id="delete_password" name="password" type="password" placeholder="Password"
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-2.5 px-4">
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
                        </div>
                        <div class="mt-5 flex gap-3">
                            <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl text-sm">Hapus Akun</button>
                            <button type="button" x-on:click="$dispatch('close')"
                                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm">Batal</button>
                        </div>
                    </form>
                </x-modal>
            </div>

        </div>
    </div>
</x-app-layout>
