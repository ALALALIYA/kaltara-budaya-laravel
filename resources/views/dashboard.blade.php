<x-app-layout>
    <x-slot name="title">Dashboard Pembelajaran</x-slot>

    <div class="py-8 bg-gradient-to-b from-amber-50/50 via-gray-50 to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-9">

            <!-- ── 1. HERO BANNER BUDAYA ETNIK ──────────────────────────────── -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-emerald-700/40 text-white hero-cultural-banner"
                 style="background: linear-gradient(135deg, #022c22 0%, #064e3b 50%, #042f2e 100%) !important;">
                <!-- Ornamen Latar Belakang Etnik SVG Pattern -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden select-none" aria-hidden="true">
                    <!-- Radial Glow -->
                    <div class="absolute -right-16 -top-16 w-96 h-96 rounded-full opacity-25 bg-amber-400 blur-3xl"></div>
                    <div class="absolute left-1/3 -bottom-20 w-80 h-80 rounded-full opacity-20 bg-emerald-400 blur-2xl"></div>

                    <!-- SVG Batik/Dayak Motif Pattern Overlay -->
                    <svg class="absolute right-0 inset-y-0 h-full w-2/3 opacity-[0.08] text-white" viewBox="0 0 400 400" fill="currentColor">
                        <defs>
                            <pattern id="dayak-mesh" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                                <path d="M40 0 L80 40 L40 80 L0 40 Z" fill="none" stroke="currentColor" stroke-width="2"/>
                                <circle cx="40" cy="40" r="12" fill="none" stroke="currentColor" stroke-width="2"/>
                                <path d="M40 20 C45 30, 45 50, 40 60 C35 50, 35 30, 40 20 Z" fill="currentColor" opacity="0.4"/>
                                <path d="M20 40 C30 45, 50 45, 60 40 C50 35, 30 35, 20 40 Z" fill="currentColor" opacity="0.4"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#dayak-mesh)" />
                    </svg>

                    <!-- Large Cultural Silhouette Badges -->
                    <div class="absolute right-8 bottom-3 text-8xl sm:text-9xl opacity-10 leading-none">🦅</div>
                </div>

                <div class="relative px-6 py-9 sm:px-12 sm:py-12">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                        <!-- Sisi Kiri: Sapaan & Progress Level -->
                        <div class="max-w-2xl">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-extrabold uppercase tracking-wider mb-3">
                                <span>🌿</span> Media Pembelajaran Seni Budaya Kaltara
                            </div>
                            <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight tracking-tight mb-3">
                                Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-amber-300 to-yellow-400">{{ $user->name }}</span>! 👋
                            </h1>
                            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed mb-6">
                                Mari jelajahi kekayaan adat, tari, musik, dan kearifan lokal <strong class="text-yellow-300 font-bold">Bumi Benuanta</strong>. Kamu telah menuntaskan <strong class="text-white underline decoration-yellow-400 decoration-2 font-black">{{ $completedMaterialCount }} dari {{ $totalMaterials }}</strong> materi pembelajaran.
                            </p>

                            @php
                                $currentLevel = floor($user->xp / 100) + 1;
                                $currentPct = ($user->xp % 100);
                            @endphp
                            <!-- XP Bar Gamifikasi Modern -->
                            <div class="rounded-2xl p-4 border border-white/10 max-w-lg" style="background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(8px);">
                                <div class="flex justify-between items-center text-xs font-extrabold mb-2">
                                    <span class="flex items-center gap-1.5 text-yellow-300">
                                        <span class="text-base">⚡</span> Level {{ $currentLevel }} Penjelajah
                                    </span>
                                    <span class="text-emerald-300 font-mono">{{ $user->xp % 100 }} / 100 XP menuju Lv. {{ $currentLevel + 1 }}</span>
                                </div>
                                <div class="w-full h-3.5 bg-black/50 rounded-full overflow-hidden p-0.5 border border-white/10">
                                    <div class="h-full rounded-full shadow-sm transition-all duration-1000"
                                         style="width: {{ $currentPct }}%; background: linear-gradient(90deg, #eab308, #f59e0b, #fbbf24);"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Sisi Kanan: Kartu Gamifikasi XP & Streak Glassmorphism -->
                        <div class="flex flex-row sm:flex-col lg:flex-row gap-4 shrink-0">
                            <!-- Kartu XP -->
                            <div class="flex-1 sm:flex-none rounded-2xl p-5 text-center min-w-[130px] border border-white/20 shadow-lg hover:border-yellow-400/50 transition-all hover:scale-105"
                                 style="background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(8px);">
                                <div class="w-12 h-12 rounded-full bg-yellow-400/20 text-yellow-300 flex items-center justify-center text-2xl mx-auto mb-2 shadow-inner">
                                    ⚡
                                </div>
                                <p class="text-3xl sm:text-4xl font-black text-yellow-300 tracking-tight">{{ number_format($user->xp) }}</p>
                                <p class="text-yellow-100/90 text-xs font-bold uppercase tracking-wider mt-1">Total XP</p>
                            </div>

                            <!-- Kartu Streak -->
                            <div class="flex-1 sm:flex-none rounded-2xl p-5 text-center min-w-[130px] border border-white/20 shadow-lg hover:border-orange-400/50 transition-all hover:scale-105"
                                 style="background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(8px);">
                                <div class="w-12 h-12 rounded-full bg-orange-400/20 text-orange-300 flex items-center justify-center text-2xl mx-auto mb-2 shadow-inner">
                                    🔥
                                </div>
                                <p class="text-3xl sm:text-4xl font-black text-orange-300 tracking-tight">{{ $user->streak }}</p>
                                <p class="text-orange-100/90 text-xs font-bold uppercase tracking-wider mt-1">Hari Streak</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 2. STATISTIK CEPAT ─────────────────────────────────── -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-emerald-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
                    <div class="w-13 h-13 rounded-2xl bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl shrink-0">
                        📖
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white leading-none mb-1">{{ $completedMaterialCount }}</p>
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Materi Selesai</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-amber-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
                    <div class="w-13 h-13 rounded-2xl bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl shrink-0">
                        🧠
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white leading-none mb-1">{{ $totalQuizzesTaken }}</p>
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Quiz Diikuti</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-yellow-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
                    <div class="w-13 h-13 rounded-2xl bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-yellow-400 flex items-center justify-center text-2xl shrink-0">
                        🏅
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white leading-none mb-1">{{ $earnedBadges->count() }}</p>
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Badge Diraih</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-teal-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
                    <div class="w-13 h-13 rounded-2xl bg-teal-100 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 flex items-center justify-center text-2xl shrink-0">
                        🎯
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white leading-none mb-1">
                            {{ $avgScore !== null ? $avgScore . '%' : '-' }}
                        </p>
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Rata-rata Skor</p>
                    </div>
                </div>
            </div>

            <!-- ── 3. VISUAL CULTURE EXPLORER: 4 PILAR SUKU KALIMANTAN UTARA ── -->
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2.5">
                            <span>🏛️</span> Eksplorasi 4 Suku Budaya Kaltara
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pilih suku untuk melihat materi dan memantau kemajuan belajarmu di setiap kebudayaan.</p>
                    </div>
                    <a href="{{ route('materials.index') }}" class="text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 flex items-center gap-1 group">
                        Lihat Semua 30 Materi <span class="transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>

                @php
                    $sukuCards = [
                        'dayak' => [
                            'name'        => 'Suku Dayak',
                            'sub'         => 'Kenyah, Kayan, Lundayeh, Punan',
                            'desc'        => 'Tradisi pedalaman, Tari Hudoq, Seni Mandau, dan Rumah Lamin.',
                            'icon'        => '🦅',
                            'gradient'    => 'linear-gradient(135deg, #065f46 0%, #022c22 100%)',
                            'cssClass'    => 'suku-card-dayak',
                            'badge'       => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300',
                            'border'      => 'border-emerald-300 dark:border-emerald-800',
                            'accent'      => 'text-emerald-600 dark:text-emerald-400',
                            'barColor'    => 'bg-emerald-500',
                            'cover'       => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=800&q=80',
                        ],
                        'banjar' => [
                            'name'        => 'Suku Banjar',
                            'sub'         => 'Musik Panting, Madihin & Sasirangan',
                            'desc'        => 'Irama musik panting, kuliner soto, dan kerajinan kain sasirangan.',
                            'icon'        => '🎋',
                            'gradient'    => 'linear-gradient(135deg, #b45309 0%, #78350f 100%)',
                            'cssClass'    => 'suku-card-banjar',
                            'badge'       => 'bg-amber-100 text-amber-800 dark:bg-amber-900/60 dark:text-amber-300',
                            'border'      => 'border-amber-300 dark:border-amber-800',
                            'accent'      => 'text-amber-600 dark:text-amber-400',
                            'barColor'    => 'bg-amber-500',
                            'cover'       => 'https://images.unsplash.com/photo-1609137144822-263a758784d1?auto=format&fit=crop&w=800&q=80',
                        ],
                        'kutai' => [
                            'name'        => 'Suku Kutai',
                            'sub'         => 'Tari Jepen, Keraton & Akulturasi Melayu',
                            'desc'        => 'Keanggunan gerak tari jepen, musik gambus, dan tradisi kesultanan.',
                            'icon'        => '🐉',
                            'gradient'    => 'linear-gradient(135deg, #991b1b 0%, #450a0a 100%)',
                            'cssClass'    => 'suku-card-kutai',
                            'badge'       => 'bg-rose-100 text-rose-800 dark:bg-rose-900/60 dark:text-rose-300',
                            'border'      => 'border-rose-300 dark:border-rose-800',
                            'accent'      => 'text-rose-600 dark:text-rose-400',
                            'barColor'    => 'bg-rose-500',
                            'cover'       => 'https://images.unsplash.com/photo-1578925518470-4def7a0f08bb?auto=format&fit=crop&w=800&q=80',
                        ],
                        'tidung' => [
                            'name'        => 'Suku Tidung',
                            'sub'         => 'Suku Laut, Iraw Tengkayu & Rumah Baloy',
                            'desc'        => 'Ritual pelarung padaw tuju dulung, arsitektur baloy mayo, dan pesisir.',
                            'icon'        => '🌊',
                            'gradient'    => 'linear-gradient(135deg, #0e7490 0%, #164e63 100%)',
                            'cssClass'    => 'suku-card-tidung',
                            'badge'       => 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900/60 dark:text-cyan-300',
                            'border'      => 'border-cyan-300 dark:border-cyan-800',
                            'accent'      => 'text-cyan-600 dark:text-cyan-400',
                            'barColor'    => 'bg-cyan-500',
                            'cover'       => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($sukuCards as $key => $card)
                        @php
                            $prog = $sukuProgress[$key] ?? ['total' => 0, 'completed' => 0, 'pct' => 0];
                        @endphp
                        <div class="group relative rounded-3xl overflow-hidden bg-white dark:bg-gray-800 border {{ $card['border'] }} shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                            <!-- Card Header Image Background -->
                            <div class="relative h-40 overflow-hidden {{ $card['cssClass'] }}" style="background: {{ $card['gradient'] }};">
                                <img src="{{ $card['cover'] }}" alt="{{ $card['name'] }}"
                                     class="w-full h-full object-cover opacity-70 group-hover:opacity-90 group-hover:scale-110 transition-all duration-700"
                                     loading="lazy"
                                     onerror="this.style.display='none'">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent"></div>

                                <!-- Badge Icon & Suku -->
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-black/60 backdrop-blur-md text-white border border-white/20 shadow">
                                        <span>{{ $card['icon'] }}</span> {{ $card['name'] }}
                                    </span>
                                </div>

                                <div class="absolute bottom-3 left-4 right-4 text-white">
                                    <p class="text-xs font-semibold text-amber-300 truncate">{{ $card['sub'] }}</p>
                                </div>
                            </div>

                            <!-- Card Body Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <p class="text-xs text-gray-600 dark:text-gray-300 line-clamp-2 leading-relaxed">
                                    {{ $card['desc'] }}
                                </p>

                                <!-- Progress Information -->
                                <div class="space-y-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                                    <div class="flex justify-between items-center text-xs font-bold">
                                        <span class="text-gray-500 dark:text-gray-400">Progres Membaca</span>
                                        <span class="{{ $card['accent'] }}">{{ $prog['completed'] }} / {{ $prog['total'] }} Selesai ({{ $prog['pct'] }}%)</span>
                                    </div>
                                    <div class="w-full h-2.5 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full {{ $card['barColor'] }} rounded-full transition-all duration-700"
                                             style="width: {{ $prog['pct'] }}%"></div>
                                    </div>
                                </div>

                                <a href="{{ route('materials.index', ['search' => $card['name']]) }}"
                                   class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-center border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center justify-center gap-1.5 group-hover:border-emerald-500">
                                    Pelajari Materi {{ $card['name'] }} →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ── 4. MISI PENJELAJAH & AKTIVITAS QUIZ ───────────────── -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Widget Misi Budaya Harian (Tantangan Gamifikasi) -->
                <div class="lg:col-span-1">
                    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-amber-500 to-yellow-600 p-6 text-white shadow-xl flex flex-col justify-between h-full border border-amber-400">
                        <div class="absolute -right-8 -top-8 w-36 h-36 rounded-full bg-white/20 blur-xl"></div>
                        <div class="relative">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black/20 text-yellow-100 text-xs font-black tracking-wide uppercase mb-4">
                                <span>🎯</span> Misi Budaya Hari Ini
                            </div>
                            <h3 class="text-2xl font-black leading-snug mb-2">Tuntaskan 1 Materi & Uji Pemahaman!</h3>
                            <p class="text-xs text-yellow-100 leading-relaxed mb-4">
                                Pelajari salah satu materi adat Kaltara dan raih skor kuis minimal 80 untuk mengklaim tambahan <strong class="underline font-black">+50 XP</strong> serta menjaga streak harianmu.
                            </p>
                        </div>

                        <div class="relative space-y-3 pt-4 border-t border-white/20">
                            <div class="flex items-center gap-3 bg-black/20 rounded-2xl p-3">
                                <div class="text-3xl">🏅</div>
                                <div class="text-xs">
                                    <p class="font-black text-white">Target Nilai Tinggi</p>
                                    <p class="text-yellow-200">Asah kemampuan berpikir analitis (HOTS)</p>
                                </div>
                            </div>

                            <a href="{{ route('materials.index') }}"
                               class="w-full py-3 px-4 rounded-xl bg-white text-yellow-900 font-extrabold text-sm text-center shadow-lg hover:bg-yellow-50 transition transform active:scale-95 block">
                                Mulai Misi Sekarang 🚀
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Hasil Quiz Terbaru -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 sm:p-7 h-full flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <h2 class="font-black text-gray-900 dark:text-white text-xl flex items-center gap-2">
                                    <span>📝</span> Hasil Quiz Terbaru
                                </h2>
                                <a href="{{ route('quizzes.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline text-xs font-extrabold uppercase tracking-wider">
                                    Semua Quiz →
                                </a>
                            </div>

                            @if($recentResults->isEmpty())
                                <div class="text-center py-12 px-4">
                                    <div class="w-16 h-16 rounded-full bg-emerald-50 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center text-3xl mx-auto mb-3">
                                        📚
                                    </div>
                                    <p class="text-base font-bold text-gray-800 dark:text-gray-200">Belum ada riwayat pengerjaan quiz</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 max-w-sm mx-auto">
                                        Buka materi pembelajaran dan selesaikan kuis pretest/posttest untuk melihat evaluasi kemampuanmu di sini.
                                    </p>
                                    <a href="{{ route('quizzes.index') }}" class="inline-block mt-4 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md transition">
                                        Kerjakan Quiz Sekarang
                                    </a>
                                </div>
                            @else
                                <div class="space-y-3.5">
                                    @foreach($recentResults as $result)
                                        @php $pct = $result->percentage; @endphp
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700 hover:border-emerald-300 transition">
                                            <!-- Nilai Lingkaran / Grade Badge -->
                                            <div class="shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center text-lg font-black shadow-inner
                                                {{ $pct >= 80 ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300' : ($pct >= 60 ? 'bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300' : 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300') }}">
                                                {{ $result->grade }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-extrabold text-gray-900 dark:text-white text-sm truncate">
                                                    {{ $result->quiz->title }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-1.5">
                                                    <div class="flex-1 h-2 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                                        <div class="h-full rounded-full {{ $pct >= 80 ? 'bg-emerald-500' : ($pct >= 60 ? 'bg-amber-500' : 'bg-red-500') }}"
                                                             style="width: {{ $pct }}%"></div>
                                                    </div>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400 shrink-0 font-bold font-mono">{{ $result->score }}/{{ $result->total_questions }} Soal</span>
                                                </div>
                                            </div>
                                            <div class="text-right shrink-0">
                                                <p class="text-lg font-black {{ $pct >= 80 ? 'text-emerald-600 dark:text-emerald-400' : ($pct >= 60 ? 'text-amber-600 dark:text-amber-400' : 'text-red-600 dark:text-red-400') }}">
                                                    {{ round($pct) }}%
                                                </p>
                                                <p class="text-[11px] text-gray-400 dark:text-gray-500">{{ $result->completed_at?->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 5. REKOMENDASI MATERI BERGAMBAR ───────────────────── -->
            @if($latestMaterials->isNotEmpty())
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>✨</span> Rekomendasi Materi Pembelajaran
                        </h2>
                        <a href="{{ route('materials.index') }}" class="text-xs font-bold text-emerald-600 hover:underline uppercase tracking-wider">
                            Jelajahi Bank Materi →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        @foreach($latestMaterials as $mat)
                            @php
                                $isDone = in_array($mat->id, $completedMaterialIds);
                            @endphp
                            <div class="rounded-3xl overflow-hidden bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                                <div class="relative h-40 overflow-hidden bg-gray-100 dark:bg-gray-700">
                                    @if($mat->image)
                                        <img src="{{ Str::startsWith($mat->image, 'http') ? $mat->image : asset('storage/' . $mat->image) }}"
                                             alt="{{ $mat->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             loading="lazy"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="w-full h-full hidden items-center justify-center text-4xl text-white"
                                             style="background: linear-gradient(135deg, #064e3b, #0f2d1f);">
                                            {{ $mat->category_icon ?? '🏛️' }}
                                        </div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-4xl text-white"
                                             style="background: linear-gradient(135deg, #064e3b, #0f2d1f);">
                                            {{ $mat->category_icon ?? '🏛️' }}
                                        </div>
                                    @endif

                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-black/60 backdrop-blur-md text-white">
                                            {{ ucfirst($mat->category) }}
                                        </span>
                                    </div>

                                    @if($isDone)
                                        <div class="absolute top-3 right-3 bg-emerald-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1 shadow">
                                            <span>✓</span> Selesai
                                        </div>
                                    @endif
                                </div>

                                <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                                    <div>
                                        <h3 class="font-extrabold text-gray-900 dark:text-white text-base leading-snug group-hover:text-emerald-600 transition-colors line-clamp-2">
                                            {{ $mat->title }}
                                        </h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mt-1.5 leading-relaxed">
                                            {{ $mat->description }}
                                        </p>
                                    </div>

                                    <a href="{{ route('materials.show', $mat->slug) }}"
                                       class="w-full py-2.5 px-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-bold text-xs text-center hover:bg-emerald-600 hover:text-white transition flex items-center justify-center gap-1">
                                        {{ $isDone ? 'Baca Ulang Materi' : 'Pelajari Sekarang' }} →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ── 6. BADGE KOLEKSI SISWA ────────────────────────────── -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 sm:p-7 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-black text-gray-900 dark:text-white text-xl flex items-center gap-2">
                        <span>🏅</span> Koleksi Badge Penjelajah
                    </h2>
                    <span class="text-xs font-bold text-gray-500 dark:text-gray-400">
                        {{ $earnedBadges->count() }} Badge Terkumpul
                    </span>
                </div>

                @if($earnedBadges->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-5xl mb-2">🔒</p>
                        <p class="text-sm font-bold text-gray-700 dark:text-gray-300">Belum ada badge yang terbuka</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Selesaikan materi pertamamu atau raih nilai sempurna di quiz untuk membuka badge!</p>
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3.5">
                        @foreach($earnedBadges as $badge)
                            <div class="bg-gradient-to-b from-amber-50 to-yellow-50 dark:from-yellow-950/20 dark:to-yellow-900/10 border-2 border-yellow-300/80 dark:border-yellow-600/50 rounded-2xl p-4 text-center hover:-translate-y-1 transition-all shadow-sm">
                                <p class="text-4xl mb-2">{{ $badge->icon }}</p>
                                <p class="text-xs font-black text-yellow-900 dark:text-yellow-300 leading-tight">{{ $badge->name }}</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-1 line-clamp-1">{{ $badge->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
