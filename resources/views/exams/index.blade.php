<x-app-layout>
    <x-slot name="title">Ujian Kompetensi</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Header -->
            <div class="relative rounded-3xl overflow-hidden mb-8 p-8 sm:p-10"
                 style="background: linear-gradient(135deg, #7c2d12 0%, #b45309 50%, #92400e 100%);">
                <div class="relative z-10">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">🏆 Ujian Kompetensi</h1>
                    <p class="text-orange-100 text-lg">Buktikan pemahamanmu tentang Seni Budaya Kalimantan Utara!</p>
                    <div class="flex flex-wrap gap-3 mt-4">
                        <div class="bg-white/20 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-xl">
                            ✅ {{ $harianPassedCount }} Ujian Harian Lulus
                        </div>
                        <div class="bg-white/20 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-xl">
                            🎓 {{ $utsPassedCount }} UTS Lulus
                        </div>
                    </div>
                </div>
                <!-- Decorative elements -->
                <div class="absolute right-0 top-0 w-48 h-full opacity-10 text-9xl flex items-center justify-center">📜</div>
            </div>

            <!-- Ujian Harian Section -->
            @if($harianList->isNotEmpty())
            <section class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-green-600 flex items-center justify-center text-white text-xl">📅</div>
                    <div>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white">Ujian Harian</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Quiz per topik, kerjakan dulu sebelum UTS/UAS</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($harianList as $quiz)
                        @php
                            $br = $bestResults[$quiz->id] ?? null;
                            $pct = $br && $br->total_q > 0 ? (int) round(($br->best_score / $br->total_q) * 100) : null;
                            $passed = $pct !== null && $pct >= $quiz->passing_score;
                        @endphp
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border-2 {{ $passed ? 'border-green-400' : 'border-green-200 dark:border-green-800' }} overflow-hidden card-lift">
                            @if($passed)
                                <div class="bg-green-50 dark:bg-green-900/20 px-4 py-2 text-xs font-bold text-green-700 flex items-center gap-2">
                                    ✅ Sudah Lulus
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-2xl shrink-0">📅</div>
                                    <div>
                                        <span class="text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400 px-2 py-0.5 rounded-full">Ujian Harian</span>
                                        <h3 class="font-bold text-gray-900 dark:text-white mt-1">{{ $quiz->title }}</h3>
                                        @if($quiz->description)
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $quiz->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4">
                                    <span>📝 {{ $quiz->questions_count }} soal</span>
                                    @if($quiz->isTimeLimited())
                                        <span>⏱ {{ $quiz->time_limit }} menit</span>
                                    @endif
                                    <span>🎯 Lulus ≥ {{ $quiz->passing_score }}%</span>
                                    @if($pct !== null)
                                        <span class="{{ $passed ? 'text-green-600 font-bold' : 'text-orange-500 font-bold' }}">
                                            Skormu: {{ $pct }}%
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('exams.start', $quiz->id) }}"
                                   class="block w-full py-3 text-center text-white font-bold rounded-xl transition
                                          {{ $passed ? 'bg-green-600 hover:bg-green-500' : 'bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 shadow-md shadow-green-500/30' }}">
                                    {{ $passed ? '🔄 Kerjakan Lagi' : '🚀 Kerjakan Sekarang' }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- UTS Section -->
            @if($utsList->isNotEmpty())
            <section class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white text-xl">🎓</div>
                    <div>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white">Ujian Tengah Semester (UTS)</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Mencakup beberapa topik, perlu lulus Ujian Harian dahulu</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($utsList as $quiz)
                        @php
                            $br = $bestResults[$quiz->id] ?? null;
                            $pct = $br && $br->total_q > 0 ? (int) round(($br->best_score / $br->total_q) * 100) : null;
                            $passed = $pct !== null && $pct >= $quiz->passing_score;
                            $locked = $quiz->min_harian_required > 0 && $harianPassedCount < $quiz->min_harian_required;
                        @endphp
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border-2 {{ $locked ? 'border-gray-200 dark:border-gray-700 opacity-70' : ($passed ? 'border-green-400' : 'border-orange-300 dark:border-orange-700') }} overflow-hidden">
                            @if($locked)
                                <div class="bg-gray-100 dark:bg-gray-700 px-4 py-2 text-xs font-bold text-gray-500 flex items-center gap-2">
                                    🔒 Perlu lulus {{ $quiz->min_harian_required }} Ujian Harian (kamu: {{ $harianPassedCount }})
                                </div>
                            @elseif($passed)
                                <div class="bg-green-50 dark:bg-green-900/20 px-4 py-2 text-xs font-bold text-green-700 flex items-center gap-2">
                                    ✅ Sudah Lulus
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-2xl shrink-0">🎓</div>
                                    <div>
                                        <span class="text-xs font-bold bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-400 px-2 py-0.5 rounded-full">UTS</span>
                                        <h3 class="font-bold text-gray-900 dark:text-white mt-1">{{ $quiz->title }}</h3>
                                        @if($quiz->description)
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $quiz->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4">
                                    <span>📝 {{ $quiz->questions_count }} soal</span>
                                    @if($quiz->isTimeLimited())
                                        <span>⏱ {{ $quiz->time_limit }} menit</span>
                                    @endif
                                    <span>🎯 Lulus ≥ {{ $quiz->passing_score }}%</span>
                                    @if($pct !== null)
                                        <span class="{{ $passed ? 'text-green-600 font-bold' : 'text-red-500 font-bold' }}">
                                            Skormu: {{ $pct }}%
                                        </span>
                                    @endif
                                </div>
                                @if($locked)
                                    <div class="w-full py-3 text-center text-gray-400 dark:text-gray-500 text-sm font-semibold bg-gray-50 dark:bg-gray-700 rounded-xl">
                                        🔒 Terkunci
                                    </div>
                                @else
                                    <a href="{{ route('exams.start', $quiz->id) }}"
                                       class="block w-full py-3 text-center text-white font-bold rounded-xl transition
                                              {{ $passed ? 'bg-green-600 hover:bg-green-500' : 'bg-orange-600 hover:bg-orange-500 shadow-md shadow-orange-500/30' }}">
                                        {{ $passed ? '🔄 Kerjakan Lagi' : '🚀 Kerjakan Sekarang' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- UAS Section -->
            @if($uasList->isNotEmpty())
            <section class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-red-700 flex items-center justify-center text-white text-xl">🏆</div>
                    <div>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white">Ujian Akhir Semester (UAS)</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Ujian komprehensif, perlu lulus UTS terlebih dahulu</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($uasList as $quiz)
                        @php
                            $br = $bestResults[$quiz->id] ?? null;
                            $pct = $br && $br->total_q > 0 ? (int) round(($br->best_score / $br->total_q) * 100) : null;
                            $passed = $pct !== null && $pct >= $quiz->passing_score;
                            $locked = $quiz->min_harian_required > 0 && $utsPassedCount < $quiz->min_harian_required;
                        @endphp
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border-2 {{ $locked ? 'border-gray-200 dark:border-gray-700 opacity-70' : ($passed ? 'border-green-400' : 'border-red-400 dark:border-red-700') }} overflow-hidden">
                            @if($locked)
                                <div class="bg-gray-100 dark:bg-gray-700 px-4 py-2 text-xs font-bold text-gray-500 flex items-center gap-2">
                                    🔒 Perlu lulus {{ $quiz->min_harian_required }} UTS (kamu: {{ $utsPassedCount }})
                                </div>
                            @elseif($passed)
                                <div class="bg-green-50 dark:bg-green-900/20 px-4 py-2 text-xs font-bold text-green-700 flex items-center gap-2">
                                    ✅ Sudah Lulus
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-2xl shrink-0">🏆</div>
                                    <div>
                                        <span class="text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400 px-2 py-0.5 rounded-full">UAS</span>
                                        <h3 class="font-bold text-gray-900 dark:text-white mt-1">{{ $quiz->title }}</h3>
                                        @if($quiz->description)
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $quiz->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4">
                                    <span>📝 {{ $quiz->questions_count }} soal</span>
                                    @if($quiz->isTimeLimited())
                                        <span>⏱ {{ $quiz->time_limit }} menit</span>
                                    @endif
                                    <span>🎯 Lulus ≥ {{ $quiz->passing_score }}%</span>
                                    @if($pct !== null)
                                        <span class="{{ $passed ? 'text-green-600 font-bold' : 'text-red-500 font-bold' }}">
                                            Skormu: {{ $pct }}%
                                        </span>
                                    @endif
                                </div>
                                @if($locked)
                                    <div class="w-full py-3 text-center text-gray-400 dark:text-gray-500 text-sm font-semibold bg-gray-50 dark:bg-gray-700 rounded-xl">
                                        🔒 Terkunci
                                    </div>
                                @else
                                    <a href="{{ route('exams.start', $quiz->id) }}"
                                       class="block w-full py-3 text-center text-white font-bold rounded-xl transition
                                              {{ $passed ? 'bg-green-600 hover:bg-green-500' : 'bg-red-700 hover:bg-red-600 shadow-md shadow-red-700/30' }}">
                                        {{ $passed ? '🔄 Kerjakan Lagi' : '🚀 Kerjakan Sekarang' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            @if($harianList->isEmpty() && $utsList->isEmpty() && $uasList->isEmpty())
                <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700">
                    <div class="text-6xl mb-4">📭</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Ujian</h3>
                    <p class="text-gray-500 dark:text-gray-400">Ujian akan tersedia setelah guru membuat dan mengkonfigurasinya.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
