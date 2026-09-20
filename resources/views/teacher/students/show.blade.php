<x-app-layout>
    <x-slot name="title">Profil: {{ $user->name }}</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Breadcrumb & Top Actions -->
            <div class="flex items-center justify-between">
                <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('teacher.students.index') }}" class="hover:text-green-600 transition-colors">Data Siswa</a>
                    <span>/</span>
                    <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $user->name }}</span>
                </nav>
                <form action="{{ route('teacher.students.reset_all', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mereset seluruh progres belajar siswa ini (XP, badge, hasil kuis, dan materi)? Data tidak dapat dikembalikan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 text-xs font-bold px-3 py-1.5 rounded-lg transition-colors">
                        🔄 Reset Seluruh Progres
                    </button>
                </form>
            </div>

            <!-- Profil Siswa -->
            <div class="bg-green-900 rounded-2xl p-6 text-white">
                <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                    <!-- Avatar -->
                    <div class="shrink-0 w-16 h-16 rounded-full bg-gradient-to-br from-yellow-400 to-green-600 flex items-center justify-center text-2xl font-extrabold text-white shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <!-- Info -->
                    <div class="flex-1">
                        <h1 class="text-xl sm:text-2xl font-extrabold">{{ $user->name }}</h1>
                        <p class="text-green-300 text-sm">{{ $user->email }}</p>
                        <p class="text-green-300 text-xs mt-1">Bergabung {{ $user->created_at->format('d M Y') }}</p>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-4 shrink-0">
                        <div class="text-center bg-green-800 rounded-xl px-4 py-3 border border-green-700">
                            <p class="text-yellow-400 font-extrabold text-xl">⚡ {{ number_format($user->xp) }}</p>
                            <p class="text-green-300 text-xs">Total XP</p>
                        </div>
                        <div class="text-center bg-green-800 rounded-xl px-4 py-3 border border-green-700">
                            <p class="text-orange-400 font-extrabold text-xl">🔥 {{ $user->streak }}</p>
                            <p class="text-green-300 text-xs">Streak</p>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mt-5 grid grid-cols-3 gap-4 pt-5 border-t border-green-800">
                    <div class="text-center">
                        <p class="text-2xl font-extrabold text-white">{{ $completedMaterials }}</p>
                        <p class="text-green-300 text-xs">/ {{ $totalMaterials }} Materi</p>
                    </div>
                    <div class="text-center border-x border-green-800">
                        <p class="text-2xl font-extrabold text-white">{{ $quizResults->count() }}</p>
                        <p class="text-green-300 text-xs">Quiz Dikerjakan</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-extrabold text-white">{{ $earnedBadges->count() }}</p>
                        <p class="text-green-300 text-xs">Badge Diraih</p>
                    </div>
                </div>
            </div>

            <!-- Badge -->
            @if($earnedBadges->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg mb-4">🏅 Badge yang Diraih</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($earnedBadges as $badge)
                            <div class="flex items-center gap-2 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-xl px-4 py-2.5">
                                <span class="text-2xl">{{ $badge->icon }}</span>
                                <div>
                                    <p class="font-bold text-yellow-800 dark:text-yellow-400 text-sm">{{ $badge->name }}</p>
                                    <p class="text-yellow-600 dark:text-yellow-500 text-xs">{{ $badge->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Hasil Quiz -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg mb-4">🧠 Hasil Quiz</h2>

                    @if($quizResults->isEmpty())
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-4xl mb-2">📝</p>
                            <p class="text-sm">Siswa belum mengerjakan quiz apapun.</p>
                        </div>
                    @else
                        <div class="space-y-3 max-h-80 overflow-y-auto pr-1">
                            @foreach($quizResults as $result)
                                @php $pct = $result->percentage; @endphp
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center text-sm font-extrabold
                                        {{ $pct >= 80 ? 'bg-green-100 text-green-700' : ($pct >= 60 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-600') }}">
                                        {{ $result->grade }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">
                                            {{ $result->quiz->title }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <div class="flex-1 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                                <div class="h-full rounded-full {{ $pct >= 80 ? 'bg-green-500' : ($pct >= 60 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                     style="width: {{ $pct }}%"></div>
                                            </div>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 shrink-0">
                                                {{ $result->score }}/{{ $result->total_questions }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="shrink-0 text-right">
                                        <p class="text-xs font-bold {{ $pct >= 80 ? 'text-green-600' : ($pct >= 60 ? 'text-yellow-600' : 'text-red-500') }}">
                                            {{ round($pct) }}%
                                        </p>
                                        <p class="text-xs text-gray-400">{{ $result->completed_at?->format('d/m/y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Progress Materi -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg mb-4">📖 Progress Materi</h2>

                    @if($materialProgress->isEmpty())
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-4xl mb-2">📚</p>
                            <p class="text-sm">Siswa belum membuka materi apapun.</p>
                        </div>
                    @else
                        <div class="space-y-3 max-h-80 overflow-y-auto pr-1">
                            @foreach($materialProgress as $progress)
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <span class="shrink-0 text-xl">
                                        {{ optional($progress->material)->category === 'dayak' ? '🦅' :
                                           (optional($progress->material)->category === 'banjar' ? '🎋' :
                                           (optional($progress->material)->category === 'kutai' ? '🐉' : '🌊')) }}
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">
                                            {{ optional($progress->material)->title ?? 'Materi Dihapus' }}
                                        </p>
                                        <p class="text-gray-400 text-xs">{{ optional($progress->material)->category_label }}</p>
                                    </div>
                                    @if($progress->isCompleted())
                                        <span class="shrink-0 text-xs font-bold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 px-2 py-0.5 rounded-full">
                                            ✓ Selesai
                                        </span>
                                    @else
                                        <span class="shrink-0 text-xs text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full">
                                            Dibuka
                                        </span>
                                    @endif
                                    
                                    @if(optional($progress->material)->id)
                                        <form action="{{ route('teacher.students.reset_material', [$user->id, $progress->material->id]) }}" method="POST" class="shrink-0 ml-2" onsubmit="return confirm('Reset status materi ini dan hapus hasil kuis yang terkait untuk siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Reset Progres Materi Ini" class="text-gray-400 hover:text-red-500 transition-colors text-sm">
                                                🔄
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
