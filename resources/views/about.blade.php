<x-app-layout>
    <x-slot name="title">Tentang Media</x-slot>

    <div class="py-10 bg-amber-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Hero -->
            <div class="relative rounded-3xl overflow-hidden text-white"
                 style="background: linear-gradient(135deg, #14532d 0%, #1a4731 50%, #064e3b 100%);">
                <div class="absolute right-6 top-6 text-9xl opacity-10 select-none pointer-events-none">🏛️</div>
                <div class="relative px-8 py-10 sm:px-12">
                    <p class="text-green-300 text-sm font-semibold tracking-widest uppercase mb-2">Media Pembelajaran</p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight mb-3">
                        Seni Budaya<br>Kalimantan Utara
                    </h1>
                    <p class="text-green-200 text-base max-w-xl leading-relaxed">
                        Platform pembelajaran interaktif tentang keragaman seni dan budaya 4 suku utama
                        Kalimantan Utara untuk siswa SMA MBS Tarakan.
                    </p>
                </div>
            </div>

            <!-- Tentang Aplikasi -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-4">📖 Tentang Media Ini</h2>
                <div class="prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed space-y-3">
                    <p>
                        Media pembelajaran ini dikembangkan sebagai bagian dari penelitian skripsi berjudul
                        <strong>"Pengembangan Media Pembelajaran Seni Budaya Kalimantan Utara
                        Menggunakan Metode MDLC (Multimedia Development Life Cycle)"</strong>.
                    </p>
                    <p>
                        Media ini dirancang untuk mendukung pembelajaran Seni Budaya di kelas XII SMA MBS Tarakan,
                        dengan tujuan meningkatkan pemahaman siswa terhadap kekayaan budaya daerah Kalimantan Utara
                        melalui pendekatan berbasis teknologi yang interaktif dan menarik.
                    </p>
                    <p>
                        Materi dikategorikan berdasarkan 4 suku utama Kalimantan Utara:
                        <strong>Dayak, Banjar, Kutai,</strong> dan <strong>Tidung</strong> — mencakup tari tradisional,
                        musik, pakaian adat, upacara ritual, dan kearifan lokal masing-masing suku.
                    </p>
                </div>
            </div>

            <!-- Fitur Unggulan -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-6">✨ Fitur Unggulan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="flex gap-4 items-start">
                        <span class="text-3xl shrink-0">📚</span>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Materi Interaktif</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Konten teks, gambar, dan video untuk setiap materi suku.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <span class="text-3xl shrink-0">🎯</span>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Pretest & Posttest</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Alur belajar terstruktur dengan evaluasi sebelum dan sesudah materi.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <span class="text-3xl shrink-0">⚡</span>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Umpan Balik Langsung</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Setiap jawaban quiz langsung menampilkan koreksi dan penjelasan.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <span class="text-3xl shrink-0">🏆</span>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Gamifikasi</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Sistem XP, streak harian, dan badge penghargaan untuk motivasi belajar.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <span class="text-3xl shrink-0">📊</span>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Laporan Nilai</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Guru dapat memantau perkembangan nilai pretest vs posttest per siswa.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <span class="text-3xl shrink-0">🎮</span>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Mini Game</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Permainan pencocokan motif dan tarian untuk belajar sambil bermain.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Sekolah & Pengembang -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Sekolah -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-7">
                    <h2 class="text-lg font-extrabold text-gray-900 dark:text-white mb-5">🏫 Instansi</h2>
                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Sekolah</p>
                            <p class="font-semibold">SMA MBS Tarakan</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">Tarakan, Kalimantan Utara</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Mata Pelajaran</p>
                            <p class="font-semibold">Seni Budaya</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">Kelas XII — Semester Ganjil</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Kurikulum</p>
                            <p class="font-semibold">Kurikulum Merdeka</p>
                        </div>
                    </div>
                </div>

                <!-- Pengembang -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-7">
                    <h2 class="text-lg font-extrabold text-gray-900 dark:text-white mb-5">👨‍💻 Pengembang</h2>
                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Nama</p>
                            <p class="font-semibold">Mahasiswa Pengembang</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">Program Studi Pendidikan Teknologi Informasi</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Metode Pengembangan</p>
                            <p class="font-semibold">MDLC (Multimedia Development Life Cycle)</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">Concept → Design → Material Collecting → Assembly → Testing → Distribution</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Teknologi</p>
                            <p class="font-semibold">Laravel · MySQL · Tailwind CSS · Alpine.js</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hubungi / Catatan -->
            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-2xl p-6 text-center">
                <p class="text-sm text-amber-800 dark:text-amber-300 leading-relaxed">
                    Media ini dikembangkan untuk keperluan penelitian skripsi dan digunakan secara terbatas
                    di lingkungan SMA MBS Tarakan. Seluruh konten materi disusun berdasarkan referensi budaya
                    Kalimantan Utara yang telah diverifikasi.
                </p>
                <p class="text-xs text-amber-600 dark:text-amber-400 mt-2">© {{ date('Y') }} · Seni Budaya Kalimantan Utara · MBS Tarakan</p>
            </div>

        </div>
    </div>
</x-app-layout>
