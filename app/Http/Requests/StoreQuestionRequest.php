<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isTeacher() ?? false;
    }

    public function rules(): array
    {
        return [
            'question'       => ['required', 'string', 'max:1000'],
            'type'           => ['required', 'in:multiple_choice,true_false'],
            'options'        => ['required', 'array', 'min:2', 'max:4'],
            'options.*'      => ['required', 'string', 'max:255'],
            'correct_answer' => ['required', 'string', 'max:255'],
            'explanation'    => ['nullable', 'string', 'max:1000'],
            'order'          => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'question.required'       => 'Teks soal wajib diisi.',
            'question.max'            => 'Teks soal maksimal 1000 karakter.',
            'type.required'           => 'Tipe soal wajib dipilih.',
            'type.in'                 => 'Tipe soal tidak valid. Pilih: Pilihan Ganda atau Benar/Salah.',
            'options.required'        => 'Opsi jawaban wajib diisi.',
            'options.min'             => 'Minimal 2 opsi jawaban harus diisi.',
            'options.max'             => 'Maksimal 4 opsi jawaban.',
            'options.*.required'      => 'Semua opsi jawaban tidak boleh kosong.',
            'options.*.max'           => 'Setiap opsi maksimal 255 karakter.',
            'correct_answer.required' => 'Jawaban benar wajib ditentukan.',
        ];
    }
}
