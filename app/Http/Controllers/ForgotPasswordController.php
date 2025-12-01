<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForgotPasswordService;

class ForgotPasswordController extends Controller
{
    protected $service;

    public function __construct(ForgotPasswordService $service)
    {
        $this->service = $service;
    }

    // User meminta kode reset
    public function requestReset(Request $request)
    {
        $request->validate([
            'nomor_telepon' => 'required'
        ]);

        return $this->service->sendResetCode($request->nomor_telepon);
    }

    // User mengirim kode + password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'code'        => 'required',
            'password'    => 'required|min:6',
        ]);

        return $this->service->resetPassword($request->code, $request->password);
    }
}
