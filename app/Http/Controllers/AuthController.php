<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function auth(AuthRequest $user): RedirectResponse {
        if (Auth::attempt(['nomor_telepon' => $user->nomor_telepon, 'passowrd' => $user->password])) {
            $user->session()->regenerate();

            return redirect()->to('dashboard');
        }

        return back()->withErrors([
            'nomor_telepon' => 'Nomor atau Password salah',
            'password' => "Normo atau Password salah"
        ])->onlyInput(['nomor_telepon']);
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}
