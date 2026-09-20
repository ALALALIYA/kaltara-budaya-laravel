<x-app-layout>
    <x-slot name="title">Review Materi: {{ $material->title }}</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('admin.materials.index') }}" class="hover:text-orange-600">Kelola Materi</a>
                <span>/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium truncate">{{ $material->title }}</span>
            </nav>

            <!-- Status Bar -->
            <div class="flex items-center justify-between bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-200 dark:border-gray-700 mb-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="font-bold {{ $material->status_color }} px-3 py-1 rounded-full text-sm">
                        {{ $material->status_label }}
                    </span>
                    <span class="text-gray-500 dark:text-gray-400 text-sm">
                        Dikirim oleh <strong>{{ $material->teacher->name }}</strong> · {{ $material->created_at->format('d M Y H:i') }}
                    </span>
                </div>
                <div class="flex gap-2">
                    @if($material->status !== 'approved')
                        <form method="POST" action="{{ route('admin.materials.approve', $material->id) }}">
                            @csrf @method('PATCH')
                            <button class="px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 font-bold text-sm transition">
                                ✓ Setujui & Publikasikan
                            </button>
                        </form>
                    @endif
                    @if($material->status !== 'draft')
                        <form method="POST" action="{{ route('admin.materials.reject', $material->id) }}">
                            @csrf @method('PATCH')
                            <button class="px-4 py-2 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 font-bold text-sm transition">
                                ✕ Kembalikan ke Draft
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Content Preview -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                @if($material->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ str_starts_with($material->image, 'http') ? $material->image : asset('storage/'.$material->image) }}"
                             alt="{{ $material->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6 sm:p-8">
                    <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $material->title }}</h1>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">{{ $material->description }}</p>

                    <div class="prose prose-green dark:prose-invert max-w-none">
                        {!! $material->content !!}
                    </div>

                    @if($material->video_url)
                        <div class="mt-6">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-3">🎬 Video</h3>
                            <div class="aspect-video rounded-xl overflow-hidden bg-black">
                                <iframe src="{{ $material->embed_video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
