<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return response()->json($users);
    }

    public function store(UserStoreRequest $request)
    {
        $role = Role::where('nama_role', $request->role)->first();

        $user = User::create([
            'role_id' => $role->id,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Akun berhasil dibuat',
            'user' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        return response()->json($user);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->role) {
            $role = Role::where('nama_role', $request->role)->first();
            $user->role_id = $role->id;
        }

        if ($request->nama) $user->nama = $request->nama;
        if ($request->nomor_telepon) $user->nomor_telepon = $request->nomor_telepon;
        if ($request->password) $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'message' => 'Akun berhasil diperbarui',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Akun berhasil dihapus'
        ]);
    }
}
