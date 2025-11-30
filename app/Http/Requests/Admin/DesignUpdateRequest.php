<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DesignUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'sometimes|string|max:100',
            'deskripsi' => 'sometimes|string',
            'harga' => 'sometimes|numeric|min:0'
        ];
    }
}
