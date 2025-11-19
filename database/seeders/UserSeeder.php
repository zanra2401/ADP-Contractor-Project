<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil role_id dari tabel roles
        $adminRole = Role::where('nama_role', 'admin')->first()->id;
        $pengawasRole = Role::where('nama_role', 'pengawas')->first()->id;
        $superadminRole = Role::where('nama_role', 'superadmin')->first()->id;
        $customerServiceRole = Role::where('nama_role', 'customer_service')->first()->id;
        // Admin
        User::create([
            'role_id' => $adminRole,
            'nama' => 'Admin Utama',
            'nomor_telepon' => '081111111110',
            'password' => Hash::make('admin123'),
        ]);

        // Pengawas
        User::create([
            'role_id' => $pengawasRole,
            'nama' => 'Pengawas Lapangan',
            'nomor_telepon' => '081111111111',
            'password' => Hash::make('pengawas123'),
        ]);

        // Customer Service
        User::create([
            'role_id' => $customerServiceRole,
            'nama' => 'Customer Service',
            'nomor_telepon' => '081111111112',
            'password' => Hash::make('customerservicce123'),
        ]);

        // Superadmin
        User::create([
            'role_id' => $superadminRole,
            'nama' => 'Super Admin',
            'nomor_telepon' => '081111111113',
            'password' => Hash::make('superadmin123'),
        ]);
    }
}
