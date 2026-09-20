<x-app-layout>
    <x-slot name="title">Buat Quiz / Ujian Baru</x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
                <a href="{{ route('teacher.quizzes.index') }}" class="hover:text-orange-500 transition-colors">Quiz Saya</a>
                <span>/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Buat Baru</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 rounded-t-2xl">
                    <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">➕ Buat Quiz / Ujian Baru</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Isi info dasar terlebih dahulu, soal bisa ditambah setelah disimpan.</p>
                </div>

                <form method="POST" action="{{ route('teacher.quizzes.store') }}"
                      x-data="{ quizType: '{{ old('quiz_type', 'standalone') }}' }">
                    @csrf

                    <div class="p-8 space-y-6">

                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Judul Quiz <span class="text-red-500">*</span>
                            </label>
                            <input id="title" name="title" type="text" required
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Pretest Budaya Dayak Kalimantan"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4">
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        <!-- Jenis Quiz -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                                Jenis Quiz <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach([
                                    ['value' => 'pretest',      'label' => 'Pretest',      'icon' => '📋', 'desc' => 'Sebelum membaca materi', 'color' => 'blue'],
                                    ['value' => 'posttest',     'label' => 'Posttest',     'icon' => '✅', 'desc' => 'Setelah membaca materi', 'color' => 'purple'],
                                    ['value' => 'standalone',   'label' => 'Latihan Soal', 'icon' => '📝', 'desc' => 'Quiz latihan bebas',      'color' => 'gray'],
                                    ['value' => 'ujian_harian', 'label' => 'Ujian Harian', 'icon' => '📅', 'desc' => 'Ujian per topik harian',  'color' => 'green'],
                                    ['value' => 'uts',          'label' => 'UTS',          'icon' => '🎓', 'desc' => 'Ujian Tengah Semester',   'color' => 'orange'],
                                    ['value' => 'uas',          'label' => 'UAS',          'icon' => '🏆', 'desc' => 'Ujian Akhir Semester',    'color' => 'red'],
                                ] as $type)
                                    <label class="relative cursor-pointer"
                                           @click="quizType = '{{ $type['value'] }}'">
                                        <input type="radio" name="quiz_type" value="{{ $type['value'] }}"
                                               {{ old('quiz_type', 'standalone') === $type['value'] ? 'checked' : '' }}
                                               class="sr-only peer"
                                               x-model="quizType">
                                        <div class="border-2 rounded-xl p-3 text-center transition-all
                                                    peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20
                                                    border-gray-200 dark:border-gray-600 hover:border-purple-300">
                                            <div class="text-2xl mb-1">{{ $type['icon'] }}</div>
                                            <div class="font-bold text-sm text-gray-900 dark:text-white">{{ $type['label'] }}</div>
                                            <div class="text-xs text-gray-400 mt-0.5">{{ $type['desc'] }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('quiz_type')" class="mt-1" />
                        </div>

                        <!-- Materi Terkait (show for pretest/posttest/standalone) -->
                        <div x-show="['pretest','posttest','standalone'].includes(quizType)"
                             x-data="{ materialId: '{{ old('material_id', '') }}' }">
                            <label for="material_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Kaitkan dengan Materi
                                <span class="text-red-500 ml-1"
                                      x-show="['pretest','posttest'].includes(quizType)">* (wajib)</span>
                                <span class="text-gray-400 text-xs font-normal ml-1"
                                      x-show="quizType === 'standalone'">(opsional)</span>
                            </label>
                            <select id="material_id" name="material_id"
                                    x-model="materialId"
                                    :class="['pretest','posttest'].includes(quizType) && !materialId
                                        ? 'border-red-400 ring-1 ring-red-400'
                                        : 'border-gray-300 dark:border-gray-600'"
                                    class="block w-full rounded-xl dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3">
                                <option value="">— Pilih Materi —</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                        {{ $material->category_icon }} {{ $material->title }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Warning when pretest/posttest with no material selected --}}
                            <div x-show="['pretest','posttest'].includes(quizType) && !materialId"
                                 class="mt-2 flex items-center gap-2 text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg px-3 py-2">
                                <span>⚠️</span>
                                <span>Pretest dan Posttest <strong>wajib</strong> dikaitkan dengan materi agar siswa bisa mengaksesnya dari halaman materi.</span>
                            </div>

                            <x-input-error :messages="$errors->get('material_id')" class="mt-1" />
                        </div>

                        <!-- Row: Passing Score + Time Limit -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="passing_score" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Nilai Kelulusan (%) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="passing_score" name="passing_score" type="number"
                                           value="{{ old('passing_score', 70) }}"
                                           min="1" max="100" required
                                           class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 pr-10">
                                    <span class="absolute right-3 top-3.5 text-gray-400 font-bold">%</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Untuk posttest: skor minimum untuk lulus materi</p>
                                <x-input-error :messages="$errors->get('passing_score')" class="mt-1" />
                            </div>
                            <div>
                                <label for="time_limit" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Batas Waktu <span class="text-gray-400 text-xs font-normal">(opsional)</span>
                                </label>
                                <div class="relative">
                                    <input id="time_limit" name="time_limit" type="number"
                                           value="{{ old('time_limit') }}"
                                           min="1" max="300"
                                           placeholder="Kosongkan = tanpa batas"
                                           class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 pr-16">
                                    <span class="absolute right-3 top-3.5 text-gray-400 text-sm">menit</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Countdown timer aktif saat ujian berlangsung</p>
                                <x-input-error :messages="$errors->get('time_limit')" class="mt-1" />
                            </div>
                        </div>

                        <!-- Min Ujian Harian (for UTS/UAS) -->
                        <div x-show="['uts','uas'].includes(quizType)">
                            <label for="min_harian_required" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Minimal Ujian Harian Lulus <span class="text-red-500">*</span>
                            </label>
                            <input id="min_harian_required" name="min_harian_required" type="number"
                                   value="{{ old('min_harian_required', 0) }}"
                                   min="0" max="50"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4">
                            <p class="text-xs text-gray-400 mt-1">Siswa harus lulus minimal N ujian harian sebelum bisa akses ini. Set 0 = bebas akses.</p>
                            <x-input-error :messages="$errors->get('min_harian_required')" class="mt-1" />
                        </div>
                        <!-- Hidden default for non-UTS/UAS -->
                        <div x-show="!['uts','uas'].includes(quizType)">
                            <input type="hidden" name="min_harian_required" value="0">
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi <span class="text-gray-400 text-xs font-normal">(opsional)</span>
                            </label>
                            <textarea id="description" name="description" rows="3"
                                      placeholder="Petunjuk pengerjaan atau deskripsi singkat quiz ini..."
                                      class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                    </div>

                    <div class="px-8 py-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-2xl flex gap-3">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl shadow-md transition text-sm">
                            Simpan &amp; Tambah Soal →
                        </button>
                        <a href="{{ route('teacher.quizzes.index') }}"
                           class="inline-flex items-center px-5 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
