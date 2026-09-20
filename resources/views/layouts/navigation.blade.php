<nav x-data="{ open: false, more: false }" aria-label="Navigasi utama" class="sticky top-0 z-50 shadow-lg bg-canopy"
     style="border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo + Desktop Nav -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center gap-2 mr-6">
                    <span class="text-3xl float-slow" aria-hidden="true">🌿</span>
                    <div class="hidden sm:block">
                        <span class="text-white font-black text-lg tracking-tight">Kaltara</span>
                        <span class="text-yellow-400 font-black text-lg tracking-tight ml-1">Budaya</span>
                    </div>
                </a>

                <div class="hidden sm:flex items-center gap-0.5">
                    @auth
                        @if(Auth::user()->isTeacherOrAdmin())

                            {{-- ── Teacher primary nav (3 items) ── --}}
                            <a href="{{ route('teacher.dashboard') }}"
                               class="px-3 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('teacher.dashboard') ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                🏠 Dashboard
                            </a>
                            <a href="{{ route('teacher.materials.index') }}"
                               class="px-3 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('teacher.materials.*') ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                📚 Materi
                            </a>
                            <a href="{{ route('teacher.quizzes.index') }}"
                               class="px-3 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('teacher.quizzes.*') ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                🧠 Quiz
                            </a>

                            {{-- ── Teacher "Lainnya" dropdown ── --}}
                            @php $teacherMoreActive = request()->routeIs('teacher.students.*', 'teacher.reports.*', 'teacher.questionnaire.*', 'admin.users.*', 'about'); @endphp
                            <div class="relative">
                                <button @click="more = !more" @keydown.escape.window="more = false"
                                        :aria-expanded="more.toString()" aria-haspopup="true"
                                        class="px-3 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-1 {{ $teacherMoreActive ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                    Lainnya
                                    <svg class="h-3.5 w-3.5 fill-current opacity-60 transition-transform duration-150"
                                         :class="{ 'rotate-180': more }" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div x-show="more" @click.outside="more = false"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                     class="absolute top-full left-0 mt-1.5 w-52 rounded-xl shadow-2xl border border-white/10 py-1.5 z-50"
                                     style="background: rgba(10,22,14,0.98); backdrop-filter: blur(12px);">
                                    <a href="{{ route('teacher.students.index') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('teacher.students.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        👥 Data Siswa
                                    </a>
                                    <a href="{{ route('teacher.reports.index') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('teacher.reports.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        📊 Laporan Nilai
                                    </a>

                                    <a href="{{ route('teacher.projects.index') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('teacher.projects.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        🎨 Proyek Akhir
                                    </a>
                                    <a href="{{ route('admin.users.index') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        ⚙️ Kelola Akun
                                    </a>
                                    <div class="border-t border-white/10 my-1" aria-hidden="true"></div>
                                    <a href="{{ route('about') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        ℹ️ Tentang
                                    </a>
                                </div>
                            </div>

                        @else

                            {{-- ── Student primary nav (3 items) ── --}}
                            <a href="{{ route('dashboard') }}"
                               class="px-3 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('dashboard') ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                🏠 Dashboard
                            </a>
                            <a href="{{ route('materials.index') }}"
                               class="px-3 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('materials.*') ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                📖 Materi
                            </a>
                            <a href="{{ route('quizzes.index') }}"
                               class="px-3 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('quizzes.*') ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                🧠 Latihan
                            </a>

                            {{-- ── Student "Lainnya" dropdown ── --}}
                            @php $studentMoreActive = request()->routeIs('exams.*', 'games.*', 'questionnaire.*', 'about'); @endphp
                            <div class="relative">
                                <button @click="more = !more" @keydown.escape.window="more = false"
                                        :aria-expanded="more.toString()" aria-haspopup="true"
                                        class="px-3 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-1 {{ $studentMoreActive ? 'bg-white/20 text-yellow-400' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                    Lainnya
                                    <svg class="h-3.5 w-3.5 fill-current opacity-60 transition-transform duration-150"
                                         :class="{ 'rotate-180': more }" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div x-show="more" @click.outside="more = false"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                     class="absolute top-full left-0 mt-1.5 w-52 rounded-xl shadow-2xl border border-white/10 py-1.5 z-50"
                                     style="background: rgba(10,22,14,0.98); backdrop-filter: blur(12px);">
                                    <a href="{{ route('exams.index') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('exams.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        🏆 Ujian Kompetensi
                                    </a>
                                    <a href="{{ route('games.matching') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('games.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        🎮 Mini Game
                                    </a>

                                    <a href="{{ route('projects.index') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('projects.*') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        🎨 Proyek Akhir
                                    </a>
                                    <div class="border-t border-white/10 my-1" aria-hidden="true"></div>
                                    <a href="{{ route('about') }}" @click="more = false"
                                       class="flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-yellow-400 bg-white/10' : 'text-green-100 hover:bg-white/10 hover:text-white' }}">
                                        ℹ️ Tentang
                                    </a>
                                </div>
                            </div>

                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right side: XP/streak pill · dark toggle · avatar -->
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    @if(Auth::user()->isStudent())
                        <div class="flex items-center gap-2 bg-white/10 border border-white/15 rounded-full px-3 py-1.5">
                            <span class="text-yellow-400 font-bold text-sm">⚡ {{ number_format(Auth::user()->xp) }} XP</span>
                            @if(Auth::user()->streak > 0)
                                <span class="text-orange-400 font-bold text-sm border-l border-white/20 pl-2">🔥 {{ Auth::user()->streak }}</span>
                            @endif
                        </div>
                    @elseif(Auth::user()->isTeacherOrAdmin())
                        <span class="text-xs bg-yellow-500 text-green-900 font-black rounded-full px-3 py-1 uppercase tracking-wide">👩‍🏫 GURU</span>
                    @endif

                    <!-- Dark/Light toggle -->
                    <button @click="$store.theme.toggle()"
                            class="w-9 h-9 flex items-center justify-center rounded-lg text-green-200 hover:bg-white/10 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-yellow-400 focus-visible:outline-offset-2"
                            :aria-label="$store.theme.dark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'"
                            :title="$store.theme.dark ? 'Mode Terang' : 'Mode Gelap'">
                        <span x-show="!$store.theme.dark" class="text-lg" aria-hidden="true">🌙</span>
                        <span x-show="$store.theme.dark" class="text-lg" aria-hidden="true">☀️</span>
                    </button>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-1.5 text-green-100 hover:text-white text-sm font-semibold rounded-lg px-3 py-2 hover:bg-white/10 transition">
                                <span class="w-7 h-7 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center text-white font-bold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span class="hidden md:block">{{ Auth::user()->name }}</span>
                                <svg class="h-3.5 w-3.5 fill-current opacity-60" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                <p class="text-xs font-bold mt-0.5 {{ Auth::user()->isTeacherOrAdmin() ? 'text-yellow-600' : 'text-green-600' }}">
                                    {{ Auth::user()->isTeacherOrAdmin() ? '👩‍🏫 Guru' : '🎓 Siswa' }}
                                </p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">
                                ⚙️ Profil Saya
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    🚪 Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        :aria-expanded="open.toString()"
                        aria-controls="mobile-menu"
                        aria-label="Buka menu navigasi"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-green-300 hover:text-white hover:bg-white/10 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-yellow-400 focus-visible:outline-offset-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu — all items still accessible, no change in structure -->
    <div id="mobile-menu" :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-white/10"
         style="background: rgba(15,29,20,0.98); backdrop-filter: blur(12px);">
        <div class="pt-2 pb-3 space-y-0.5 px-4">
            @auth
                @if(Auth::user()->isTeacherOrAdmin())
                    <a href="{{ route('teacher.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🏠 Dashboard Guru</a>
                    <a href="{{ route('teacher.materials.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">📚 Materi Saya</a>
                    <a href="{{ route('teacher.quizzes.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🧠 Quiz Saya</a>
                    <a href="{{ route('teacher.students.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">👥 Data Siswa</a>
                    <a href="{{ route('teacher.reports.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">📊 Laporan Nilai</a>

                    <a href="{{ route('teacher.projects.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🎨 Proyek Akhir</a>
                    <a href="{{ route('admin.users.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">⚙️ Kelola Akun</a>
                @else
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🏠 Dashboard</a>
                    <a href="{{ route('materials.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">📖 Materi</a>
                    <a href="{{ route('quizzes.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🧠 Latihan Soal</a>
                    <a href="{{ route('exams.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🏆 Ujian Kompetensi</a>
                    <a href="{{ route('games.matching') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🎮 Mini Game</a>

                    <a href="{{ route('projects.index') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">🎨 Proyek Akhir</a>
                @endif
                <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm font-medium">ℹ️ Tentang Media</a>
            @endauth
        </div>

        <div class="border-t border-white/10 pt-4 pb-4 px-4">
            @auth
                <div class="flex items-center gap-3 px-1 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center text-white font-extrabold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-green-300 text-xs">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->isStudent())
                            <p class="text-yellow-400 text-xs font-bold mt-0.5">⚡ {{ Auth::user()->xp }} XP · 🔥 {{ Auth::user()->streak }} hari</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm">⚙️ Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2.5 rounded-lg text-green-100 hover:bg-white/10 text-sm">🚪 Keluar</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
