<?php

namespace App\Http\Requests\Pengunjung;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPengunjungRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomor_telp' => 'unique:users,nomor_telepon|required|regex:/^[0-9]{1,12}$/|max:12',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*[0-9]).{8,}$/|confirmed',
            'nama' => 'required|regex:/[a-zA-Z _-]{3, 30}/'
        ];
    }

    public function messages(): array
    {
        return [
            'nomor_telpon.*' => "Nomor Telepon Error",
            'password.*' => "Password Tidak Sesuai Atau Kurang Aman",
            'nama.*' => "Nama Tidak Sesuai" 
        ];
    }
}
