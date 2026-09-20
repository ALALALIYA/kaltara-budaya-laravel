<x-app-layout>
    <x-slot name="title">Kelola Soal — {{ $quiz->title }}</x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <a href="{{ route('teacher.quizzes.index') }}" class="hover:text-green-600 transition-colors">Quiz Saya</a>
                <span>/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium truncate">{{ $quiz->title }}</span>
            </nav>

            <!-- Header Quiz -->
            <div class="bg-green-900 rounded-2xl p-6 text-white">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div>
                        <p class="text-green-300 text-xs font-semibold uppercase tracking-wide mb-1">Quiz</p>
                        <h1 class="text-xl sm:text-2xl font-extrabold">{{ $quiz->title }}</h1>
                        @if($quiz->description)
                            <p class="text-green-200 text-sm mt-1">{{ $quiz->description }}</p>
                        @endif
                        <div class="flex flex-wrap gap-4 mt-3 text-sm">
                            <span class="text-green-300">📝 {{ $quiz->questions->count() }} soal</span>
                            @if($quiz->material)
                                <span class="text-green-300">📖 {{ $quiz->material->title }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}"
                           class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold text-sm px-4 py-2 rounded-xl transition">
                            ✏️ Edit Info
                        </a>
                        <form method="POST" action="{{ route('teacher.quizzes.destroy', $quiz->id) }}"
                              onsubmit="return confirm('Hapus quiz ini beserta semua soalnya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600/80 hover:bg-red-600 border border-red-500/40 text-white font-semibold text-sm px-4 py-2 rounded-xl transition">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Soal -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg">📋 Daftar Soal</h2>
                    <span class="text-sm text-gray-400">{{ $quiz->questions->count() }} soal</span>
                </div>

                @if($quiz->questions->isEmpty())
                    <div class="text-center py-12 text-gray-400">
                        <p class="text-5xl mb-3">📝</p>
                        <p class="font-medium">Belum ada soal. Tambah soal pertama di bawah!</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($quiz->questions as $i => $question)
                            <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-start gap-4">
                                    <span class="shrink-0 w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center text-sm font-extrabold mt-0.5">
                                        {{ $i + 1 }}
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white leading-relaxed">
                                            {{ $question->question }}
                                        </p>
                                        <div class="mt-2 flex flex-wrap gap-2">
                                            <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-0.5 rounded-full">
                                                {{ $question->type === 'true_false' ? 'Benar/Salah' : 'Pilihan Ganda' }}
                                            </span>
                                            @foreach($question->options as $opt)
                                                <span class="text-xs px-2 py-0.5 rounded-full
                                                    {{ $opt === $question->correct_answer
                                                        ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400 font-bold'
                                                        : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400' }}">
                                                    {{ $opt === $question->correct_answer ? '✓ ' : '' }}{{ $opt }}
                                                </span>
                                            @endforeach
                                        </div>
                                        @if($question->explanation)
                                            <p class="mt-2 text-xs text-blue-700 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg px-3 py-1.5">
                                                💡 <strong>Penjelasan:</strong> {{ $question->explanation }}
                                            </p>
                                        @endif
                                    </div>
                                    <form method="POST"
                                          action="{{ route('teacher.quizzes.questions.destroy', [$quiz->id, $question->id]) }}"
                                          onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="shrink-0 text-red-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 p-1.5 rounded-lg transition text-xs font-bold">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Form Tambah Soal -->
            <div x-data="{
                    open:    {{ $errors->any() ? 'true' : 'false' }},
                    type:    '{{ old('type', 'multiple_choice') }}',
                    options: {{ json_encode(old('options', ['', '', '', ''])) }},
                    correct: '{{ old('correct_answer', '') }}',

                    setType(t) {
                        this.type    = t;
                        this.correct = '';
                        this.options = t === 'true_false' ? ['Benar', 'Salah'] : ['', '', '', ''];
                    }
                }"
                 class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                 
                <!-- Toggle -->
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <span class="font-bold text-gray-900 dark:text-white text-lg">➕ Tambah Soal Baru</span>
                    <svg :class="open ? 'rotate-180' : ''" class="h-5 w-5 text-gray-400 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="border-t border-gray-100 dark:border-gray-700">

                    <form method="POST" action="{{ route('teacher.quizzes.questions.store', $quiz->id) }}"
                          class="p-5 sm:p-6 space-y-5">
                        @csrf

                        <!-- Teks Soal -->
                        <div>
                            <x-input-label for="question" value="Teks Soal *" />
                            <textarea id="question" name="question" rows="3" required
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500"
                                      placeholder="Tuliskan pertanyaannya di sini...">{{ old('question') }}</textarea>
                            <x-input-error :messages="$errors->get('question')" class="mt-1" />
                        </div>

                        <!-- Tipe Soal -->
                        <div>
                            <x-input-label value="Tipe Soal *" />
                            <div class="mt-2 flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" value="multiple_choice"
                                           x-model="type" @change="setType('multiple_choice')"
                                           class="accent-green-600">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilihan Ganda (4 opsi)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" value="true_false"
                                           x-model="type" @change="setType('true_false')"
                                           class="accent-green-600">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Benar / Salah</span>
                                </label>
                            </div>
                            <input type="hidden" name="type" :value="type">
                        </div>

                        <!-- ── PILIHAN GANDA ── -->
                        <template x-if="type === 'multiple_choice'">
                            <div class="space-y-3">
                                <x-input-label value="Opsi Jawaban * (isi semua 4 opsi)" />
                                <template x-for="(opt, idx) in options" :key="idx">
                                    <div class="flex items-center gap-3">
                                        <span class="shrink-0 w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-sm font-bold text-gray-500 dark:text-gray-400"
                                              x-text="String.fromCharCode(65 + idx)"></span>
                                        <input type="text" name="options[]"
                                               x-model="options[idx]"
                                               :placeholder="'Opsi ' + String.fromCharCode(65 + idx)"
                                               class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                                               required>
                                    </div>
                                </template>

                                <div class="pt-2">
                                    <x-input-label for="correct_mc" value="Jawaban yang Benar *" />
                                    <select id="correct_mc" name="correct_answer" required
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                                            x-model="correct">
                                        <option value="">-- Pilih jawaban yang benar --</option>
                                        <template x-for="(opt, idx) in options" :key="idx">
                                            <option :value="opt"
                                                    x-text="opt ? opt : '(Opsi ' + String.fromCharCode(65+idx) + ' — belum diisi)'">
                                            </option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </template>

                        <!-- ── BENAR / SALAH ── -->
                        <template x-if="type === 'true_false'">
                            <div>
                                <input type="hidden" name="options[]" value="Benar">
                                <input type="hidden" name="options[]" value="Salah">
                                <x-input-label value="Jawaban yang Benar *" />
                                <div class="mt-2 flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="correct_answer" value="Benar"
                                               x-model="correct" class="accent-green-600" required>
                                        <span class="text-sm font-semibold text-green-700 dark:text-green-400">✓ Benar</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="correct_answer" value="Salah"
                                               x-model="correct" class="accent-red-500">
                                        <span class="text-sm font-semibold text-red-600 dark:text-red-400">✗ Salah</span>
                                    </label>
                                </div>
                            </div>
                        </template>

                        <x-input-error :messages="$errors->get('options')" class="mt-1" />
                        <x-input-error :messages="$errors->get('options.*')" class="mt-1" />
                        <x-input-error :messages="$errors->get('correct_answer')" class="mt-1" />

                        <!-- Penjelasan Jawaban -->
                        <div>
                            <x-input-label for="explanation" value="Penjelasan Jawaban (Opsional)" />
                            <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">Ditampilkan ke siswa sebagai umpan balik setelah menjawab. Jelaskan mengapa jawaban tersebut benar.</p>
                            <textarea id="explanation" name="explanation" rows="2"
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                                      placeholder="Contoh: Tari Hudoq merupakan ritual adat Suku Dayak yang dilakukan untuk memohon kesuburan...">{{ old('explanation') }}</textarea>
                            <x-input-error :messages="$errors->get('explanation')" class="mt-1" />
                        </div>

                        <div class="flex gap-3 pt-2 border-t border-gray-100 dark:border-gray-700">
                            <x-primary-button>
                                + Tambah Soal
                            </x-primary-button>
                            <button type="button" @click="open = false"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-md text-sm transition">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
