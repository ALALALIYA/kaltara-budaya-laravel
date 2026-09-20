<x-app-layout>
    <x-slot name="title">{{ $material->title }}</x-slot>

    <div class="py-8 bg-amber-50 dark:bg-gray-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Navigasi Atas & Breadcrumb -->
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('materials.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-amber-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-bold rounded-2xl border border-amber-200/80 dark:border-gray-700 shadow-sm hover:border-amber-400 hover:shadow-md transition-all group">
                    <span class="text-base group-hover:-translate-x-1 transition-transform">←</span>
                    <span>Kembali ke Daftar Materi</span>
                </a>

                <nav class="hidden sm:flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <a href="{{ route('materials.index') }}" class="hover:text-amber-600 transition-colors font-medium">📚 Katalog</a>
                    <span>/</span>
                    <span class="text-gray-700 dark:text-gray-300 font-semibold truncate max-w-[200px]">{{ $material->title }}</span>
                </nav>
            </div>

            <!-- Card Utama -->
            <article class="bg-white dark:bg-gray-800 rounded-3xl shadow-md border border-amber-100 dark:border-gray-700 overflow-hidden">

                <!-- Hero Gambar / Gradasi -->
                @php
                    $heroClass = match($material->category) {
                        'dayak'  => 'from-green-700 to-green-950',
                        'banjar' => 'from-amber-600 to-amber-950',
                        'kutai'  => 'from-red-700 to-red-950',
                        'tidung' => 'from-blue-700 to-blue-950',
                        default  => 'from-purple-700 to-purple-950',
                    };
                @endphp
                <div class="relative h-52 sm:h-72 bg-gradient-to-br {{ $heroClass }}">
                    @if($material->image && str_starts_with($material->image, 'http'))
                        <img src="{{ $material->image }}" alt="{{ $material->title }}"
                             class="w-full h-full object-cover mix-blend-overlay opacity-50">
                    @elseif($material->image)
                        <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}"
                             class="w-full h-full object-cover absolute inset-0">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6 text-white">
                        @if($material->category)
                            <span class="text-xs font-bold bg-white/20 backdrop-blur px-3 py-1 rounded-full uppercase tracking-wide mb-2 inline-block">
                                {{ $material->category_icon }} {{ $material->category_label }}
                            </span>
                        @endif
                        <h1 class="text-2xl sm:text-3xl font-extrabold leading-tight drop-shadow-lg">
                            {{ $material->title }}
                        </h1>
                    </div>
                    @if($progress->isCompleted())
                        <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            ✅ Selesai
                        </div>
                    @endif
                </div>

                <!-- Konten -->
                <div class="p-6 sm:p-8">

