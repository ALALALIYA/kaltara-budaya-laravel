<x-app-layout>
    <x-slot name="title">{{ $quiz->type_label }} — {{ $quiz->title }}</x-slot>

    <div class="min-h-screen py-8"
         style="background: linear-gradient(135deg,
            {{ $quiz->quiz_type === 'ujian_harian' ? '#064e3b, #065f46, #022c22' :
               ($quiz->quiz_type === 'uts' ? '#7c2d12, #b45309, #78350f' : '#450a0a, #7f1d1d, #3b0764') }});">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8"
             x-data="examTimer({{ $quiz->time_limit ?? 0 }}, {{ $questions->count() }})">

            <!-- Exam Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                    {{ $quiz->quiz_type === 'ujian_harian' ? '📅 UJIAN HARIAN' : ($quiz->quiz_type === 'uts' ? '🎓 UTS' : '🏆 UAS') }}
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white mb-2">{{ $quiz->title }}</h1>
                @if($quiz->description)
                    <p class="text-white/60 text-sm">{{ $quiz->description }}</p>
                @endif

                <!-- Countdown Timer -->
                @if($quiz->isTimeLimited())
                    <div class="inline-flex items-center gap-3 mt-4 bg-black/30 backdrop-blur px-6 py-3 rounded-2xl border border-white/20">
                        <span class="text-white/60 text-sm font-medium">⏱ Sisa Waktu:</span>
                        <span class="text-3xl font-extrabold font-mono"
                              :class="timeLeft <= 60 ? 'text-red-400 animate-pulse' : (timeLeft <= 300 ? 'text-yellow-400' : 'text-white')"
                              x-text="formatTime()"></span>
                    </div>
                @endif
            </div>

            <!-- Progress Bar -->
            <div class="mb-6">
                <div class="flex justify-between text-white/60 text-xs mb-2">
                    <span x-text="`Soal ${current + 1} dari ${total}`"></span>
                    <span x-text="`${Math.round(((current + 1) / total) * 100)}% selesai`"></span>
                </div>
                <div class="h-3 bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-500"
                         style="background: linear-gradient(90deg, #f59e0b, #ef4444)"
                         :style="`width: ${((current + 1) / total) * 100}%`"></div>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('exams.submit', $quiz->id) }}"
                  id="exam-form"
                  @submit.prevent="submitExam">
                @csrf

                @foreach($questions as $i => $question)
                    <div x-show="current === {{ $i }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-4">

                        <div class="px-6 py-4 flex items-center gap-3
                            {{ $quiz->quiz_type === 'ujian_harian' ? 'bg-gradient-to-r from-green-600 to-emerald-600' :
                               ($quiz->quiz_type === 'uts' ? 'bg-gradient-to-r from-orange-600 to-amber-600' : 'bg-gradient-to-r from-red-700 to-red-600') }}">
                            <span class="w-9 h-9 bg-white {{ $quiz->quiz_type === 'ujian_harian' ? 'text-green-600' : ($quiz->quiz_type === 'uts' ? 'text-orange-600' : 'text-red-600') }} rounded-xl flex items-center justify-center font-extrabold text-lg">
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
                                @foreach($question->options as $idx => $option)
                                    @php $letter = chr(65 + $idx); @endphp
                                    @php
                                        $activeColor = $quiz->quiz_type === 'ujian_harian'
                                            ? 'has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:has-[:checked]:bg-green-900/30 hover:border-green-400 hover:bg-green-50'
                                            : ($quiz->quiz_type === 'uts'
                                                ? 'has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 dark:has-[:checked]:bg-orange-900/30 hover:border-orange-400 hover:bg-orange-50'
                                                : 'has-[:checked]:border-red-500 has-[:checked]:bg-red-50 dark:has-[:checked]:bg-red-900/30 hover:border-red-400 hover:bg-red-50');
                                        $checkedBadge = $quiz->quiz_type === 'ujian_harian'
                                            ? 'group-has-[:checked]:border-green-500 group-has-[:checked]:bg-green-500 group-has-[:checked]:text-white'
                                            : ($quiz->quiz_type === 'uts'
                                                ? 'group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 group-has-[:checked]:text-white'
                                                : 'group-has-[:checked]:border-red-500 group-has-[:checked]:bg-red-500 group-has-[:checked]:text-white');
                                    @endphp
                                    <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 cursor-pointer transition-all group {{ $activeColor }}">
                                        <input type="radio"
                                               name="answers[{{ $question->id }}]"
                                               value="{{ $option }}"
                                               class="sr-only"
                                               x-on:change="answers['{{ $question->id }}'] = '{{ addslashes($option) }}'; if (current < total - 1) setTimeout(() => current++, 400)">
                                        <span class="w-8 h-8 rounded-lg border-2 border-gray-300 dark:border-gray-500 flex items-center justify-center font-bold text-gray-400 text-sm shrink-0 transition-all {{ $checkedBadge }}">
                                            {{ $letter }}
                                        </span>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $option }}</span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="flex justify-between mt-8 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <button type="button" @click="if(current>0) current--" x-show="current > 0"
                                        class="flex items-center gap-2 text-gray-500 hover:text-gray-700 font-medium text-sm transition">
                                    ← Sebelumnya
                                </button>
                                <div x-show="current === 0"></div>

                                @if($i < $questions->count() - 1)
                                    <button type="button" @click="current++"
                                            class="flex items-center gap-2 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition
                                                {{ $quiz->quiz_type === 'ujian_harian' ? 'bg-green-600 hover:bg-green-500' : ($quiz->quiz_type === 'uts' ? 'bg-orange-600 hover:bg-orange-500' : 'bg-red-700 hover:bg-red-600') }}">
                                        Berikutnya →
                                    </button>
                                @else
                                    <button type="button" @click="submitExam()"
                                            class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-black font-extrabold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-yellow-500/30 transition">
                                        🎯 Kumpulkan Jawaban
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Quick Nav -->
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 mb-4">
                    <p class="text-white/60 text-xs font-medium mb-3">Navigasi Soal:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($questions as $i => $q)
                            <button type="button" @click="current = {{ $i }}"
                                    :class="current === {{ $i }}
                                        ? '{{ $quiz->quiz_type === 'ujian_harian' ? 'bg-green-500' : ($quiz->quiz_type === 'uts' ? 'bg-orange-500' : 'bg-red-600') }} text-white'
                                        : (answers['{{ $q->id }}'] ? 'bg-yellow-500 text-black' : 'bg-white/20 text-white hover:bg-white/30')"
                                    class="w-9 h-9 rounded-lg font-bold text-sm transition">
                                {{ $i + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Submit area -->
                <div class="flex justify-center">
                    <button type="button" @click="submitExam()"
                            class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-black font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-yellow-500/30 transition text-lg">
                        🎯 Kumpulkan Semua Jawaban
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function examTimer(timeLimitMinutes, totalQuestions) {
            return {
                current: 0,
                total: totalQuestions,
                answers: {},
                timeLeft: timeLimitMinutes > 0 ? timeLimitMinutes * 60 : null,
                timer: null,

                init() {
                    if (this.timeLeft !== null) {
                        this.timer = setInterval(() => {
                            this.timeLeft--;
                            if (this.timeLeft <= 0) {
                                clearInterval(this.timer);
                                this.submitExam(true);
                            }
                        }, 1000);
                    }
                },

                formatTime() {
                    if (this.timeLeft === null) return '∞';
                    const m = Math.floor(this.timeLeft / 60).toString().padStart(2, '0');
                    const s = (this.timeLeft % 60).toString().padStart(2, '0');
                    return `${m}:${s}`;
                },

                submitExam(forced = false) {
                    if (!forced) {
                        const unanswered = this.total - Object.keys(this.answers).length;
                        if (unanswered > 0) {
                            if (!confirm(`Masih ada ${unanswered} soal yang belum dijawab. Yakin ingin mengumpulkan?`)) return;
                        }
                    }
                    if (this.timer) clearInterval(this.timer);
                    document.getElementById('exam-form').submit();
                }
            };
        }
    </script>
</x-app-layout>
