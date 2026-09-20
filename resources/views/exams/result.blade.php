<x-app-layout>
    <x-slot name="title">Hasil {{ $quiz->type_label }}</x-slot>

    <div class="min-h-screen py-12"
         style="background: linear-gradient(135deg,
            {{ $quiz->quiz_type === 'ujian_harian' ? '#064e3b, #065f46' :
               ($quiz->quiz_type === 'uts' ? '#7c2d12, #b45309' : '#450a0a, #7f1d1d') }});">
        <div class="max-w-xl mx-auto px-4">

            @php $passed = $result->isPassed(); @endphp

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden">

                <!-- Score Header -->
                <div class="p-8 text-center {{ $passed ? 'bg-gradient-to-r from-green-500 to-emerald-600' : 'bg-gradient-to-r from-red-500 to-orange-500' }}">
                    @if($passed)
                        <div class="text-6xl mb-2">🎉</div>
                    @else
                        <div class="text-6xl mb-2">😤</div>
                    @endif
                    <div class="text-7xl font-extrabold text-white mb-2">{{ $result->percentage }}%</div>
                    <div class="text-white/80">{{ $result->score }} / {{ $result->total_questions }} benar</div>
                    <div class="mt-3 flex items-center justify-center gap-2">
                        <span class="bg-white/20 text-white font-bold px-4 py-1.5 rounded-full text-sm">
                            Grade: {{ $result->grade }}
                        </span>
                        <span class="bg-white/20 text-white font-bold px-4 py-1.5 rounded-full text-sm">
                            {{ $passed ? '✅ LULUS' : '❌ BELUM LULUS' }}
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    @if($passed)
                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">
                                Selamat! {{ $quiz->type_label }} Lulus! 🏆
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                Kamu berhasil menyelesaikan {{ $quiz->type_label }} dengan skor
                                <strong class="text-green-600">{{ $result->percentage }}%</strong>.
                                @if($quiz->quiz_type === 'ujian_harian')
                                    Terus kerjakan Ujian Harian lainnya untuk membuka akses UTS!
                                @elseif($quiz->quiz_type === 'uts')
                                    Sekarang kamu bisa mengerjakan UAS!
                                @else
                                    Luar biasa! Kamu telah menyelesaikan Ujian Akhir Semester!
                                @endif
                            </p>
                        </div>
                    @else
                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">
                                Belum Lulus, Ayo Coba Lagi! 💪
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                Skor kamu <strong class="text-red-600">{{ $result->percentage }}%</strong>,
                                perlu minimal <strong>{{ $quiz->passing_score }}%</strong> untuk lulus.
                                Pelajari kembali materi dan coba lagi!
                            </p>
                        </div>

                        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-xl p-4 mb-6">
                            <ul class="text-orange-700 dark:text-orange-400 text-sm space-y-1">
                                <li>💡 Tidak ada batas percobaan — terus semangat!</li>
                                <li>📚 Review materi yang berkaitan dengan ujian ini</li>
                                <li>🎯 Fokus pada topik yang masih lemah</li>
                            </ul>
                        </div>
                    @endif

                    {{-- AI Feedback Personal --}}
                    @if(!empty($result->ai_feedback) && env('AI_FEEDBACK_ENABLED', true))
                        <div class="rounded-2xl border border-indigo-200 dark:border-indigo-700 overflow-hidden mb-6">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 flex items-center gap-2">
                                <span class="text-base">🤖</span>
                                <span class="text-white font-bold text-sm">Feedback Personal untuk Kamu</span>
                                <span class="ml-auto text-indigo-200 text-xs">Dibuat oleh AI</span>
                            </div>
                            <div class="bg-white dark:bg-gray-800 px-5 py-4">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm">{{ $result->ai_feedback }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- XP earned -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-xl p-3 mb-6 text-center">
                        <span class="text-yellow-700 dark:text-yellow-400 font-bold text-sm">
                            ⚡ +{{ max(5, $result->score * 5) }} XP diperoleh dari ujian ini!
                        </span>
                    </div>

                    <div class="space-y-3">
                        @if(!$passed)
                            <a href="{{ route('exams.start', $quiz->id) }}"
                               class="block w-full text-center py-3.5 bg-orange-600 hover:bg-orange-500 text-white font-bold rounded-xl transition shadow-lg shadow-orange-500/20">
                                🔄 Coba Lagi
                            </a>
                        @endif
                        <a href="{{ route('exams.index') }}"
                           class="block w-full text-center py-3.5 {{ $passed ? 'bg-green-600 hover:bg-green-500 text-white shadow-lg shadow-green-500/20' : 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300' }} font-bold rounded-xl transition">
                            {{ $passed ? '🏆 Lihat Ujian Lainnya' : '← Kembali ke Daftar Ujian' }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="block w-full text-center py-3.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition">
                            🏠 Dashboard
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
