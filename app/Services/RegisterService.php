<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class RegisterService {

    protected $userModel;

    public function createPengunjung(array $data): ?User 
    {
        $role = Role::where('nama_role', '=', 'pengunjung')->first()->id;

        $userData = [
            'role_id' => $role,
            'nomor_telepon' => $data['nomor_telp'],
            'nama' => $data['nama'],
            'password' => Hash::make($data['password'])
        ];

        $created = User::create($userData);

        $created->save();

        return $created;
    }
}