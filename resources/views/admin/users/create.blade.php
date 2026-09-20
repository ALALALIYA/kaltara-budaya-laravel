<x-app-layout>
    <x-slot name="title">Tambah Guru</x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('admin.users.index') }}" class="hover:text-amber-600">Kelola Akun</a>
                <span>/</span>
                <span class="text-gray-700 font-medium">Tambah Guru</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-gray-800 dark:to-gray-800 rounded-t-2xl">
                    <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">👩‍🏫 Buat Akun Guru Baru</h1>
                    <p class="text-sm text-gray-500 mt-1">Akun guru langsung aktif dan dapat login segera.</p>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="p-8 space-y-5">

                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 py-3 px-4">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                   placeholder="guru@sekolah.sch.id"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 py-3 px-4">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Password <span class="text-red-500">*</span></label>
                            <input id="password" name="password" type="password" required
                                   placeholder="Minimal 8 karakter"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 py-3 px-4">
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   placeholder="Ulangi password"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 py-3 px-4">
                        </div>

                        <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                            💡 Sampaikan email dan password ini kepada guru yang bersangkutan. Guru dapat menggantinya di halaman Profil.
                        </div>

                    </div>

                    <div class="px-8 py-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-2xl flex gap-3">
                        <button type="submit"
                                class="px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-xl shadow text-sm transition">
                            ✅ Buat Akun Guru
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                           class="px-5 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
