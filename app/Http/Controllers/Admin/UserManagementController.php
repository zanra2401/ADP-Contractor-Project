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
        return view('admin.manajemen-user', compact('users'));
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
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'message' => 'Akun berhasil dihapus'
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            // Misal gagal karena foreign key constraint
            return response()->json([
                'message' => 'Gagal menghapus user karena masih terhubung dengan data lain.',
                'error'   => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
