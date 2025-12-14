<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ForgotPasswordService;
use App\Models\ForgetCode;


class ForgotPasswordController extends Controller
{
    protected $service;

    public function __construct(ForgotPasswordService $service)
    {
        $this->service = $service;
    }

    public function requestReset(Request $request)
    {
        $request->validate([
            'nomor_telepon' => 'required'
        ]);

        return $this->service->sendResetCode($request->nomor_telepon);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'password' => 'required|min:6'
        ]);

        // Ambil data OTP
        $otp = ForgetCode::where('code', $request->code)->first();

        if (!$otp) {
            return response()->json([
                'message' => 'Kode OTP tidak valid.'
            ], 400);
        }

        // Ambil user berdasarkan user_id
        $user = \App\Models\User::find($otp->user_id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        // Update password user
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil diubah'
        ]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $otp = ForgetCode::where('code', $request->code)
            ->where('expired_at', '>', now())
            ->first();


        if (!$otp) {
            return response()->json([
                'message' => 'Kode OTP salah atau sudah kadaluarsa'
            ], 400);
        }

        return response()->json([
            'message' => 'Kode OTP benar'
        ]);
    }
}
