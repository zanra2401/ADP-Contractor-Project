<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Requests\Pengunjung\RegisterPengunjungRequest;
use App\Models\Role;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class PelangganController extends Controller
{
    public function register(RegisterPengunjungRequest $user): RedirectResponse {    

        $role = Role::where("nama_Role", "pengunjung")->first();

        $data = [
            'nomor_telepon' => $user->nomor_telepon,
            'password' => Hash::make($user->password),
            'nama' => $user->nama,
            'role_id' => $role->id
        ];

        $user = User::create($data);

        try {
            $user->save();
            return redirect()->route('login');
        } catch (Exception $e) {
            return redirect()->to('/register')->with('error', "Gagal Mendaftarkan akun");
        }
    }
}