<x-app-layout>
    <x-slot name="title">Posttest — {{ $material->title }}</x-slot>

    @php
        $questionsData = [];
        foreach ($questions as $q) {
            $questionsData[$q->id] = [
                'correct'     => $q->correct_answer,
                'explanation' => $q->explanation ?? '',
            ];
        }
    @endphp

    <div class="min-h-screen py-8" style="background: linear-gradient(135deg, #4c1d95 0%, #1e3a8a 50%, #064e3b 100%);">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                    ✅ POSTTEST · {{ $material->title }}
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">
                    @if($attemptCount > 0) Coba Lagi! Kamu Bisa! 💪 @else Uji Pemahamanmu! 🎯 @endif
                </h1>
                <p class="text-white/70 text-base max-w-lg mx-auto">
                    Jawab {{ $questions->count() }} soal berikut. Kamu perlu skor minimal
                    <strong class="text-yellow-400">{{ $posttest->passing_score }}%</strong> untuk menyelesaikan materi ini.
                    @if($attemptCount > 0)
                        <br><span class="text-white/50 text-sm">Percobaan ke-{{ $attemptCount + 1 }}</span>
                    @endif
                </p>
            </div>

            <form method="POST" action="{{ route('materials.posttest.submit', $material->slug) }}"
                  id="posttest-form"
                  x-data='{
                      current: 0,
                      total: {{ $questions->count() }},
                      answers: {},
                      feedback: {},
                      questionsData: @json($questionsData),

                      progress() { return ((this.current + 1) / this.total) * 100; },

                      selectAnswer(qId, value) {
                          this.answers[qId] = value;
                          const qd = this.questionsData[qId];
                          this.feedback[qId] = {
                              selected:    value,
                              correct:     qd.correct,
                              isCorrect:   value === qd.correct,
                              explanation: qd.explanation,
                          };
                      }
                  }'>
                @csrf

                <!-- Progress Bar -->
                <div class="mb-6">
                    <div class="flex justify-between text-white/60 text-xs mb-2">
                        <span x-text="`Soal ${current + 1} dari ${total}`"></span>
                        <span x-text="`${Math.round(progress())}% selesai`"></span>
                    </div>
                    <div class="h-3 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500"
                             style="background: linear-gradient(90deg, #8b5cf6, #3b82f6)"
                             :style="`width: ${progress()}%`"></div>
                    </div>
                </div>

                @foreach($questions as $i => $question)
                    <div x-show="current === {{ $i }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-4">

                        <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 flex items-center gap-3">
                            <span class="w-9 h-9 bg-white text-purple-600 rounded-xl flex items-center justify-center font-extrabold text-lg shrink-0">
                                {{ $i + 1 }}
                            </span>
                            <span class="text-white font-bold text-sm">
                                {{ $question->type === 'true_false' ? 'Benar / Salah' : 'Pilihan Ganda' }}
                            </span>
                        </div>

                        <div class="p-6 sm:p-8">
                            <p class="text-gray-900 dark:text-white font-semibold text-lg leading-relaxed mb-6">
                                {{ $question->question }}
                            </p>

                            <div class="space-y-3">
                                @php $shuffledOptions = collect($question->options)->shuffle(); @endphp
                                @foreach($shuffledOptions as $idx => $option)
                                    @php $letter = chr(65 + $idx); @endphp
                                    <label
                                        :class="{
                                            'border-blue-500 bg-blue-50 dark:bg-blue-900/30': feedback['{{ $question->id }}'] && '{{ addslashes($option) }}' === feedback['{{ $question->id }}'].correct,
                                            'border-red-400 bg-red-50 dark:bg-red-900/20': feedback['{{ $question->id }}'] && '{{ addslashes($option) }}' === feedback['{{ $question->id }}'].selected && !feedback['{{ $question->id }}'].isCorrect,
                                            'border-gray-200 dark:border-gray-600': !feedback['{{ $question->id }}'] || ('{{ addslashes($option) }}' !== feedback['{{ $question->id }}'].correct && '{{ addslashes($option) }}' !== feedback['{{ $question->id }}'].selected),
                                            'pointer-events-none': feedback['{{ $question->id }}']
                                        }"
                                        class="flex items-center gap-4 p-4 rounded-xl border-2 hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 cursor-pointer transition-all group">
                                        <input type="radio"
                                               name="answers[{{ $question->id }}]"
                                               value="{{ $option }}"
                                               class="sr-only"
                                               x-on:change="selectAnswer('{{ $question->id }}', '{{ addslashes($option) }}')">
                                        <span class="w-8 h-8 rounded-lg border-2 flex items-center justify-center font-bold text-sm shrink-0 transition-all"
                                              :class="{
                                                  'border-blue-500 bg-blue-500 text-white': feedback['{{ $question->id }}'] && '{{ addslashes($option) }}' === feedback['{{ $question->id }}'].correct,
                                                  'border-red-400 bg-red-400 text-white': feedback['{{ $question->id }}'] && '{{ addslashes($option) }}' === feedback['{{ $question->id }}'].selected && !feedback['{{ $question->id }}'].isCorrect,
                                                  'border-gray-300 dark:border-gray-500 text-gray-400': !feedback['{{ $question->id }}'] || ('{{ addslashes($option) }}' !== feedback['{{ $question->id }}'].correct && '{{ addslashes($option) }}' !== feedback['{{ $question->id }}'].selected)
                                              }">
                                            {{ $letter }}
                                        </span>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $option }}</span>
                                    </label>
                                @endforeach
                            </div>

                            {{-- Immediate Feedback Panel --}}
                            <template x-if="feedback['{{ $question->id }}']">
                                <div class="mt-5 rounded-xl p-4 border-2 transition-all"
                                     :class="feedback['{{ $question->id }}'].isCorrect
                                         ? 'bg-green-50 dark:bg-green-900/20 border-green-400 dark:border-green-600'
                                         : 'bg-red-50 dark:bg-red-900/20 border-red-400 dark:border-red-600'">
                                    <div class="flex items-start gap-3">
                                        <span class="text-2xl shrink-0"
                                              x-text="feedback['{{ $question->id }}'].isCorrect ? '✅' : '❌'"></span>
                                        <div class="flex-1">
                                            <p class="font-bold text-sm"
                                               :class="feedback['{{ $question->id }}'].isCorrect ? 'text-green-700 dark:text-green-400' : 'text-red-600 dark:text-red-400'"
                                               x-text="feedback['{{ $question->id }}'].isCorrect ? 'Jawaban Benar!' : 'Jawaban Salah!'"></p>
                                            <template x-if="!feedback['{{ $question->id }}'].isCorrect">
                                                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                                    Jawaban yang benar: <strong class="text-green-700 dark:text-green-400" x-text="feedback['{{ $question->id }}'].correct"></strong>
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

                            <div class="flex justify-between mt-8 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <button type="button" @click="if(current>0) current--" x-show="current > 0"
                                        class="flex items-center gap-2 text-gray-500 hover:text-gray-700 font-medium text-sm transition">
                                    ← Sebelumnya
                                </button>
                                <div x-show="current === 0"></div>

                                @if($i < $questions->count() - 1)
                                    <button type="button" @click="current++"
                                            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-500 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition">
                                        Berikutnya →
                                    </button>
                                @else
                                    <button type="submit"
                                            class="flex items-center gap-2 bg-green-600 hover:bg-green-500 text-white font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-green-700/30 transition">
                                        🎯 Kumpulkan Jawaban
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Quick Nav -->
                <div class="bg-white/10 backdrop-blur rounded-xl p-4">
                    <p class="text-white/60 text-xs font-medium mb-3">Navigasi Soal:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($questions as $i => $q)
                            <button type="button" @click="current = {{ $i }}"
                                    :class="current === {{ $i }}
                                        ? 'bg-purple-500 text-white'
                                        : (feedback['{{ $q->id }}']
                                            ? (feedback['{{ $q->id }}'].isCorrect ? 'bg-green-500 text-white' : 'bg-red-400 text-white')
                                            : 'bg-white/20 text-white hover:bg-white/30')"
                                    class="w-9 h-9 rounded-lg font-bold text-sm transition">
                                {{ $i + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>
            <!-- TOMBOL VIP KHUSUS GURU/ADMIN -->
                @if(auth()->user()->isTeacherOrAdmin())
                <div class="mt-6 bg-yellow-500/20 border border-yellow-400 p-5 rounded-xl flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-yellow-100 text-sm">
                        <span class="font-extrabold text-yellow-400 text-base">🛠️ Mode Guru Aktif:</span><br>
                        Kamu bebas melihat-lihat soal Posttest ini. Klik tombol di samping untuk kembali ke halaman Materi tanpa perlu submit jawaban.
                    </div>
                    <a href="{{ route('materials.show', $material->slug) }}" 
                       class="shrink-0 bg-yellow-500 hover:bg-yellow-400 text-yellow-900 font-extrabold py-3 px-6 rounded-xl shadow-lg transition">
                        &larr; Kembali ke Materi
                    </a>
                </div>
                @endif
            </form>
        </div>
    </div>
</x-app-layout>
