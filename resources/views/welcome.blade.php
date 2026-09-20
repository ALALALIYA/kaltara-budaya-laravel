<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaltara Budaya — Media Pembelajaran Seni Budaya Kalimantan Utara</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>document.documentElement.classList.add('js-loaded');</script>
</head>
<body class="font-sans antialiased bg-amber-50">

    {{-- ── NAVBAR ──────────────────────────────────────────────────── --}}
    <nav class="fixed top-0 inset-x-0 z-50 shadow-lg bg-canopy"
         style="border-bottom: 1px solid rgba(255,255,255,0.08);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-3xl float-slow" aria-hidden="true">🌿</span>
                <span class="text-white font-black text-lg">Kaltara <span class="text-yellow-400">Budaya</span></span>
            </a>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="btn-amber text-sm px-5 py-2 rounded-xl shadow">
                        Masuk Dashboard →
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-green-100 hover:text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn-amber text-sm px-5 py-2 rounded-xl shadow">
                        Daftar Gratis
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ── HERO ─────────────────────────────────────────────────────── --}}
    <section class="relative min-h-screen flex items-center pt-16"
             style="background: linear-gradient(135deg, #1a4731 0%, #0f2d1f 40%, #7c2d12 80%, #92400e 100%);">

        <!-- Decorative circles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
            <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full opacity-10"
                 style="background: radial-gradient(circle, #fbbf24, transparent)"></div>
            <div class="absolute bottom-0 -left-10 w-72 h-72 rounded-full opacity-10"
                 style="background: radial-gradient(circle, #f97316, transparent)"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Text -->
            <div class="reveal">
                <div class="inline-flex items-center gap-2 bg-yellow-400/20 border border-yellow-400/30 text-yellow-300 text-sm font-bold px-4 py-2 rounded-full mb-6">
                    🏫 Media Pembelajaran SMA Seni Budaya
                </div>
                <h1 class="text-4xl sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl font-black text-white leading-tight mb-6">
                    Jelajahi Budaya
                    <span class="block text-yellow-400">Kalimantan Utara</span>
                </h1>
                <p class="text-green-100 text-lg leading-relaxed mb-8 max-w-lg">
                    Platform pembelajaran interaktif untuk mengenal kekayaan seni dan budaya
                    Kalimantan Utara — dari Suku Dayak, Banjar, Kutai, hingga Tidung.
                    Belajar sambil bermain, ujian terstruktur, dan raih XP!
                </p>
                <div class="flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-8 py-4 font-extrabold text-green-900 rounded-2xl text-base shadow-xl transition hover:scale-105"
                           style="background: linear-gradient(90deg, #fbbf24, #f97316);">
                            Masuk Dashboard →
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="px-8 py-4 font-extrabold text-green-900 rounded-2xl text-base shadow-xl transition hover:scale-105"
                           style="background: linear-gradient(90deg, #fbbf24, #f97316);">
                            Mulai Belajar Gratis 🚀
                        </a>
                        <a href="{{ route('login') }}"
                           class="px-8 py-4 font-bold text-white border-2 border-white/30 rounded-2xl text-base hover:bg-white/10 transition">
                            Sudah Punya Akun
                        </a>
                    @endauth
                </div>
                <!-- Stats -->
                <div class="flex flex-wrap gap-6 mt-10">
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-400">10+</p>
                        <p class="text-green-200 text-sm">Materi Budaya</p>
                    </div>
                    <div class="hidden sm:block self-stretch w-px bg-white/20" aria-hidden="true"></div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-400">4</p>
                        <p class="text-green-200 text-sm">Suku Kaltara</p>
                    </div>
                    <div class="hidden sm:block self-stretch w-px bg-white/20" aria-hidden="true"></div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-400">3</p>
                        <p class="text-green-200 text-sm">Jenis Ujian</p>
                    </div>
                    <div class="hidden sm:block self-stretch w-px bg-white/20" aria-hidden="true"></div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-400">XP</p>
                        <p class="text-green-200 text-sm">Sistem Poin</p>
                    </div>
                </div>
            </div>

            <!-- Visual card -->
            <div class="reveal-right hidden md:block">
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['🦅', 'Dayak', 'Tari Hudoq & Mandau', 'from-amber-700 to-orange-800'],
                        ['🎋', 'Banjar', 'Musik Panting', 'from-green-600 to-emerald-700'],
                        ['🐉', 'Kutai', 'Tari Jepen', 'from-red-700 to-rose-800'],
                        ['🌊', 'Tidung', 'Iraw Tengkayu', 'from-blue-700 to-indigo-800'],
                    ] as $suku)
                        <div class="bg-gradient-to-br {{ $suku[3] }} rounded-2xl p-5 text-white shadow-lg hover:scale-105 transition cursor-default">
                            <div class="text-4xl mb-2">{{ $suku[0] }}</div>
                            <p class="font-extrabold text-lg">{{ $suku[1] }}</p>
                            <p class="text-white/70 text-sm">{{ $suku[2] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Wave -->
        <div class="absolute bottom-0 inset-x-0" aria-hidden="true">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M0 60L60 50C120 40 240 20 360 15C480 10 600 20 720 25C840 30 960 30 1080 25C1200 20 1320 10 1380 5L1440 0V60H0Z" fill="#fffbeb"/>
            </svg>
        </div>
    </section>

    {{-- ── FITUR UNGGULAN ───────────────────────────────────────────── --}}
    <section class="py-20 bg-amber-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">Kenapa <span class="text-orange-600">Kaltara Budaya</span>?</h2>
                <p class="text-gray-700 mt-3 text-lg max-w-xl mx-auto">Dirancang khusus untuk siswa SMA dengan pendekatan multimedia yang menyenangkan.</p>
            </div>
            <!-- Bento feature grid: hero card + tall motivator + 3 equal + teacher strip -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Featured: Materi — spans 2 cols, horizontal layout with culture pills -->
                <div class="reveal lg:col-span-2 bg-gradient-to-br from-amber-50 to-orange-100 border border-orange-200 rounded-2xl p-7 card-lift">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                        <div class="text-5xl shrink-0">📖</div>
                        <div>
                            <h3 class="font-extrabold text-gray-900 text-xl mb-2">Materi Lengkap & Kaya</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">Konten teks, gambar, dan video tentang seni budaya Kaltara yang disajikan secara menarik dan mudah dipahami.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="pill-dayak text-xs font-bold px-3 py-1 rounded-full">🦅 Suku Dayak</span>
                                <span class="pill-banjar text-xs font-bold px-3 py-1 rounded-full">🎋 Suku Banjar</span>
                                <span class="pill-kutai text-xs font-bold px-3 py-1 rounded-full">🐉 Suku Kutai</span>
                                <span class="pill-tidung text-xs font-bold px-3 py-1 rounded-full">🌊 Suku Tidung</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- XP & Gamifikasi — tall motivational card -->
                <div class="reveal bg-gradient-to-b from-yellow-50 to-amber-100 border border-yellow-200 rounded-2xl p-6 card-lift flex flex-col">
                    <div class="text-5xl mb-3">⚡</div>
                    <h3 class="font-extrabold text-gray-900 text-lg mb-2">Sistem XP & Gamifikasi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed flex-1 mb-4">Dapatkan poin XP setiap menyelesaikan materi dan lulus ujian. Pantau kemajuanmu di dashboard.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs font-bold bg-yellow-200 text-yellow-800 px-2.5 py-1 rounded-full">⚡ XP</span>
                        <span class="text-xs font-bold bg-orange-100 text-orange-700 px-2.5 py-1 rounded-full">🔥 Streak</span>
                        <span class="text-xs font-bold bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full">🏅 Badge</span>
                    </div>
                </div>

                <!-- 3 supporting cards — equal weight -->
                <div class="reveal bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 card-lift">
                    <div class="text-4xl mb-3">🧠</div>
                    <h3 class="font-extrabold text-gray-900 text-base mb-2">Pretest & Posttest</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Ukur pemahamanmu sebelum dan sesudah belajar. Posttest minimal 70% untuk tandai materi selesai.</p>
                </div>

                <div class="reveal bg-gradient-to-br from-red-50 to-rose-50 border border-red-200 rounded-2xl p-6 card-lift">
                    <div class="text-4xl mb-3">🏆</div>
                    <h3 class="font-extrabold text-gray-900 text-base mb-2">Ujian Kompetensi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Ujian Harian, UTS, dan UAS dengan timer. UTS/UAS terkunci sampai kamu lulus ujian sebelumnya.</p>
                </div>

                <div class="reveal bg-gradient-to-br from-teal-50 to-cyan-50 border border-teal-200 rounded-2xl p-6 card-lift">
                    <div class="text-4xl mb-3">🎮</div>
                    <h3 class="font-extrabold text-gray-900 text-base mb-2">Mini Game Budaya</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Belajar sambil bermain dengan game interaktif bertema budaya Kalimantan Utara yang seru.</p>
                </div>

            </div>

            <!-- Teacher feature — strip, not a card (different audience) -->
            <div class="reveal mt-5 flex items-center gap-4 bg-blue-50 border border-blue-200 rounded-xl px-6 py-4">
                <span class="text-2xl shrink-0">📊</span>
                <div>
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wide mb-0.5">Untuk Guru &amp; Pengajar</p>
                    <p class="text-gray-700 text-sm">Pantau nilai pretest vs posttest setiap siswa secara real-time dan ukur efektivitas pembelajaran.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── 4 SUKU KALTARA ───────────────────────────────────────────── --}}
    <section class="py-20" style="background: linear-gradient(135deg, #1a4731 0%, #0f2d1f 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Empat Suku Utama <span class="text-yellow-400">Kalimantan Utara</span></h2>
                <p class="text-green-200 mt-3 text-lg max-w-xl mx-auto">Setiap suku memiliki keunikan budaya, seni, dan tradisi yang luar biasa kaya.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach([
                    ['🦅', 'Dayak', 'Tari Hudoq, Mandau, Ukiran Kayu', '#7c2d12', '#dc2626'],
                    ['🎋', 'Banjar', 'Musik Panting, Sasirangan, Kuliner', '#14532d', '#16a34a'],
                    ['🐉', 'Kutai', 'Tari Jepen, Gambus, Tenun', '#1e3a5f', '#2563eb'],
                    ['🌊', 'Tidung', 'Iraw Tengkayu, Tari Garay, Perahu Hias', '#312e81', '#7c3aed'],
                ] as $suku)
                    <div class="reveal-scale rounded-2xl p-6 text-white text-center card-lift"
                         style="background: linear-gradient(135deg, {{ $suku[3] }}, {{ $suku[4] }});">
                        <div class="text-6xl mb-4">{{ $suku[0] }}</div>
                        <h3 class="text-2xl font-extrabold mb-2">Suku {{ $suku[1] }}</h3>
                        <p class="text-white/70 text-sm">{{ $suku[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── ALUR BELAJAR ─────────────────────────────────────────────── --}}
    <section class="py-28 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">Alur Belajar yang <span class="text-orange-600">Terstruktur</span></h2>
            </div>
            <div class="relative">
                <!-- Line -->
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-amber-400 to-orange-600 transform -translate-x-1/2"></div>
                <div class="space-y-10">
                    @foreach([
                        ['1', '📋', 'Kerjakan Pretest', 'Ukur pengetahuan awalmu sebelum membaca materi. Tidak ada nilai minimum — ini hanya baseline.', 'left'],
                        ['2', '📖', 'Baca Materi', 'Pelajari konten lengkap: teks, gambar, dan video embed YouTube tentang budaya Kaltara.', 'right'],
                        ['3', '✅', 'Posttest (Min 70%)', 'Setelah baca, kerjakan posttest. Perlu minimal 70% untuk lulus dan tandai materi selesai.', 'left'],
                        ['4', '⚡', 'Dapat XP', 'Materi selesai = XP masuk ke akunmu. Kumpulkan XP sebanyak mungkin!', 'right'],
                        ['5', '🏆', 'Ujian Kompetensi', 'Ikuti Ujian Harian → UTS → UAS secara bertahap dengan timer dan sistem nilai.', 'left'],
                    ] as $step)
                        <div class="reveal flex md:items-center gap-6 {{ $step[4] === 'right' ? 'md:flex-row-reverse' : '' }}">
                            <div class="md:w-1/2 {{ $step[4] === 'right' ? 'md:text-right' : '' }}">
                                <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-orange-200 rounded-2xl p-5">
                                    <div class="text-3xl mb-2">{{ $step[1] }}</div>
                                    <h3 class="font-extrabold text-gray-900 text-lg">{{ $step[0] }}. {{ $step[2] }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ $step[3] }}</p>
                                </div>
                            </div>
                            <div class="hidden md:flex w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 items-center justify-center text-white font-extrabold text-lg shadow-lg shrink-0 z-10">
                                {{ $step[0] }}
                            </div>
                            <div class="md:w-1/2"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA ──────────────────────────────────────────────────────── --}}
    <section class="py-20"
             style="background: linear-gradient(135deg, #7c2d12 0%, #b45309 50%, #92400e 100%);">
        <div class="max-w-3xl mx-auto px-4 text-center reveal">
            <div class="text-6xl mb-4 float-slow" aria-hidden="true">🌿</div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
                Siap Menjelajahi Budaya Kalimantan Utara?
            </h2>
            <p class="text-orange-100 text-lg mb-8">
                Bergabunglah sekarang, belajar gratis, dan buktikan pemahamanmu tentang kekayaan budaya Kaltara!
            </p>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-block px-10 py-4 font-extrabold text-green-900 rounded-2xl text-lg shadow-2xl hover:scale-105 transition"
                   style="background: linear-gradient(90deg, #fbbf24, #f97316);">
                    Buka Dashboard →
                </a>
            @else
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('register') }}"
                       class="inline-block px-10 py-4 font-extrabold text-green-900 rounded-2xl text-lg shadow-2xl hover:scale-105 transition"
                       style="background: linear-gradient(90deg, #fbbf24, #f97316);">
                        Daftar Sekarang — Gratis! 🚀
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-block px-8 py-4 font-bold text-white border-2 border-white/40 rounded-2xl text-lg hover:bg-white/10 transition">
                        Sudah Punya Akun
                    </a>
                </div>
            @endauth
        </div>
    </section>

    {{-- ── FOOTER ───────────────────────────────────────────────────── --}}
    <footer style="background: linear-gradient(135deg, #0f2d1f 0%, #1a4731 100%);" class="pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl">🌿</span>
                        <span class="text-white font-black text-xl">Kaltara <span class="text-yellow-400">Budaya</span></span>
                    </div>
                    <p class="text-green-300 text-sm leading-relaxed">Media pembelajaran Seni Budaya Kalimantan Utara berbasis multimedia untuk siswa SMA. Dikembangkan menggunakan metode MDLC.</p>
                </div>
                <div>
                    <h4 class="text-yellow-400 font-extrabold mb-4">Empat Suku Kaltara</h4>
                    <ul class="space-y-2 text-green-300 text-sm">
                        <li>🦅 Suku Dayak — Tari Hudoq, Mandau</li>
                        <li>🎋 Suku Banjar — Musik Panting</li>
                        <li>🐉 Suku Kutai — Tari Jepen</li>
                        <li>🌊 Suku Tidung — Iraw Tengkayu</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-yellow-400 font-extrabold mb-4">Fitur Platform</h4>
                    <ul class="space-y-2 text-green-300 text-sm">
                        <li>📖 10+ Materi Budaya</li>
                        <li>🧠 Pretest & Posttest</li>
                        <li>🏆 Ujian Harian, UTS, UAS</li>
                        <li>⚡ Sistem XP & Gamifikasi</li>
                        <li>🎮 Mini Game Interaktif</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-green-800 pt-6 text-center text-green-500 text-sm">
                <p>© {{ date('Y') }} Kaltara Budaya — Media Pembelajaran Seni Budaya Kalimantan Utara</p>
            </div>
        </div>
    </footer>

    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal, .reveal-right, .reveal-scale').forEach(el => observer.observe(el));
    </script>
</body>
</html>
