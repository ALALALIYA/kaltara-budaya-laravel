<x-app-layout>
    <x-slot name="title">Edit Quiz</x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
                <a href="{{ route('teacher.quizzes.index') }}" class="hover:text-purple-500">Quiz Saya</a>
                <span>/</span>
                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="hover:text-purple-500 truncate max-w-[160px]">{{ $quiz->title }}</a>
                <span>/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Edit</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 rounded-t-2xl">
                    <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">✏️ Edit Quiz</h1>
                </div>

                <form method="POST" action="{{ route('teacher.quizzes.update', $quiz->id) }}"
                      x-data="{ quizType: '{{ old('quiz_type', $quiz->quiz_type) }}' }">
                    @csrf
                    @method('PATCH')

                    <div class="p-8 space-y-6">

                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Quiz *</label>
                            <input id="title" name="title" type="text" required value="{{ old('title', $quiz->title) }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4">
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        <!-- Jenis Quiz -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Jenis Quiz *</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach([
                                    ['value' => 'pretest',      'label' => 'Pretest',      'icon' => '📋'],
                                    ['value' => 'posttest',     'label' => 'Posttest',     'icon' => '✅'],
                                    ['value' => 'standalone',   'label' => 'Latihan Soal', 'icon' => '📝'],
                                    ['value' => 'ujian_harian', 'label' => 'Ujian Harian', 'icon' => '📅'],
                                    ['value' => 'uts',          'label' => 'UTS',          'icon' => '🎓'],
                                    ['value' => 'uas',          'label' => 'UAS',          'icon' => '🏆'],
                                ] as $type)
                                    <label class="relative cursor-pointer" @click="quizType = '{{ $type['value'] }}'">
                                        <input type="radio" name="quiz_type" value="{{ $type['value'] }}"
                                               {{ old('quiz_type', $quiz->quiz_type) === $type['value'] ? 'checked' : '' }}
                                               class="sr-only peer" x-model="quizType">
                                        <div class="border-2 rounded-xl p-3 text-center transition-all peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20 border-gray-200 dark:border-gray-600 hover:border-purple-300">
                                            <div class="text-2xl mb-1">{{ $type['icon'] }}</div>
                                            <div class="font-bold text-sm text-gray-900 dark:text-white">{{ $type['label'] }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Materi Terkait -->
                        <div x-show="['pretest','posttest','standalone'].includes(quizType)">
                            <label for="material_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kaitkan dengan Materi</label>
                            <select id="material_id" name="material_id"
                                    class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3">
                                <option value="">— Tidak dikaitkan —</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ old('material_id', $quiz->material_id) == $material->id ? 'selected' : '' }}>
                                        {{ $material->category_icon }} {{ $material->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Passing Score + Time Limit -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="passing_score" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nilai Kelulusan (%) *</label>
                                <input id="passing_score" name="passing_score" type="number" min="1" max="100" required
                                       value="{{ old('passing_score', $quiz->passing_score) }}"
                                       class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4">
                            </div>
                            <div>
                                <label for="time_limit" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Batas Waktu (menit)</label>
                                <input id="time_limit" name="time_limit" type="number" min="1" max="300"
                                       value="{{ old('time_limit', $quiz->time_limit) }}"
                                       placeholder="Kosongkan = tanpa batas"
                                       class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4">
                            </div>
                        </div>

                        <!-- Min Harian (for UTS/UAS) -->
                        <div x-show="['uts','uas'].includes(quizType)">
                            <label for="min_harian_required" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Minimal Ujian Harian/UTS Lulus *</label>
                            <input id="min_harian_required" name="min_harian_required" type="number" min="0" max="50"
                                   value="{{ old('min_harian_required', $quiz->min_harian_required) }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4">
                        </div>
                        <div x-show="!['uts','uas'].includes(quizType)">
                            <input type="hidden" name="min_harian_required" value="0">
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Deskripsi (opsional)</label>
                            <textarea id="description" name="description" rows="3"
                                      class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('description', $quiz->description) }}</textarea>
                        </div>
                    </div>

                    <div class="px-8 py-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-2xl flex gap-3">
                        <button type="submit"
                                class="px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl shadow-md transition text-sm">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('teacher.quizzes.show', $quiz->id) }}"
                           class="px-5 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
