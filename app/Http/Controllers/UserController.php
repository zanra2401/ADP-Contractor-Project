<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    public function createPengunjung(
        Request $request, 
        RegisterService $registerService
    ): RedirectResponse {    

        $data = [
            'nomor_telp' => $request->input('nomor_telp'),
            'password' => $request->input('password'),
            'nama' => $request->input('nama')
        ];

        $registerService->createPengunjung($data);

        return redirect('/pengunjung/activate');
    }
}