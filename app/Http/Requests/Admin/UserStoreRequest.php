<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role' => 'required|in:pengawas,pengunjung,customer_service',
            'nama' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:12|unique:users,nomor_telepon',
            'password' => 'required|string|min:6',
        ];
    }
}
