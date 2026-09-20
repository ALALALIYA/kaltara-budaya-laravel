<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isTeacher() ?? false;
    }

    public function rules(): array
    {
        return [
            'title'               => ['required', 'string', 'max:255'],
            'description'         => ['nullable', 'string', 'max:500'],
            'material_id'         => ['nullable', 'exists:materials,id'],
            'quiz_type'           => ['required', 'in:pretest,posttest,ujian_harian,uts,uas,standalone'],
            'passing_score'       => ['required', 'integer', 'min:1', 'max:100'],
            'time_limit'          => ['nullable', 'integer', 'min:1', 'max:300'],
            'min_harian_required' => ['required', 'integer', 'min:0', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'         => 'Judul quiz wajib diisi.',
            'title.max'              => 'Judul maksimal 255 karakter.',
            'material_id.exists'     => 'Materi yang dipilih tidak ditemukan.',
            'quiz_type.required'     => 'Jenis quiz wajib dipilih.',
            'passing_score.required' => 'Nilai kelulusan wajib diisi.',
        ];
    }
}
