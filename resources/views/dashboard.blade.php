<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- ── HERO SELAMAT DATANG ──────────────────────────────── -->
            <div class="relative rounded-2xl overflow-hidden shadow-xl bg-canopy">
                <!-- Amber glow + watermark -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
                    <div class="absolute -right-16 -top-16 w-72 h-72 rounded-full opacity-15"
                         style="background: radial-gradient(circle, #fbbf24, transparent)"></div>
                    <div class="absolute right-6 bottom-2 text-[9rem] opacity-[0.06] select-none leading-none">🌿</div>
                </div>

                <div class="relative px-8 py-10 sm:px-12">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-8">
                        <!-- Left: greeting + name + xp bar -->
                        <div class="min-w-0">
                            <p class="text-green-400 text-xs font-bold uppercase tracking-widest mb-2">Selamat datang kembali</p>
                            <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-3">{{ $user->name }} 👋</h1>
                            <p class="text-green-200 text-sm">
                                Kamu sudah menyelesaikan
                                <strong class="text-yellow-400 font-extrabold">{{ $completedMaterialCount }} dari {{ $totalMaterials }}</strong> materi.
                                Terus jaga streak-mu!
                            </p>
                            @php
                                $nextLevel  = (floor($user->xp / 100) + 1) * 100;
                                $currentPct = ($user->xp % 100);
                            @endphp
                            <div class="mt-5 max-w-sm">
                                <div class="flex justify-between text-xs font-bold mb-1.5">
                                    <span class="text-yellow-400">⚡ Level {{ floor($user->xp / 100) + 1 }}</span>
                                    <span class="text-green-300">{{ $user->xp % 100 }} / 100 XP</span>
                                </div>
                                <div class="xp-bar">
                                    <div class="xp-bar-fill" style="width: {{ $currentPct }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: XP & Streak tiles -->
                        <div class="flex gap-3 shrink-0">
                            <div class="rounded-2xl p-5 text-center min-w-[100px] border border-white/15"
                                 style="background: rgba(255,255,255,0.08);">
                                <p class="text-4xl font-black text-yellow-400">{{ number_format($user->xp) }}</p>
                                <p class="text-yellow-300 text-xs font-bold uppercase tracking-wide mt-1">⚡ Total XP</p>
                            </div>
                            <div class="rounded-2xl p-5 text-center min-w-[100px] border border-white/15"
                                 style="background: rgba(255,255,255,0.08);">
                                <p class="text-4xl font-black text-orange-300">{{ $user->streak }}</p>
                                <p class="text-orange-300 text-xs font-bold uppercase tracking-wide mt-1">🔥 Hari Streak</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── STATISTIK CEPAT ─────────────────────────────────── -->
            {{-- Each stat gets its own color family — breaks the identical-card pattern --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-green-50 dark:bg-green-900/30 rounded-2xl p-5 border border-green-200 dark:border-green-700/50 text-center">
                    <p class="text-4xl font-black text-green-700 dark:text-green-400">{{ $completedMaterialCount }}</p>
                    <p class="text-green-600 dark:text-green-500 text-xs font-bold uppercase tracking-wide mt-1">📖 Materi Selesai</p>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900/30 rounded-2xl p-5 border border-yellow-200 dark:border-yellow-700/50 text-center">
                    <p class="text-4xl font-black text-yellow-700 dark:text-yellow-400">{{ $totalQuizzesTaken }}</p>
                    <p class="text-yellow-600 dark:text-yellow-500 text-xs font-bold uppercase tracking-wide mt-1">🧠 Quiz Dikerjakan</p>
                </div>
                <div class="bg-amber-50 dark:bg-amber-900/30 rounded-2xl p-5 border border-amber-200 dark:border-amber-700/50 text-center">
                    <p class="text-4xl font-black text-amber-700 dark:text-amber-400">{{ $earnedBadges->count() }}</p>
                    <p class="text-amber-600 dark:text-amber-500 text-xs font-bold uppercase tracking-wide mt-1">🏅 Badge Diraih</p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/30 rounded-2xl p-5 border border-blue-200 dark:border-blue-700/50 text-center">
                    <p class="text-4xl font-black text-blue-700 dark:text-blue-400">{{ $totalMaterials - $completedMaterialCount }}</p>
                    <p class="text-blue-600 dark:text-blue-500 text-xs font-bold uppercase tracking-wide mt-1">📚 Belum Dibaca</p>
                </div>
            </div>

            <!-- ── PROGRES BELAJAR ─────────────────────────────────── -->
            @if(!empty($sukuProgress) || $avgScore !== null)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-7">
                    <div class="flex flex-wrap items-start gap-8">

                        <!-- Overall summary -->
                        <div class="flex-1 min-w-[180px]">
                            <h2 class="font-extrabold text-gray-900 dark:text-white text-xl mb-4">Progres Belajar</h2>
                            <div class="flex items-end gap-6 mb-3">
                                <div>
                                    <p class="text-5xl font-black text-green-600 dark:text-green-400 leading-none">
                                        {{ $completedMaterialCount }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">dari {{ $totalMaterials }} materi selesai</p>
                                </div>
                                @if($avgScore !== null)
                                    <div class="border-l border-gray-200 dark:border-gray-600 pl-6">
                                        <p class="text-5xl font-black leading-none {{ $avgScore >= 75 ? 'text-green-600 dark:text-green-400' : ($avgScore >= 60 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-500') }}">
                                            {{ $avgScore }}<span class="text-2xl font-bold">%</span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">rata-rata nilai quiz</p>
                                    </div>
                                @endif
                            </div>
                            @php
                                $overallPct = $totalMaterials > 0 ? round($completedMaterialCount / $totalMaterials * 100) : 0;
                            @endphp
                            <div class="w-full h-4 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden mt-4">
                                <div class="h-full bg-green-500 rounded-full transition-all" style="width: {{ $overallPct }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 font-medium">{{ $overallPct }}% dari seluruh materi</p>
                        </div>

                        <!-- Per-suku progress bars -->
                        @if(!empty($sukuProgress))
                            <div class="flex-1 min-w-[200px]">
                                <h2 class="font-extrabold text-gray-900 dark:text-white text-xl mb-4">Per Suku</h2>
                                <div class="space-y-4">
                                    @php
                                        $sukuMeta = [
                                            'dayak'  => ['icon' => '🦅', 'label' => 'Suku Dayak',  'color' => 'bg-green-500'],
                                            'banjar' => ['icon' => '🎋', 'label' => 'Suku Banjar', 'color' => 'bg-amber-500'],
                                            'kutai'  => ['icon' => '🐉', 'label' => 'Suku Kutai',  'color' => 'bg-red-500'],
                                            'tidung' => ['icon' => '🌊', 'label' => 'Suku Tidung', 'color' => 'bg-blue-500'],
                                        ];
                                    @endphp
                                    @foreach($sukuProgress as $suku => $data)
                                        @php $meta = $sukuMeta[$suku]; @endphp
                                        <div>
                                            <div class="flex justify-between items-center mb-1.5">
                                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">
                                                    {{ $meta['icon'] }} {{ $meta['label'] }}
                                                </span>
                                                <span class="text-xs font-bold text-gray-500 dark:text-gray-400">
                                                    {{ $data['completed'] }}/{{ $data['total'] }}
                                                </span>
                                            </div>
                                            <div class="w-full h-3 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                                <div class="h-full {{ $meta['color'] }} rounded-full transition-all"
                                                     style="width: {{ $data['pct'] }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- ── BADGE KOLEKSI ───────────────────────────────── -->
                <div class="md:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 h-full">
                        <h2 class="font-extrabold text-gray-900 dark:text-white text-xl mb-5">🏅 Badge Kamu</h2>
                        @if($earnedBadges->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-6xl mb-3">🔒</p>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada badge. Mulai belajar untuk mendapatkan badge pertamamu!</p>
                            </div>
                        @else
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($earnedBadges as $badge)
                                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border-2 border-yellow-300 dark:border-yellow-600 rounded-xl p-3 text-center badge-earned hover:-translate-y-1 transition-transform">
                                        <p class="text-4xl mb-1">{{ $badge->icon }}</p>
                                        <p class="text-xs font-bold text-yellow-800 dark:text-yellow-300 leading-tight">{{ $badge->name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- ── HASIL QUIZ TERBARU ──────────────────────────── -->
                <div class="md:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="font-extrabold text-gray-900 dark:text-white text-xl">Hasil Quiz Terbaru</h2>
                            <a href="{{ route('quizzes.index') }}" class="text-green-600 hover:text-green-500 text-sm font-bold">
                                Lihat semua →
                            </a>
                        </div>

                        @if($recentResults->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-6xl mb-3">📝</p>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kamu belum mengerjakan quiz. <a href="{{ route('quizzes.index') }}" class="text-green-600 font-bold">Mulai sekarang!</a></p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($recentResults as $result)
                                    @php $pct = $result->percentage; @endphp
                                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
                                        <!-- Grade circle — bigger -->
                                        <div class="shrink-0 w-14 h-14 rounded-full flex items-center justify-center text-xl font-black
                                            {{ $pct >= 80 ? 'bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300' : ($pct >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300' : 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300') }}">
                                            {{ $result->grade }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-gray-900 dark:text-white text-sm truncate">
                                                {{ $result->quiz->title }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1.5">
                                                <div class="flex-1 h-2 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                                    <div class="h-full rounded-full {{ $pct >= 80 ? 'bg-green-500' : ($pct >= 60 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                         style="width: {{ $pct }}%"></div>
                                                </div>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 shrink-0 font-medium">{{ $result->score }}/{{ $result->total_questions }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <p class="text-base font-black {{ $pct >= 80 ? 'text-green-600 dark:text-green-400' : ($pct >= 60 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                                                {{ round($pct) }}%
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $result->completed_at?->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ── REKOMENDASI MATERI ──────────────────────────────── -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-extrabold text-gray-900 dark:text-white text-xl">📚 Lanjutkan Belajar</h2>
                    <a href="{{ route('materials.index') }}" class="text-green-600 hover:text-green-500 text-sm font-bold">
                        Lihat semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($latestMaterials as $material)
                        @php $isCompleted = in_array($material->id, $completedMaterialIds); @endphp
                        <a href="{{ route('materials.show', $material->slug) }}"
                           class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                            <div class="h-36 bg-gradient-to-br
                                {{ $material->category === 'dayak'  ? 'from-green-700 to-green-900' :
                                   ($material->category === 'banjar' ? 'from-amber-600 to-amber-900' :
                                   ($material->category === 'kutai'  ? 'from-red-700 to-red-900' :
                                   ($material->category === 'tidung' ? 'from-blue-700 to-blue-900' : 'from-gray-600 to-gray-800'))) }}
                                flex items-center justify-center text-5xl relative">
                                {{ $material->category_icon }}
                                @if($isCompleted)
                                    <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">✓ Selesai</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <span class="text-xs font-black {{ $material->category_color }} uppercase tracking-wide">{{ $material->category_label }}</span>
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm mt-1 leading-tight group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                    {{ $material->title }}
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-1 line-clamp-2">{{ $material->description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- ── AKSI CEPAT ─────────────────────────────────────── -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('materials.index') }}"
                   class="group relative flex items-center gap-5 bg-green-700 hover:bg-green-600 text-white rounded-2xl py-7 px-6 transition-all duration-200 overflow-hidden hover:shadow-lg hover:-translate-y-0.5">
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-8xl opacity-10 pointer-events-none select-none" aria-hidden="true">📖</div>
                    <span class="text-5xl shrink-0 relative">📖</span>
                    <div class="relative">
                        <p class="font-extrabold text-lg leading-tight">Baca Materi</p>
                        <p class="text-green-200 text-sm mt-0.5">Jelajahi budaya 4 suku</p>
                    </div>
                    <span class="ml-auto text-xl opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all relative">→</span>
                </a>
                <a href="{{ route('quizzes.index') }}"
                   class="group relative flex items-center gap-5 bg-yellow-400 hover:bg-yellow-300 text-green-900 rounded-2xl py-7 px-6 transition-all duration-200 overflow-hidden hover:shadow-lg hover:-translate-y-0.5">
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-8xl opacity-10 pointer-events-none select-none" aria-hidden="true">🧠</div>
                    <span class="text-5xl shrink-0 relative">🧠</span>
                    <div class="relative">
                        <p class="font-extrabold text-lg leading-tight">Kerjakan Quiz</p>
                        <p class="text-green-700 text-sm mt-0.5">Uji pengetahuanmu</p>
                    </div>
                    <span class="ml-auto text-xl opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all relative">→</span>
                </a>
                <a href="{{ route('games.matching') }}"
                   class="group relative flex items-center gap-5 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl py-7 px-6 transition-all duration-200 overflow-hidden hover:shadow-lg hover:-translate-y-0.5">
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-8xl opacity-10 pointer-events-none select-none" aria-hidden="true">🎮</div>
                    <span class="text-5xl shrink-0 relative">🎮</span>
                    <div class="relative">
                        <p class="font-extrabold text-lg leading-tight">Main Game</p>
                        <p class="text-blue-200 text-sm mt-0.5">Cocokkan motif &amp; tarian</p>
                    </div>
                    <span class="ml-auto text-xl opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all relative">→</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
