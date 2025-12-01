<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function authPelanggan(AuthRequest $user): RedirectResponse {

        if (Auth::guard('web')->attempt(['nomor_telepon' => $user->nomor_telepon, 'password' => $user->password])) {
            $user->session()->regenerate();
            return redirect()->route('pelanggan.dashboard');
        }

        return back()->withErrors([
            'nomor_telepon' => 'Nomor atau Password salah',
            'password' => "Normo atau Password salah"
        ])->onlyInput('nomor_telepon');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("pelanggan.login");
    }
}
