<x-app-layout>
    <x-slot name="title">Evaluasi Proyek Akhir</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
    <h1 class="text-3xl font-black text-ink font-figtree">Evaluasi Proyek Akhir</h1>
    <p class="text-ink-muted mt-2">Daftar karya santri untuk pameran kelas. Unggah foto dokumentasi karya di sini.</p>
</div>

@if(session('success'))
    <div class="bg-dayak-green-surface border border-dayak-green text-dayak-green px-4 py-3 rounded-lg mb-6 relative">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    @if($projects->isEmpty())
        <div class="p-8 text-center text-ink-muted">
            Belum ada santri yang mengumpulkan deskripsi proyek akhir.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-4 px-6 font-semibold text-sm text-ink uppercase tracking-wider">Santri</th>
                        <th class="py-4 px-6 font-semibold text-sm text-ink uppercase tracking-wider">Judul Karya</th>
                        <th class="py-4 px-6 font-semibold text-sm text-ink uppercase tracking-wider">Deskripsi & Bahan</th>
                        <th class="py-4 px-6 font-semibold text-sm text-ink uppercase tracking-wider text-center">Status Foto</th>
                        <th class="py-4 px-6 font-semibold text-sm text-ink uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 align-top">
                                <div class="font-bold text-ink">{{ $project->user->name }}</div>
                                <div class="text-xs text-ink-muted mt-1">{{ $project->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <div class="font-bold text-canopy-deep">{{ $project->title }}</div>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <div class="text-sm">
                                    <strong class="block text-xs text-ink-muted uppercase">Bahan:</strong>
                                    <p class="mb-2">{{ $project->materials_used }}</p>
                                    <strong class="block text-xs text-ink-muted uppercase">Makna:</strong>
                                    <p class="line-clamp-3">{{ $project->cultural_meaning }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                @if($project->image_path)
                                    <span class="inline-block px-3 py-1 bg-dayak-green-surface text-dayak-green text-xs font-bold rounded-full">
                                        Sudah Ada
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">
                                        Belum Ada
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 align-top text-right">
                                <!-- Upload Form -->
                                <form action="{{ route('teacher.projects.upload-photo', $project) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-end gap-2">
                                    @csrf
                                    <input type="file" name="image" required accept="image/*" class="text-xs w-full max-w-[200px] file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                                    <button type="submit" class="bg-amber-light hover:bg-amber-bright text-canopy-deep font-bold py-1.5 px-3 rounded text-sm transition-colors w-full max-w-[200px]">
                                        {{ $project->image_path ? 'Ganti Foto' : 'Unggah Foto' }}
                                    </button>
                                </form>
                                @if($project->image_path)
                                    <div class="mt-2 text-right">
                                        <a href="{{ Storage::url($project->image_path) }}" target="_blank" class="text-xs text-canopy-deep hover:underline">Lihat Foto</a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
        </div>
    </div>
</x-app-layout>
