<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function auth(AuthRequest $user): RedirectResponse {

        if (Auth::guard('web')->attempt(['nomor_telepon' => $user->nomor_telepon, 'password' => $user->password])) {
            $role = Auth::user()->role->nama_role;
            $user->session()->regenerate();
            switch ($role) {
                case 'pelanggan':
                    return redirect()->route('pelanggan.dashboard');
                    break;
                
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    break;
            }
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

        return redirect()->route("login");
    }
}
>>>>>>> main
