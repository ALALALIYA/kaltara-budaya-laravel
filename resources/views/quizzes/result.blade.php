<x-app-layout>
    <x-slot name="title">Hasil Quiz</x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Card Skor Utama -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

                <!-- Banner atas -->
                <div class="bg-green-900 px-6 py-8 text-center text-white">
                    <p class="text-green-300 text-sm font-medium mb-2">{{ $quiz->title }}</p>
                    <div class="inline-flex items-center justify-center w-28 h-28 rounded-full border-4 mb-4
                        {{ $result->percentage >= 80 ? 'border-yellow-400 bg-yellow-400/10' :
                           ($result->percentage >= 60 ? 'border-blue-400 bg-blue-400/10' : 'border-red-400 bg-red-400/10') }}">
                        <span class="text-5xl font-extrabold
                            {{ $result->percentage >= 80 ? 'text-yellow-400' :
                               ($result->percentage >= 60 ? 'text-blue-400' : 'text-red-400') }}">
                            {{ $result->grade }}
                        </span>
                    </div>
                    <p class="text-4xl font-extrabold">{{ round($result->percentage) }}%</p>
                    <p class="text-green-200 mt-1">
                        {{ $result->score }} benar dari {{ $result->total_questions }} soal
                    </p>

                    @php
                        $xp = max(5, $result->score * 5);
                    @endphp
                    <div class="mt-4 inline-flex items-center gap-2 bg-yellow-400/20 border border-yellow-400/40 text-yellow-300 font-semibold px-4 py-2 rounded-full text-sm">
                        ⚡ +{{ $xp }} XP didapat!
                    </div>
                </div>

                <!-- Pesan motivasi -->
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    @if($result->percentage >= 90)
                        <p class="text-center text-green-700 dark:text-green-400 font-bold text-lg">🏆 Luar biasa! Skor sempurna hampir kamu raih!</p>
                    @elseif($result->percentage >= 80)
                        <p class="text-center text-green-700 dark:text-green-400 font-bold text-lg">🎉 Kerja keras terbayar! Hasil yang sangat baik!</p>
                    @elseif($result->percentage >= 60)
                        <p class="text-center text-yellow-700 dark:text-yellow-400 font-bold text-lg">💪 Bagus! Masih ada ruang untuk berkembang lebih!</p>
                    @else
                        <p class="text-center text-red-700 dark:text-red-400 font-bold text-lg">📖 Jangan menyerah! Baca ulang materi lalu coba lagi!</p>
                    @endif
                </div>

                <!-- Tombol aksi -->
                <div class="px-6 py-5 flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('quizzes.take', $quiz->id) }}"
                       class="flex items-center justify-center gap-2 bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl transition">
                        🔄 Coba Lagi
                    </a>
                    <a href="{{ route('quizzes.index') }}"
                       class="flex items-center justify-center gap-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold px-6 py-3 rounded-xl transition">
                        ← Kembali ke Daftar Quiz
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center justify-center gap-2 border-2 border-green-700 text-green-700 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/30 font-semibold px-6 py-3 rounded-xl transition">
                        🏠 Dashboard
                    </a>
                </div>
            </div>

            {{-- AI Feedback Personal --}}
            @if(!empty($result->ai_feedback) && env('AI_FEEDBACK_ENABLED', true))
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-indigo-200 dark:border-indigo-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3 flex items-center gap-2">
                        <span class="text-lg">🤖</span>
                        <span class="text-white font-bold text-sm">Feedback Personal untuk Kamu</span>
                        <span class="ml-auto text-indigo-200 text-xs">Dibuat oleh AI</span>
                    </div>
                    <div class="px-6 py-5">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm">{{ $result->ai_feedback }}</p>
                    </div>
                </div>
            @endif

            <!-- Jawaban Detail -->
            <div>
                <h2 class="font-bold text-gray-900 dark:text-white text-lg mb-4">📋 Detail Jawaban</h2>
                <div class="space-y-3">
                    @foreach($quiz->questions as $i => $question)
                        @php
                            $isCorrect = true; // We don't store per-answer breakdown, show questions only
                        @endphp
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                            <div class="flex items-start gap-3">
                                <span class="shrink-0 w-7 h-7 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-400 mt-0.5">
                                    {{ $i + 1 }}
                                </span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-gray-900 dark:text-white font-medium text-sm leading-relaxed">
                                        {{ $question->question }}
                                    </p>
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="text-xs font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 px-2.5 py-1 rounded-full">
                                            ✓ {{ $question->correct_answer }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
