<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemulihan Foto Cepat - Kaltara Budaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Alat Pemulihan Foto Materi (Cepat)</h1>
            <p class="text-gray-600">
                Pilih judul materi yang sesuai untuk setiap foto di bawah ini. Setelah selesai, klik tombol <strong>"Simpan Semua Pasangan Foto"</strong> di bagian paling bawah.
            </p>
            <div class="mt-4 flex gap-4">
                <a href="/" class="text-indigo-600 hover:text-indigo-800 font-medium">← Kembali ke Beranda</a>
                <a href="/materials" class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat Halaman Materi →</a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-xl border border-green-200 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.recover_photos.save') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($images as $image)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col p-4">
                        <div class="h-48 w-full bg-gray-100 rounded-lg overflow-hidden mb-3 border border-gray-100 flex items-center justify-center">
                            <img src="{{ asset('storage/materials/' . $image) }}" 
                                 class="w-full h-full object-cover" 
                                 alt="Foto Materi"
                                 loading="lazy"
                                 onerror="this.src='/storage/materials/{{ $image }}'">
                        </div>
                        <p class="text-xs text-gray-400 font-mono truncate mb-2">{{ $image }}</p>
                        <div class="mt-auto">
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Pasangkan ke Materi:</label>
                            <select name="mappings[{{ $image }}]" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                                <option value="">-- Jangan Pasangkan --</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ (isset($material->image) && str_contains($material->image, $image)) ? 'selected' : '' }}>
                                        {{ $material->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sticky bottom-6 mt-8 bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex justify-between items-center max-w-2xl mx-auto">
                <span class="text-sm text-gray-600">Pastikan materi sudah dipilih sesuai foto.</span>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow transition">
                    Simpan Semua Pasangan Foto
                </button>
            </div>
        </form>
    </div>
</body>
</html>
