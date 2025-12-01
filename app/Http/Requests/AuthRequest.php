<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AuthRequest extends FormRequest
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
            'nomor_telp' => 'unique:users,nomor_telepon|required|regex:/^[0-9]{1,12}$/|max:12',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*[0-9]).{8,}$/',
        ];
    }

    protected function passedValidation(): array
    {   
        return [
            'password' => Hash::make($this->input('password'))
        ];
    }
}