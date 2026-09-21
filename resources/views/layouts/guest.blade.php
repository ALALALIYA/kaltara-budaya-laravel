<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kaltara Budaya') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen flex">

        {{-- ── PANEL KIRI — branding Kaltara (hanya desktop lg+) ─── --}}
        <div class="hidden lg:flex lg:w-5/12 xl:w-[46%] relative flex-col justify-between p-12 bg-green-900 overflow-hidden select-none">

            {{-- Motif latar (sangat transparan) --}}
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <span class="absolute top-8  left-6  text-[11rem] leading-none opacity-[0.04]">🦅</span>
                <span class="absolute bottom-8 right-6 text-[9rem] leading-none opacity-[0.04]">🌊</span>
                <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[8rem] leading-none opacity-[0.03]">🐉</span>
            </div>

            {{-- Elemen dekoratif melayang --}}
            <div class="absolute top-24  right-14 text-4xl opacity-50 animate-float"       aria-hidden="true">🌿</div>
            <div class="absolute bottom-36 left-10 text-3xl opacity-40 animate-float-slow"  aria-hidden="true">🎋</div>
            <div class="absolute top-2/5  right-8  text-2xl opacity-35 animate-float-delay" aria-hidden="true">⭐</div>
            <div class="absolute bottom-20 right-20 text-3xl opacity-30 animate-float-delay-2" aria-hidden="true">🌺</div>

            {{-- Logo + nama aplikasi --}}
            <div class="relative z-10 animate-fade-in">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <span class="text-yellow-400 text-3xl group-hover:animate-wiggle transition">🌿</span>
                    <span class="text-white font-extrabold text-2xl tracking-tight">
                        Kaltara <span class="text-yellow-400">Budaya</span>
                    </span>
                </a>
            </div>

            {{-- Tagline utama --}}
            <div class="relative z-10 space-y-5 animate-fade-in-up-200">
                <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                    Jelajahi Kekayaan<br>
                    <span class="text-yellow-400">Budaya Kalimantan</span><br>
                    <span class="text-green-300">Utara</span>
                </h1>

                <p class="text-green-200 text-lg leading-relaxed max-w-sm">
                    Belajar seni budaya 4 suku besar — Dayak, Banjar, Kutai, dan Tidung — dengan cara yang
                    <strong class="text-white">seru, interaktif, dan penuh tantangan</strong>.
                </p>

                {{-- Feature highlights --}}
                <div class="space-y-3 pt-2">
                    <div class="flex items-center gap-3 text-green-200 text-sm">
                        <span class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center text-xs font-bold text-yellow-400 shrink-0">✓</span>
                        <span>Materi lengkap 4 suku Kalimantan Utara</span>
                    </div>
                    <div class="flex items-center gap-3 text-green-200 text-sm">
                        <span class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center text-xs font-bold text-yellow-400 shrink-0">✓</span>
                        <span>Quiz interaktif & mini game seru</span>
                    </div>
                    <div class="flex items-center gap-3 text-green-200 text-sm">
                        <span class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center text-xs font-bold text-yellow-400 shrink-0">✓</span>
                        <span>Kumpulkan XP, streak, dan badge eksklusif</span>
                    </div>
                </div>
            </div>

            {{-- Stats bawah --}}
            <div class="relative z-10 grid grid-cols-3 gap-4 animate-fade-in-up-400">
                <div class="text-center">
                    <p class="text-3xl font-extrabold text-yellow-400">4</p>
                    <p class="text-green-400 text-xs mt-0.5">Suku Budaya</p>
                </div>
                <div class="text-center border-x border-green-700/60">
                    <p class="text-3xl font-extrabold text-yellow-400">10+</p>
                    <p class="text-green-400 text-xs mt-0.5">Materi</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-extrabold text-yellow-400">5</p>
                    <p class="text-green-400 text-xs mt-0.5">Badge</p>
                </div>
            </div>
        </div>

        {{-- ── PANEL KANAN — form autentikasi ────────────────────── --}}
        <div class="flex-1 flex flex-col justify-center items-center
                    px-6 py-10 sm:px-10
                    bg-gray-50 dark:bg-gray-900
                    min-h-screen overflow-y-auto">

            {{-- Logo mobile (hanya tampil di bawah lg) --}}
            <div class="lg:hidden mb-8 text-center animate-fade-in">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                    <span class="text-green-700 dark:text-green-400 text-3xl">🌿</span>
                    <span class="font-extrabold text-2xl text-gray-900 dark:text-white">
                        Kaltara <span class="text-green-700 dark:text-green-400">Budaya</span>
                    </span>
                </a>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Media Pembelajaran Seni Budaya Kaltara</p>
            </div>

            {{-- Konten slot (form login / register / dll) --}}
            <div class="w-full max-w-md animate-scale-in">
                {{ $slot }}
            </div>

            {{-- Footer kecil --}}
            <p class="mt-8 text-center text-xs text-gray-400 dark:text-gray-600">
                &copy; {{ date('Y') }} Kaltara Budaya — Media Pembelajaran MDLC
            </p>
        </div>

    </div>

</body>
</html>
