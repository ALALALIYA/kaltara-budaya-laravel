<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya user yang sudah login yang boleh submit (sudah dijaga middleware 'auth')
        return true;
    }

    public function rules(): array
    {
        return [
            'answers'   => ['required', 'array'],
            'answers.*' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'answers.required'   => 'Kamu harus menjawab minimal satu soal sebelum submit.',
            'answers.array'      => 'Format jawaban tidak valid.',
            'answers.*.required' => 'Semua soal harus dijawab.',
        ];
    }
}
