<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nama_role' => 'admin'],
            ['nama_role' => 'pengawas'],
            ['nama_role' => 'customer_service'],
            ['nama_role' => 'pengunjung'],
            ['nama_role' => 'superadmin']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
