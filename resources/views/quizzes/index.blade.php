<x-app-layout>
    <x-slot name="title">Daftar Quiz</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">🧠 Daftar Quiz</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Kerjakan quiz untuk menguji pemahamanmu dan kumpulkan XP!</p>
            </div>

            <div class="space-y-4">
                @forelse($quizzes as $quiz)
                    @php
                        $best       = $bestScores[$quiz->id] ?? null;
                        $bestPct    = $best ? round(($best->best_score / $best->total_q) * 100) : null;
                        $grade      = null;
                        if ($bestPct !== null) {
                            $grade = match(true) {
                                $bestPct >= 90 => 'A',
                                $bestPct >= 80 => 'B',
                                $bestPct >= 70 => 'C',
                                $bestPct >= 60 => 'D',
                                default        => 'E',
                            };
                        }
                    @endphp
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-5 hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">

                            <!-- Icon + Info -->
                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                <div class="shrink-0 w-14 h-14 rounded-xl flex items-center justify-center text-3xl
                                    {{ $best ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-700' }}">
                                    {{ $best ? '✅' : '🧠' }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h2 class="font-bold text-gray-900 dark:text-white text-lg leading-tight">{{ $quiz->title }}</h2>
                                    @if($quiz->description)
                                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $quiz->description }}</p>
                                    @endif
                                    <div class="flex flex-wrap items-center gap-3 mt-2 text-sm">
                                        <span class="text-gray-400 dark:text-gray-500">
                                            📝 {{ $quiz->questions_count }} soal
                                        </span>
                                        @if($quiz->material)
                                            <span class="text-gray-400 dark:text-gray-500">·</span>
                                            <a href="{{ route('materials.show', $quiz->material->slug) }}"
                                               class="text-green-600 hover:underline text-xs font-medium">
                                                📖 {{ $quiz->material->title }}
                                            </a>
                                        @endif
                                        @if($best)
                                            <span class="text-gray-400 dark:text-gray-500">·</span>
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">
                                                {{ $best->attempts }}x dikerjakan
                                            </span>
                                        @endif
                                    </div>

                                    @if($bestPct !== null)
                                        <div class="mt-3 flex items-center gap-2">
                                            <div class="flex-1 max-w-xs h-2 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                                <div class="h-full rounded-full {{ $bestPct >= 80 ? 'bg-green-500' : ($bestPct >= 60 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                     style="width: {{ $bestPct }}%"></div>
                                            </div>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">Skor terbaik: {{ $best->best_score }}/{{ $best->total_q }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Skor + Tombol -->
                            <div class="flex items-center gap-4 shrink-0">
                                @if($bestPct !== null)
                                    <div class="text-center">
                                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-extrabold border-4
                                            {{ $bestPct >= 80 ? 'border-green-500 text-green-600 bg-green-50 dark:bg-green-900/30' :
                                               ($bestPct >= 60 ? 'border-yellow-500 text-yellow-600 bg-yellow-50 dark:bg-yellow-900/30' :
                                                'border-red-400 text-red-500 bg-red-50 dark:bg-red-900/30') }}">
                                            {{ $grade }}
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">{{ $bestPct }}%</p>
                                    </div>
                                @endif

                                <a href="{{ route('quizzes.take', $quiz->id) }}"
                                   class="bg-green-700 hover:bg-green-600 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition shadow-sm">
                                    {{ $best ? 'Coba Lagi' : 'Mulai Quiz' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 text-gray-400">
                        <p class="text-6xl mb-4">🧠</p>
                        <p class="text-lg font-medium">Belum ada quiz tersedia.</p>
                        <p class="text-sm mt-1">Tunggu guru kamu menambahkan quiz baru!</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
