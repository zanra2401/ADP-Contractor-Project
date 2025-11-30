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
        return User::with('role')->get();
    }

    // Create a new user
    public function createUser(array $data)
    {
        // Validasi role
        $role = Role::find($data['role_id']);
        if (!$role) {
            throw new \Exception("Role tidak ditemukan");
        }

        return User::create([
            'role_id'       => $data['role_id'],
            'nama'          => $data['nama'],
            'nomor_telepon' => $data['nomor_telepon'],
            'password'      => Hash::make($data['password']),
        ]);
    }

    public function getUserById(string $id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            throw new \Exception("User tidak ditemukan");
        }

        return $user;
    }

    // Update user
    public function updateUser(string $id, array $data)
    {
        $user = User::find($id);

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
        $user = User::find($id);

        if (!$user) {
            throw new \Exception("User tidak ditemukan");
        }

        return $user->delete();
    }
}
