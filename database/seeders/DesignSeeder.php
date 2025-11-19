<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Design;
use App\Models\User;

class DesignSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama untuk created_by
        $admin = User::first(); // atau where role admin

        if (!$admin) {
            throw new \Exception("User tidak ditemukan. Jalankan UserSeeder dulu.");
        }

        $designs = [
            [
                'created_by' => $admin->id,
                'nama' => 'Desain Rumah Minimalis 1',
                'harga' => 150000000.00,
                'deskripsi' => 'Desain rumah minimalis modern dengan 2 kamar tidur dan 1 kamar mandi.'
            ],
            [
                'created_by' => $admin->id,
                'nama' => 'Desain Rumah Tipe 36',
                'harga' => 180000000.00,
                'deskripsi' => 'Rumah tipe 36 cocok untuk keluarga kecil dengan konsep open space.'
            ],
            [
                'created_by' => $admin->id,
                'nama' => 'Desain Rumah Modern 2 Lantai',
                'harga' => 350000000.00,
                'deskripsi' => 'Desain modern 2 lantai dengan 3 kamar tidur dan balkon depan.'
            ],
        ];

        foreach ($designs as $design) {
            Design::create($design);
        }
    }
}
