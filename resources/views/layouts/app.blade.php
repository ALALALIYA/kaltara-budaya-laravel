<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data x-bind:class="{ 'dark': $store.theme.dark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="view-transition" content="same-origin" />

        <title>{{ isset($title) ? $title . ' — Kaltara Budaya' : 'Kaltara Budaya | Belajar Seni Budaya Kalimantan Utara' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Dark mode init + JS-availability flag — must run before Alpine boots to avoid FOUC -->
        <script>
            document.documentElement.classList.add('js-loaded');
            document.addEventListener('alpine:init', () => {
                Alpine.store('theme', {
                    dark: localStorage.getItem('kaltara-theme') === 'dark',
                    toggle() {
                        this.dark = !this.dark;
                        localStorage.setItem('kaltara-theme', this.dark ? 'dark' : 'light');
                    }
                });
            });
        </script>
    </head>
    <body class="font-sans antialiased bg-amber-50 dark:bg-gray-950 flex flex-col min-h-screen">

        <!-- Skip to main content — screen reader + keyboard-only users -->
        <a href="#main-content"
           class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[9999] focus:px-4 focus:py-2 focus:bg-yellow-400 focus:text-green-900 focus:font-bold focus:rounded-lg focus:shadow-lg focus:outline-none">
            Lewati ke konten utama
        </a>

        @include('layouts.navigation')

        <!-- Flash Messages -->
        @if (session('success') || session('error') || session('info') || session('warning'))
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4 space-y-2 z-10 relative">
                @if (session('success'))
                    <div class="flex items-start gap-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 px-4 py-3 rounded-xl shadow-sm animate-fade-in-up" role="alert" aria-live="polite">
                        <span class="text-green-600 dark:text-green-400 mt-0.5 shrink-0" aria-hidden="true">✓</span>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="flex items-start gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 px-4 py-3 rounded-xl shadow-sm animate-fade-in-up" role="alert" aria-live="assertive">
                        <span class="text-red-600 dark:text-red-400 mt-0.5 shrink-0" aria-hidden="true">✕</span>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('info'))
                    <div class="flex items-start gap-3 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 text-blue-800 dark:text-blue-300 px-4 py-3 rounded-xl shadow-sm animate-fade-in-up" role="status" aria-live="polite">
                        <span class="text-blue-600 dark:text-blue-400 mt-0.5 shrink-0" aria-hidden="true">ℹ</span>
                        <p class="text-sm font-medium">{{ session('info') }}</p>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="flex items-start gap-3 bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700 text-yellow-800 dark:text-yellow-300 px-4 py-3 rounded-xl shadow-sm animate-fade-in-up" role="alert" aria-live="polite">
                        <span class="text-yellow-600 dark:text-yellow-400 mt-0.5 shrink-0" aria-hidden="true">⚠</span>
                        <p class="text-sm font-medium">{{ session('warning') }}</p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Page Content -->
        <main id="main-content" class="flex-1 transition-all duration-300 ease-out opacity-0 translate-y-2"
              x-data x-init="setTimeout(() => { $el.classList.remove('opacity-0', 'translate-y-2') }, 10)">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="mt-auto bg-canopy">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-b border-green-800 pb-5">
                    <div class="md:col-span-1">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xl">🌿</span>
                            <span class="text-lg font-bold text-white tracking-tight">Kaltara Budaya</span>
                        </div>
                        <p class="text-green-100 text-xs leading-relaxed max-w-xs">
                            Media pembelajaran interaktif Seni Budaya Kalimantan Utara untuk siswa SMA.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm mb-3">🗺️ 4 Suku Utama</h4>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center gap-2 text-sm">
                                <span>🦅</span><span class="text-gray-200">Suku Dayak</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span>🎋</span><span class="text-gray-200">Suku Banjar</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span>🐉</span><span class="text-gray-200">Suku Kutai</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span>🌊</span><span class="text-gray-200">Suku Tidung</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm mb-3">🎓 Fitur Utama</h4>
                        <ul class="space-y-1 text-sm text-green-100">
                            <li>📖 Materi Interaktif</li>
                            <li>🧠 Pramateri & Pascamateri (Kuis)</li>
                            <li>🏆 Ujian Harian / UTS / UAS</li>
                            <li>🎮 Mini Games Budaya</li>
                        </ul>
                    </div>
                </div>
                <div class="pt-5 text-center">
                    <p class="text-green-200 text-xs">
                        Media Pembelajaran Seni Budaya Kalimantan Utara &copy; {{ date('Y') }} — Pengembangan MDLC
                    </p>
                </div>
            </div>
        </footer>

        <!-- Scroll Reveal Observer -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
                if (!revealEls.length) return;
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
                }, { threshold: 0.1 });
                revealEls.forEach(el => io.observe(el));
            });
        </script>

    </body>
</html>
