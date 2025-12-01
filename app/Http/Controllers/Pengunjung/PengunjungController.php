<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Requests\Pengunjung\RegisterPengunjungRequest;
use App\Models\Role;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PengunjungController extends Controller
{
    public function Register(RegisterPengunjungRequest $user): RedirectResponse {    

        $role = Role::where("nama_Role", "pengunjung")->first();

        $data = [
            'nomor_telp' => $user->nomor_telepon,
            'password' => Hash::make($user->password),
            'nama' => $user->nama,
            'role' => $role->id
        ];

        return redirect('/pengunjung/activate');
    }
}