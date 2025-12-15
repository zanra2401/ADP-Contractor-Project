<?php

namespace App\Services;

use App\Models\User;
use App\Models\ForgetCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordService
{
    public function sendResetCode($nomor_telepon)
    {
        $user = User::where('nomor_telepon', $nomor_telepon)->first();

        if (!$user) {
            return response()->json(['message' => 'Nomor tidak terdaftar'], 404);
        }

        // Hapus OTP lama
        ForgetCode::where('user_id', $user->id)->delete();

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan OTP ke database
        $forget = ForgetCode::create([
            'user_id'   => $user->id,
            'code'      => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        // ======================================
        // KIRIM WA VIA FONNTE
        // ======================================
        $token = env('FONNTE_TOKEN');

        // Format nomor telepon -> 62xxxxxxxx
        $phone = preg_replace('/[^0-9]/', '', $nomor_telepon);
        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = "ADP Konstruksi\nKode OTP Anda adalah *$otp*\nBerlaku selama 5 menit.";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $phone,
                'message' => $message,
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return response()->json([
                'message' => 'Kode OTP tersimpan tetapi gagal mengirim WA.',
                'error' => $error
            ], 500);
        }

        // ============================
        //  IMPORTANT: RETURN SUKSES!
        // ============================
        return response()->json([
            'message' => 'Kode OTP berhasil dikirim.',
            'redirect' => route('forgot.verify'),
            'phone' => $phone
        ]);
    }


    public function resetPassword($code, $password)
    {
        $forget = ForgetCode::where('code', $code)
            ->where('expired_at', '>', now())
            ->first();

        if (!$forget) {
            return response()->json(['message' => 'Kode OTP salah atau kadaluarsa'], 400);
        }

        $user = $forget->user;
        $user->password = Hash::make($password);
        $user->save();

        $forget->delete();

        return response()->json(['message' => 'Password berhasil diperbarui!']);
    }
}
