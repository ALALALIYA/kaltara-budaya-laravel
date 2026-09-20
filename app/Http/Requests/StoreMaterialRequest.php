<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isTeacherOrAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['required', 'string', 'max:1000'],
            'kompetensi_dasar' => ['nullable', 'string', 'max:2000'],
            'pertemuan_ke'     => ['nullable', 'integer', 'min:0', 'max:50'],
            'content'          => ['required', 'string'],
            'category'         => ['nullable', 'in:dayak,banjar,kutai,tidung'],
            'image'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'video_url'        => ['nullable', 'url', 'max:500'],
            'audio'            => ['nullable', 'file', 'mimes:mp3,wav,ogg,m4a', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Judul materi wajib diisi.',
            'title.max'            => 'Judul maksimal 255 karakter.',
            'description.required' => 'Deskripsi singkat wajib diisi.',
            'description.max'      => 'Deskripsi maksimal 1000 karakter.',
            'content.required'     => 'Konten materi wajib diisi.',
            'category.in'          => 'Kategori tidak valid.',
            'image.image'          => 'File harus berupa gambar.',
            'image.mimes'          => 'Format gambar yang diizinkan: JPEG, PNG, JPG, WebP.',
            'image.max'            => 'Ukuran gambar maksimal 2 MB.',
            'video_url.url'        => 'URL video tidak valid.',
            'audio.file'           => 'File pendukung harus berupa file valid.',
            'audio.mimes'          => 'Format audio yang diizinkan: MP3, WAV, OGG, M4A.',
            'audio.max'            => 'Ukuran audio maksimal 10 MB.',
        ];
    }
}
