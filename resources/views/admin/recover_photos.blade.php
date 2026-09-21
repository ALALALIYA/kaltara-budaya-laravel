@extends('layouts.app')

@section('content')
<div class="container py-8 mx-auto">
    <h2 class="mb-6 text-2xl font-bold text-gray-800">Alat Pemulihan Foto (Cepat)</h2>
    <p class="mb-6 text-gray-600">Karena tadi database ter-reset, 20 foto cover kamu terlepas dari materinya. Tapi tenang, <strong>fotonya tidak hilang</strong> dan sudah ada di server! Kamu tinggal memasangkan foto di bawah ini dengan materi yang tepat melalui dropdown.</p>

    @if(session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.recover_photos.save') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($images as $image)
                <div class="p-4 bg-white rounded-lg shadow-md border border-gray-200">
                    <img src="{{ asset('storage/materials/' . $image) }}" class="object-cover w-full h-40 mb-4 rounded" alt="Foto">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Materi untuk foto ini:</label>
                    <select name="mappings[{{ $image }}]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Jangan Pasangkan --</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" {{ (isset($material) && strpos($material->image, $image) !== false) ? 'selected' : '' }}>
                                {{ $material->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="px-6 py-3 font-bold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                Simpan Semua Pasangan Foto
            </button>
        </div>
    </form>
</div>
@endsection
