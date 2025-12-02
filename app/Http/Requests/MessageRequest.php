<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pesan' => 'required_without:media|nullable|string',
            'media' => 'required_without:pesan|nullable|file|max:102400',
            'penerima_id' => 'required|string|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'pesan.*' => "Gagal Mengirim Pesan",
            'media.*' => "Gagal Mengirim Pesan",
            "penerima_id.*" => "Gagal Mengirim Pesan"
        ];
    }
}
