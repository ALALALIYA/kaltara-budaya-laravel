<x-app-layout>
    <x-slot name="title">Proyek Akhir</x-slot>

    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-green-900 dark:bg-green-950 rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="font-figtree font-black text-3xl md:text-4xl tracking-tight mb-2 text-yellow-400">
                Proyek Akhir
            </h1>
            <p class="text-green-100 text-lg max-w-2xl">
                Pameran Mini Budaya Dayak. Buktikan pemahamanmu dengan membuat karya!
            </p>
        </div>
        <!-- Decorative element -->
        <div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 22h20L12 2zm0 4l6 14H6l6-14z"/></svg>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg mb-6 relative" role="alert">
            <span class="block sm:inline font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="font-figtree font-bold text-lg text-gray-900 dark:text-white mb-4">Instruksi Proyek</h3>
                <div class="text-gray-600 dark:text-gray-400 text-sm space-y-4">
                    <p>Sebagai puncak pembelajaran, buatlah satu karya yang mencerminkan budaya suku Dayak. Karya akan dipresentasikan di kelas secara offline.</p>
                    <p class="font-semibold text-gray-900 dark:text-white">Pilihan Karya:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Pakaian adat dari bahan alam/sederhana</li>
                        <li>Miniatur rumah adat (stik es krim, dll)</li>
                        <li>Penampilan tari dasar (Kinyah/Hudoq)</li>
                        <li>Poster/Infografis budaya Dayak</li>
                        <li>Motif ukir Dayak di kertas/media lain</li>
                    </ul>
                    <div class="mt-4 p-3 bg-amber-50 rounded-lg border border-amber-200 text-amber-900">
                        <strong class="block mb-1">Catatan Pengumpulan:</strong>
                        Isi form di samping dengan detail karyamu. Foto karyamu akan diunggah oleh Guru saat pameran kelas.
                    </div>
                </div>
            </div>
            
            <a href="{{ route('projects.gallery') }}" class="block w-full text-center bg-white dark:bg-gray-800 border-2 border-yellow-400 text-yellow-600 dark:text-yellow-400 font-bold py-3 px-4 rounded-xl hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors">
                Lihat Galeri Karya
            </a>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 md:p-8 border border-gray-200 dark:border-gray-700">
                <h2 class="font-figtree font-extrabold text-2xl text-gray-900 dark:text-white mb-6">
                    {{ $project ? 'Detail Karyamu' : 'Form Pengumpulan Karya' }}
                </h2>

                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Judul Karya <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                                value="{{ old('title', $project->title ?? '') }}"
                                {{ $project ? 'readonly bg-gray-50 dark:bg-gray-600' : '' }}
                                placeholder="Contoh: Miniatur Rumah Betang dari Stik Es Krim">
                            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="materials_used" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Bahan yang Digunakan <span class="text-red-500">*</span></label>
                            <textarea name="materials_used" id="materials_used" rows="3" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                                {{ $project ? 'readonly bg-gray-50 dark:bg-gray-600' : '' }}
                                placeholder="Sebutkan bahan-bahan yang kamu gunakan...">{{ old('materials_used', $project->materials_used ?? '') }}</textarea>
                            @error('materials_used') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="cultural_meaning" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Deskripsi Makna Budaya <span class="text-red-500">*</span></label>
                            <textarea name="cultural_meaning" id="cultural_meaning" rows="5" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                                {{ $project ? 'readonly bg-gray-50 dark:bg-gray-600' : '' }}
                                placeholder="Ceritakan makna budaya di balik karya yang kamu buat. Apa yang ingin kamu sampaikan?">{{ old('cultural_meaning', $project->cultural_meaning ?? '') }}</textarea>
                            @error('cultural_meaning') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        @if($project)
                            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-3">Status Dokumentasi</h3>
                                @if($project->image_path)
                                    <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                        <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}" class="w-full h-auto object-cover max-h-64">
                                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 text-sm text-gray-600 dark:text-gray-400 text-center">Foto diunggah oleh Guru</div>
                                    </div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 border-dashed rounded-lg p-6 text-center">
                                        <p class="text-gray-600 dark:text-gray-400 font-medium">Foto karyamu belum diunggah.</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Guru akan memotret dan mengunggahnya saat pameran kelas berlangsung.</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold py-3 px-6 rounded-xl transition-all shadow-sm hover:shadow-md">
                                    Kumpulkan Proyek
                                </button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
