<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SuperAdminService
{
    public function getAllUsers()
    {
        return User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('nama_role', 'admin');
            })
            ->get();
    }


    // Create a new user
    public function createUser(array $data)
    {
        // Ambil role Admin otomatis
        $role = Role::where('nama_role', 'admin')->first();

        if (!$role) {
            throw new \Exception("Role Admin tidak ditemukan");
        }

        return User::create([
            'role_id'       => $role->id, // dipaksa jadi Admin
            'nama'          => $data['nama'],
            'nomor_telepon' => $data['nomor_telepon'],
            'password'      => Hash::make($data['password']),
        ]);
    }


    public function getUserById(string $id)
    {
        $user = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('nama_role', 'admin');
            })
            ->find($id);


        if (!$user) {
            throw new \Exception("User tidak ditemukan");
        }

        return $user;
    }

    // Update user
    public function updateUser(string $id, array $data)
    {
        $user = User::whereHas('role', function ($q) {
            $q->where('nama_role', 'admin');
        })
            ->find($id);


        if (!$user) {
            throw new \Exception("User tidak ditemukan");
        }

        // Validasi role jika ada input role_id
        if (isset($data['role_id'])) {
            $role = Role::find($data['role_id']);
            if (!$role) {
                throw new \Exception("Role tidak ditemukan");
            }
        }

        // Hash password jika dikirim
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user->fresh('role');
    }

    // Delete user
    public function deleteUser(string $id)
    {
        $user = User::whereHas('role', function ($q) {
            $q->where('nama_role', 'admin');
        })
            ->find($id);


        if (!$user) {
            throw new \Exception("User tidak ditemukan");
        }

        return $user->delete();
    }
}