<!-- Progress Stepper: Pretest → Baca Materi → Posttest -->
                    @if($pretest || $posttest)
                        @php
                            $pretestDone   = $pretestResult !== null;
                            $posttestDone  = $progress->isCompleted();
                            $readingActive = $pretestDone && !$posttestDone;
                        @endphp
                        <div class="mb-7 bg-gray-50 dark:bg-gray-700/40 rounded-2xl px-4 py-4 border border-gray-200 dark:border-gray-600">
                            <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Progres Belajar</p>
                            <div class="flex items-center gap-1 sm:gap-2">

                                {{-- Step 1: Pretest (SEKARANG BISA DIKLIK) --}}
                                @if($pretest)
                                    <div class="flex flex-col items-center flex-1">
                                        <a href="{{ route('materials.pretest', $material->slug) }}" 
                                           title="Klik untuk melihat soal Pretest"
                                           class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shadow-md hover:scale-110 transition-transform
                                            {{ $pretestDone ? 'bg-green-500 text-white' : 'bg-blue-500 text-white animate-pulse hover:bg-blue-600' }}">
                                            {{ $pretestDone ? '✓' : '1' }}
                                        </a>
                                        <p class="text-xs font-semibold mt-1 text-center leading-tight
                                            {{ $pretestDone ? 'text-green-600 dark:text-green-400' : 'text-blue-600 dark:text-blue-400' }}">
                                            Pretest
                                            @if($pretestDone && $pretestResult)
                                                <br><span class="font-bold text-green-700 dark:text-green-300">{{ $pretestResult->percentage }}%</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex-1 h-1 rounded-full {{ $pretestDone ? 'bg-green-400' : 'bg-gray-300 dark:bg-gray-600' }}"></div>
                                @endif

                                {{-- Step 2: Baca Materi --}}
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold
                                        {{ $posttestDone ? 'bg-green-500 text-white' : ($readingActive ? 'bg-amber-500 text-white ring-4 ring-amber-300 dark:ring-amber-700' : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400') }}">
                                        {{ $posttestDone ? '✓' : '📖' }}
                                    </div>
                                    <p class="text-xs font-semibold mt-1 text-center leading-tight
                                        {{ $posttestDone ? 'text-green-600 dark:text-green-400' : ($readingActive ? 'text-amber-600 dark:text-amber-400' : 'text-gray-400') }}">
                                        Baca Materi
                                        @if($readingActive)<br><span class="text-amber-500">Sedang</span>@endif
                                    </p>
                                </div>

                                @if($posttest)
                                    <div class="flex-1 h-1 rounded-full {{ $posttestDone ? 'bg-green-400' : 'bg-gray-300 dark:bg-gray-600' }}"></div>

                                    {{-- Step 3: Posttest (SEKARANG BISA DIKLIK) --}}
                                    <div class="flex flex-col items-center flex-1">
                                        <a href="{{ route('materials.posttest', $material->slug) }}" 
                                           title="Klik untuk melihat soal Posttest"
                                           class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shadow-md hover:scale-110 transition-transform
                                            {{ $posttestDone ? 'bg-green-500 text-white' : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 hover:bg-purple-500 hover:text-white' }}">
                                            {{ $posttestDone ? '✓' : '3' }}
                                        </a>
                                        <p class="text-xs font-semibold mt-1 text-center leading-tight
                                            {{ $posttestDone ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                            Posttest
                                            @if($posttestDone && $latestPosttestResult)
                                                <br><span class="font-bold text-green-700 dark:text-green-300">{{ $latestPosttestResult->percentage }}%</span>
                                            @endif
                                        </p>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif

                    <!-- Kompetensi Dasar & Pertemuan -->
                    @if($material->kompetensi_dasar || $material->pertemuan_ke !== null)
                        <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-2xl p-4 sm:p-5">
                            <div class="flex flex-wrap items-start gap-3">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-1">
                                        🎯 Kompetensi Dasar
                                    </p>
                                    @if($material->kompetensi_dasar)
                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                            Setelah mempelajari materi ini, siswa diharapkan mampu:<br>
                                            <span class="font-semibold text-gray-900 dark:text-white">{{ $material->kompetensi_dasar }}</span>
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">Kompetensi dasar belum diisi.</p>
                                    @endif
                                </div>
                                @if($material->pertemuan_ke !== null)
                                    <div class="shrink-0">
                                        <span class="inline-flex items-center gap-1 bg-blue-600 text-white text-sm font-bold px-3 py-1.5 rounded-full shadow-sm">
                                            📅 {{ $material->pertemuan_ke > 0 ? 'Pertemuan ' . $material->pertemuan_ke : 'Materi Umum' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Deskripsi -->
                    @if($material->description)
                        <p class="text-gray-600 dark:text-gray-400 mb-6 text-base leading-relaxed border-l-4 border-amber-400 pl-4">
                            {{ $material->description }}
                        </p>
                    @endif

                    <!-- Pemutar Audio Kustom (Premium) -->
                    @if($material->audio_url)
                        <div class="mb-8 p-5 bg-gradient-to-r from-emerald-800 to-green-900 dark:from-green-950/60 dark:to-emerald-950/60 rounded-3xl border border-green-200/20 shadow-xl"
                             x-data="{
                                 playing: false,
                                 currentTime: 0,
                                 duration: 0,
                                 volume: 0.8,
                                 muted: false,
                                 init() {
                                     const audio = this.$refs.audio;
                                     audio.addEventListener('timeupdate', () => {
                                         this.currentTime = audio.currentTime;
                                     });
                                     audio.addEventListener('durationchange', () => {
                                         this.duration = audio.duration || 0;
                                     });
                                     audio.addEventListener('ended', () => {
                                         this.playing = false;
                                         this.currentTime = 0;
                                     });
                                 },
                                 togglePlay() {
                                     const audio = this.$refs.audio;
                                     if (this.playing) {
                                         audio.pause();
                                     } else {
                                         audio.play();
                                     }
                                     this.playing = !this.playing;
                                 },
                                 seek(e) {
                                     const audio = this.$refs.audio;
                                     const rect = e.currentTarget.getBoundingClientRect();
                                     const clickX = e.clientX - rect.left;
                                     const width = rect.width;
                                     audio.currentTime = (clickX / width) * this.duration;
                                 },
                                 toggleMute() {
                                     const audio = this.$refs.audio;
                                     this.muted = !this.muted;
                                     audio.muted = this.muted;
                                 },
                                 formatTime(seconds) {
                                     if (isNaN(seconds)) return '00:00';
                                     const min = Math.floor(seconds / 60).toString().padStart(2, '0');
                                     const sec = Math.floor(seconds % 60).toString().padStart(2, '0');
                                     return `${min}:${sec}`;
                                 }
                             }">
                            <audio x-ref="audio" preload="metadata" class="hidden">
                                <source src="{{ str_starts_with($material->audio_url, 'http') ? $material->audio_url : asset('storage/' . $material->audio_url) }}" type="audio/mpeg">
                                browser tidak mendukung audio tag.
                            </audio>

                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <!-- Play/Pause Button -->
                                <button type="button" @click="togglePlay()"
                                        class="w-14 h-14 rounded-full bg-yellow-450 hover:bg-yellow-350 text-green-950 flex items-center justify-center text-xl font-bold shadow-lg shadow-yellow-500/20 hover:scale-105 active:scale-95 transition-all cursor-pointer">
                                    <template x-if="!playing">
                                        <svg class="w-6 h-6 fill-current ml-1" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </template>
                                    <template x-if="playing">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                                        </svg>
                                    </template>
                                </button>

                                <!-- Title and Track -->
                                <div class="flex-1 w-full min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <p class="text-xs font-black text-green-300 dark:text-green-400 uppercase tracking-widest">🎧 Penjelasan Suara</p>
                                            <p class="text-sm font-bold text-white truncate mt-0.5">Dengarkan Pelafalan &amp; Ringkasan Materi</p>
                                        </div>
                                        <span class="text-xs font-mono font-bold text-green-200" x-text="`${formatTime(currentTime)} / ${formatTime(duration)}`"></span>
                                    </div>

                                    <!-- Track Bar -->
                                    <div class="h-2.5 bg-white/10 dark:bg-black/30 rounded-full cursor-pointer overflow-hidden relative" @click="seek($event)">
                                        <div class="h-full bg-yellow-400 rounded-full transition-all duration-75"
                                             :style="`width: ${duration > 0 ? (currentTime / duration) * 100 : 0}%`"></div>
                                    </div>
                                </div>

                                <!-- Volume Slider -->
                                <div class="flex items-center gap-2 shrink-0">
                                    <button type="button" @click="toggleMute()" class="w-8 h-8 text-green-200 hover:text-white transition-colors cursor-pointer">
                                        <template x-if="!muted">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                                            </svg>
                                        </template>
                                        <template x-if="muted">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.21.05-.42.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
                                            </svg>
                                        </template>
                                    </button>
                                    <input type="range" min="0" max="1" step="0.05"
                                           x-model="volume"
                                           @input="$refs.audio.volume = volume; if(volume > 0) { muted = false; $refs.audio.muted = false; }"
                                           class="w-16 h-1.5 bg-white/20 accent-yellow-400 rounded-lg appearance-none cursor-pointer">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Konten Materi -->
                    <div class="prose prose-amber dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed
                                prose-headings:text-gray-900 dark:prose-headings:text-white
                                prose-h2:border-b prose-h2:border-amber-200 dark:prose-h2:border-gray-700 prose-h2:pb-2">
                        {!! $material->content !!}
                    </div>

                    <style>
                        .prose img { border-radius: 0.75rem !important; box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important; margin: 1.5rem auto !important; max-width: 100% !important; display: block; }
                        .prose iframe { width: 100% !important; aspect-ratio: 16/9; border-radius: 0.75rem !important; box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important; margin: 1.5rem 0 !important; }
                        .prose table { width: 100% !important; border-collapse: collapse !important; border-radius: 0.5rem; overflow: hidden; }
                        .prose table th, .prose table td { border: 1px solid #fed7aa !important; padding: 10px 14px !important; }
                        .prose table th { background-color: #fff7ed; font-weight: 700; }
                        .dark .prose table th { background-color: #374151; }
                        .dark .prose table th, .dark .prose table td { border-color: #4b5563 !important; }
                    </style>

                    <script>
                        // Lazy load for inline images generated by WYSIWYG
                        document.addEventListener('DOMContentLoaded', function() {
                            document.querySelectorAll('.prose img').forEach(img => {
                                img.setAttribute('loading', 'lazy');
                            });
                        });
                    </script>

                    <!-- Video Embed -->
                    @if($material->video_url)
                        <div class="mt-10 bg-white dark:bg-gray-800 rounded-3xl border border-amber-100 dark:border-gray-700 overflow-hidden shadow-md">
                            <div class="px-6 py-4 bg-gradient-to-r from-amber-500 to-orange-600 text-white flex items-center gap-2">
                                <span class="text-xl">🎬</span>
                                <h3 class="font-extrabold text-sm uppercase tracking-wider">Video Pendukung Pembelajaran</h3>
                            </div>
                            <div class="p-4 sm:p-6">
                                <div class="aspect-video rounded-2xl overflow-hidden bg-black shadow-lg border border-gray-200 dark:border-gray-700">
                                    <iframe src="{{ $material->embed_video_url }}"
                                            class="w-full h-full"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-3 text-center">
                                    Tonton video penjelasan ini untuk mendapatkan pemahaman visual yang lebih mendalam.
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Action Area (Selesai / Posttest) -->
                    <div class="mt-10 pt-6 border-t border-amber-100 dark:border-gray-700">

                        @if($progress->isCompleted())
                            <!-- Already completed -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                <div class="flex-1 flex items-center gap-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-2xl p-5">
                                    <span class="text-4xl float-slow">🎉</span>
                                    <div>
                                        <p class="font-extrabold text-green-700 dark:text-green-400">Selamat! Materi ini sudah selesai.</p>
                                        <p class="text-green-600 dark:text-green-500 text-sm mt-0.5">XP sudah diberikan saat pertama kali menyelesaikan.</p>
                                    </div>
                                </div>
                                <a href="{{ route('materials.index') }}"
                                   class="shrink-0 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold px-5 py-3 rounded-xl transition">
                                    ← Materi Lain
                                </a>
                            </div>

                        @elseif($posttest)
                            <!-- Has posttest -->
                            @if($latestPosttestResult && !$latestPosttestResult->isPassed())
                                <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-2xl p-5 mb-4">
                                    <p class="font-bold text-orange-700 dark:text-orange-400">Percobaan terakhir: {{ $latestPosttestResult->percentage }}% (Belum lulus)</p>
                                    <p class="text-orange-600 dark:text-orange-500 text-sm mt-1">Minimum kelulusan: {{ $posttest->passing_score }}%. Baca ulang materi lalu coba posttest lagi!</p>
                                </div>
                            @endif
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                <div class="flex-1 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-2xl p-5">
                                    <p class="font-bold text-purple-700 dark:text-purple-400">✅ Sudah selesai membaca?</p>
                                    <p class="text-purple-600 dark:text-purple-500 text-sm mt-0.5">Kerjakan posttest untuk menyelesaikan materi dan mendapat +30 XP!</p>
                                </div>
                                <a href="{{ route('materials.posttest', $material->slug) }}"
                                   class="shrink-0 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white font-extrabold px-6 py-3.5 rounded-xl shadow-lg shadow-purple-500/30 transition">
                                    ✅ Kerjakan Posttest
                                </a>
                            </div>

                        @else
                            <!-- No posttest, direct complete -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                <div class="flex-1 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-2xl p-5">
                                    <p class="font-bold text-amber-800 dark:text-amber-400">Sudah selesai membaca?</p>
                                    <p class="text-amber-700 dark:text-amber-500 text-sm mt-0.5">Klik tombol untuk mendapatkan <strong>+30 XP</strong>!</p>
                                </div>
                                <form method="POST" action="{{ route('materials.complete', $material->slug) }}">
                                    @csrf
                                    <button type="submit"
                                            class="shrink-0 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-white font-extrabold px-6 py-3.5 rounded-xl shadow-lg shadow-amber-500/30 transition btn-glow">
                                        ✓ Tandai Selesai — +30 XP
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </article>

            <!-- Quiz Terkait (standalone only) -->
            @php
                $standaloneQuizzes = $material->quizzes->filter(fn($q) => in_array($q->quiz_type, ['standalone']));
            @endphp
            @if($standaloneQuizzes->isNotEmpty())
                <div class="mt-6">
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg mb-4">🧠 Latihan Soal Terkait</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($standaloneQuizzes as $quiz)
                            <a href="{{ route('quizzes.take', $quiz->id) }}"
                               class="group flex items-center gap-4 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:border-amber-400 transition-all card-lift">
                                <div class="shrink-0 w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center text-2xl">🧠</div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm truncate group-hover:text-amber-600 transition-colors">
                                        {{ $quiz->title }}
                                    </p>
                                    @if($quiz->description)
                                        <p class="text-gray-400 text-xs mt-0.5 truncate">{{ $quiz->description }}</p>
                                    @endif
                                </div>
                                <span class="text-gray-400 group-hover:text-amber-600 transition-colors">→</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
