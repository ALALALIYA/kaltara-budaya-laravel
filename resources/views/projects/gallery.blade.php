<x-app-layout>
    <x-slot name="title">Galeri Karya Budaya</x-slot>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
        <div>
            <h1 class="font-figtree font-black text-3xl text-gray-900 dark:text-white">Galeri Karya Budaya</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Karya-karya terbaik dari santri MBS Tarakan dalam mengekspresikan Budaya Dayak.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center text-green-900 dark:text-green-100 font-bold hover:text-yellow-700 dark:hover:text-yellow-400 bg-green-50 dark:bg-green-900/30 px-4 py-2 rounded-xl transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Proyek
            </a>
        </div>
    </div>

    @if($projects->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-12 text-center shadow-sm border border-gray-200 dark:border-gray-700">
            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Belum ada karya yang dipajang</h3>
            <p class="text-gray-600 dark:text-gray-400 mt-2 max-w-md mx-auto">Galeri ini akan menampilkan foto-foto karya pameran santri setelah diunggah oleh guru.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col">
                    <div class="aspect-w-4 aspect-h-3 bg-gray-100 dark:bg-gray-700 relative group">
                        <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                        <!-- Culture pill overlay (hardcoded dayak for now as per RPP) -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-block bg-green-50 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Dayak
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-figtree font-bold text-xl text-gray-900 dark:text-white mb-2 line-clamp-2">{{ $project->title }}</h3>
                        <p class="text-sm font-semibold text-green-900 dark:text-green-400 mb-4">Oleh: {{ $project->user->name ?? 'Santri' }}</p>
                        
                        <div class="space-y-4 flex-grow">
                            <div>
                                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Bahan:</h4>
                                <p class="text-sm text-gray-900 dark:text-white line-clamp-2">{{ $project->materials_used }}</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Makna Budaya:</h4>
                                <p class="text-sm text-gray-900 dark:text-white line-clamp-4">{{ $project->cultural_meaning }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>
</x-app-layout>
