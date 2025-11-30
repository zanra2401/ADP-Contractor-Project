<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role' => 'sometimes|in:pengawas,pengunjung,customer_service',
            'nama' => 'sometimes|string|max:100',
            'nomor_telepon' => 'sometimes|string|max:12',
            'password' => 'sometimes|string|min:6',
        ];
    }
}
