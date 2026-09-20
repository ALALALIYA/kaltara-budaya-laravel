<x-app-layout>
    <x-slot name="title">{{ $material->title }}</x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
                <a href="{{ route('teacher.materials.index') }}" class="hover:text-green-600 transition-colors">Materi Saya</a>
                <span>/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium truncate">{{ $material->title }}</span>
            </nav>

            <!-- Aksi -->
            <div class="flex flex-wrap gap-3 mb-6">
                <a href="{{ route('teacher.materials.edit', $material->id) }}"
                   class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-600 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    ✏️ Edit Materi
                </a>
                <form method="POST" action="{{ route('teacher.materials.destroy', $material->id) }}"
                      onsubmit="return confirm('Hapus materi ini? Tindakan ini tidak bisa dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-500 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                        🗑️ Hapus
                    </button>
                </form>
                <a href="{{ route('teacher.materials.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
                    ← Kembali
                </a>
            </div>

            <!-- Detail Materi -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">

                <!-- Hero / Gambar -->
                <div class="relative h-44
                    {{ $material->category === 'dayak'  ? 'bg-gradient-to-br from-green-600 to-green-900' :
                       ($material->category === 'banjar' ? 'bg-gradient-to-br from-amber-500 to-amber-900' :
                       ($material->category === 'kutai'  ? 'bg-gradient-to-br from-red-600 to-red-900' :
                                                            'bg-gradient-to-br from-blue-600 to-blue-900')) }}
                    flex items-center justify-center">
                    @if($material->image && str_starts_with($material->image, 'http'))
                        <img src="{{ $material->image }}" alt="{{ $material->title }}"
                             class="w-full h-full object-cover absolute inset-0 mix-blend-overlay opacity-50">
                    @elseif($material->image)
                        <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}"
                             class="w-full h-full object-cover absolute inset-0">
                    @endif
                    <span class="relative text-6xl z-10">
                        {{ $material->category === 'dayak' ? '🦅' : ($material->category === 'banjar' ? '🎋' : ($material->category === 'kutai' ? '🐉' : '🌊')) }}
                    </span>
                </div>

                <div class="p-6">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="text-xs font-bold {{ $material->category_color }} uppercase">{{ $material->category_label }}</span>
                        @if($material->video_url)
                            <span class="text-xs bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400 font-semibold px-2 py-0.5 rounded-full">🎬 Ada Video</span>
                        @endif
                    </div>

                    <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $material->title }}</h1>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">{{ $material->description }}</p>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl mb-6 text-sm">
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5">Slug URL</p>
                            <p class="font-mono font-medium text-gray-700 dark:text-gray-300 text-xs">{{ $material->slug }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5">Dibuat</p>
                            <p class="font-medium text-gray-700 dark:text-gray-300 text-xs">{{ $material->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs mb-0.5">Terakhir Diperbarui</p>
                            <p class="font-medium text-gray-700 dark:text-gray-300 text-xs">{{ $material->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Preview Konten -->
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300 text-sm mb-4">Isi Materi Lengkap:</p>
                        
                        <!-- Class pembatas dan efek pudar (gradient) sudah dihapus di bawah ini -->
                        <div class="prose max-w-none dark:prose-invert text-gray-800 dark:text-gray-200">
                            {!! $material->content !!}
                        </div>

                        <!-- Audio & Video Preview -->
                        @if($material->audio_url || $material->video_url)
                            <div class="my-6 p-4 bg-orange-50/30 dark:bg-gray-700/30 rounded-xl border border-orange-200/50 dark:border-gray-600/50">
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-3">📁 Media Pendukung</h3>
                                <div class="space-y-4">
                                    @if($material->audio_url)
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Audio Pendukung:</p>
                                            <audio src="{{ str_starts_with($material->audio_url, 'http') ? $material->audio_url : asset('storage/' . $material->audio_url) }}" 
                                                   controls class="w-full"></audio>
                                        </div>
                                    @endif
                                    @if($material->video_url)
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Video YouTube:</p>
                                            <div class="aspect-video w-full max-w-md rounded-lg overflow-hidden bg-black shadow-sm">
                                                <iframe src="{{ $material->embed_video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <a href="{{ route('materials.show', $material->slug) }}" target="_blank"
                           class="inline-block mt-4 text-green-600 hover:text-green-500 text-sm font-bold">
                            Lihat tampilan siswa →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kuis Terkait -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg">🧠 Kuis Terkait Materi Ini</h2>
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="text-green-600 hover:text-green-500 text-sm font-medium">+ Buat Kuis →</a>
                </div>

                @if($material->quizzes->isEmpty())
                    <p class="text-gray-400 text-sm py-4 text-center">Belum ada kuis yang dikaitkan dengan materi ini.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($material->quizzes as $quiz)
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-600">
                                <div class="min-w-0 pr-3">
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm line-clamp-1" title="{{ $quiz->title }}">{{ $quiz->title }}</p>
                                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">{{ $quiz->questions_count ?? 0 }} soal</p>
                                </div>
                                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}"
                                   class="px-3 py-1.5 bg-white dark:bg-gray-600 hover:bg-green-50 dark:hover:bg-gray-500 text-green-700 dark:text-green-400 text-xs font-bold rounded-lg border border-green-200 dark:border-gray-500 transition-colors shadow-sm shrink-0">Kelola →</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
