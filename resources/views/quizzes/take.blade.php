<x-app-layout>
    <x-slot name="title">{{ $quiz->title }}</x-slot>

    @php
        $questionsData = [];
        foreach ($questions as $q) {
            $questionsData[$q->id] = [
                'correct'     => $q->correct_answer,
                'explanation' => $q->explanation ?? '',
            ];
        }
    @endphp

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8"
             x-data='{
                 current: 0,
                 total: {{ $questions->count() }},
                 feedback: {},
                 questionsData: @json($questionsData),

                 progress() { return ((this.current + 1) / this.total) * 100; },

                 selectAnswer(qId, value) {
                     const qd = this.questionsData[qId];
                     this.feedback[qId] = {
                         selected:    value,
                         correct:     qd.correct,
                         isCorrect:   value === qd.correct,
                         explanation: qd.explanation,
                     };
                 }
             }'>

            <!-- Header Quiz -->
            <div class="bg-green-900 rounded-2xl p-6 mb-6 text-white">
                <p class="text-green-300 text-sm mb-1">Kamu sedang mengerjakan:</p>
                <h1 class="text-xl sm:text-2xl font-extrabold">{{ $quiz->title }}</h1>
                @if($quiz->description)
                    <p class="text-green-200 text-sm mt-1">{{ $quiz->description }}</p>
                @endif
                <div class="mt-4 flex items-center gap-3 text-sm">
                    <span class="text-green-300">📝 {{ $questions->count() }} soal</span>
                    <span class="text-green-600">·</span>
                    <span class="text-green-300">⚡ Setiap jawaban benar = +5 XP</span>
                </div>

                <!-- Progress Bar -->
                <div class="mt-4">
                    <div class="flex justify-between text-xs text-green-300 mb-1">
                        <span x-text="`Soal ${current + 1} dari ${total}`"></span>
                        <span x-text="`${Math.round(progress())}%`"></span>
                    </div>
                    <div class="h-2 bg-green-800 rounded-full overflow-hidden">
                        <div class="h-full bg-yellow-400 rounded-full transition-all duration-300"
                             :style="`width: ${progress()}%`"></div>
                    </div>
                </div>
            </div>

            <!-- Form Quiz -->
            <form method="POST" action="{{ route('quizzes.submit', $quiz->id) }}"
                  id="quiz-form"
                  x-on:submit="return validateQuiz()">
                @csrf

                <div class="space-y-6">
                    @foreach($questions as $i => $question)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
                             id="question-{{ $i }}"
                             x-show="current === {{ $i }}"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-x-4"
                             x-transition:enter-end="opacity-100 translate-x-0">

                            <!-- Nomor Soal -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700 px-5 py-3 flex items-center gap-2">
                                <span class="bg-green-700 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center">
                                    {{ $i + 1 }}
                                </span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">
                                    {{ $question->type === 'true_false' ? 'Benar atau Salah' : 'Pilihan Ganda' }}
                                </span>
                            </div>

                            <div class="p-5 sm:p-6">
                                <p class="text-gray-900 dark:text-white font-semibold text-base sm:text-lg leading-relaxed mb-5">
                                    {{ $question->question }}
                                </p>

                                <div class="space-y-3">
                                    @foreach($question->options as $option)
                                        <label
                                            :class="{
                                                'border-green-500 bg-green-50 dark:bg-green-900/30': feedback['{{ $question->id }}'] && '{{ addslashes($option) }}' === feedback['{{ $question->id }}'].correct,
                                                'border-red-400 bg-red-50 dark:bg-red-900/20': feedback['{{ $question->id }}'] && '{{ addslashes($option) }}' === feedback['{{ $question->id }}'].selected && !feedback['{{ $question->id }}'].isCorrect,
                                                'border-gray-200 dark:border-gray-600 hover:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20': !feedback['{{ $question->id }}'] || ('{{ addslashes($option) }}' !== feedback['{{ $question->id }}'].correct && '{{ addslashes($option) }}' !== feedback['{{ $question->id }}'].selected)
                                            }"
                                            class="flex items-start gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all group">
                                            <input type="radio"
                                                   name="answers[{{ $question->id }}]"
                                                   value="{{ $option }}"
                                                   class="mt-0.5 shrink-0 accent-green-600"
                                                   :disabled="!!feedback['{{ $question->id }}']"
                                                   x-on:change="selectAnswer('{{ $question->id }}', '{{ addslashes($option) }}')">
                                            <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                {{-- Immediate Feedback Panel --}}
                                <template x-if="feedback['{{ $question->id }}']">
                                    <div class="mt-4 rounded-xl p-4 border-2"
                                         :class="feedback['{{ $question->id }}'].isCorrect
                                             ? 'bg-green-50 dark:bg-green-900/20 border-green-400 dark:border-green-600'
                                             : 'bg-red-50 dark:bg-red-900/20 border-red-400 dark:border-red-600'">
                                        <div class="flex items-start gap-3">
                                            <span class="text-xl shrink-0"
                                                  x-text="feedback['{{ $question->id }}'].isCorrect ? '✅' : '❌'"></span>
                                            <div class="flex-1">
                                                <p class="font-bold text-sm"
                                                   :class="feedback['{{ $question->id }}'].isCorrect ? 'text-green-700 dark:text-green-400' : 'text-red-600 dark:text-red-400'"
                                                   x-text="feedback['{{ $question->id }}'].isCorrect ? 'Jawaban Benar! +5 XP' : 'Jawaban Salah'"></p>
                                                <template x-if="!feedback['{{ $question->id }}'].isCorrect">
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                                        Jawaban benar: <strong class="text-green-700 dark:text-green-400" x-text="feedback['{{ $question->id }}'].correct"></strong>
                                                    </p>
                                                </template>
                                                <template x-if="feedback['{{ $question->id }}'].explanation">
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 italic"
                                                       x-text="'💡 ' + feedback['{{ $question->id }}'].explanation"></p>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- Navigasi -->
                                <div class="flex justify-between mt-6 pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <button type="button"
                                            @click="if (current > 0) current--"
                                            x-show="current > 0"
                                            class="flex items-center gap-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white font-medium text-sm transition">
                                        ← Soal Sebelumnya
                                    </button>
                                    <div x-show="current === 0"></div>

                                    @if($i < $questions->count() - 1)
                                        <button type="button"
                                                @click="current++"
                                                class="flex items-center gap-2 bg-green-700 hover:bg-green-600 text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
                                            Soal Berikutnya →
                                        </button>
                                    @else
                                        <button type="submit"
                                                class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-green-900 font-bold text-sm px-6 py-2.5 rounded-lg shadow-md transition">
                                            🎯 Kumpulkan Jawaban
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Daftar semua soal (navigasi cepat) -->
                <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-3">Navigasi Soal:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($questions as $i => $q)
                            <button type="button"
                                    @click="current = {{ $i }}"
                                    :class="current === {{ $i }}
                                        ? 'bg-green-700 text-white'
                                        : (feedback['{{ $q->id }}']
                                            ? (feedback['{{ $q->id }}'].isCorrect ? 'bg-green-500 text-white' : 'bg-red-400 text-white')
                                            : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600')"
                                    class="w-9 h-9 rounded-lg font-bold text-sm transition">
                                {{ $i + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        function validateQuiz() {
            const form   = document.getElementById('quiz-form');
            const radios = form.querySelectorAll('input[type="radio"]');
            const names  = new Set([...radios].map(r => r.name));
            let unanswered = false;
            names.forEach(name => {
                if (!form.querySelector(`input[name="${name}"]:checked`)) unanswered = true;
            });
            if (unanswered) {
                return confirm('Masih ada soal yang belum dijawab. Lanjutkan mengumpulkan?');
            }
            return true;
        }
    </script>
</x-app-layout>
