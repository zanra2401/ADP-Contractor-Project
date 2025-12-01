<?php

namespace App\Services;

use App\Models\User;
use App\Models\ForgetCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotPasswordService
{
    // Membuat dan mengirim kode reset
    public function sendResetCode($nomor_telepon)
    {
        $user = User::where('nomor_telepon', $nomor_telepon)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Nomor telepon tidak terdaftar.'
            ], 404);
        }

        // Hapus semua kode lama milik user
        ForgetCode::where('user_id', $user->id)->delete();

        // Buat kode baru
        $code = ForgetCode::create([
            'user_id' => $user->id,
            'expired_at' => Carbon::now()->addMinutes(10)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kode reset berhasil dibuat.',
            'reset_code' => $code->code  // tampilkan untuk testing
        ]);
    }

    // Reset password menggunakan kode
    public function resetPassword($code, $password)
    {
        $data = ForgetCode::where('code', $code)
            ->where('expired_at', '>', Carbon::now())
            ->first();

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Kode reset tidak valid atau sudah kedaluwarsa.'
            ], 400);
        }

        $user = User::find($data->user_id);

        // Update password user
        $user->password = Hash::make($password);
        $user->save();

        // Hapus kode setelah dipakai
        ForgetCode::where('code', $code)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Password berhasil direset.'
        ]);
    }
}
