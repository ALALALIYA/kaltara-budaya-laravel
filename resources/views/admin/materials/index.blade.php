<x-app-layout>
    <x-slot name="title">Kelola Materi</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">📚 Semua Materi</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Review dan moderasi materi dari guru</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition">
                    ← Dashboard
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($materials as $material)
                        <div class="p-5 flex items-start gap-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <div class="shrink-0 w-12 h-12 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-2xl">
                                {{ $material->category_icon }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $material->title }}</p>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $material->status_color }}">
                                        {{ $material->status_label }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                    oleh {{ $material->teacher->name }} · {{ $material->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <a href="{{ route('admin.materials.show', $material->id) }}"
                                   class="text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 font-medium transition">
                                    Preview
                                </a>
                                @if($material->status !== 'approved')
                                    <form method="POST" action="{{ route('admin.materials.approve', $material->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700 font-bold transition">✓ Setujui</button>
                                    </form>
                                @endif
                                @if($material->status !== 'draft')
                                    <form method="POST" action="{{ route('admin.materials.reject', $material->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-bold transition">✕ Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-400">Belum ada materi.</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4">{{ $materials->links() }}</div>

        </div>
    </div>
</x-app-layout>
