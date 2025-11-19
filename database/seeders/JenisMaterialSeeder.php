<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisMaterial;

class JenisMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Beton'],
            ['nama' => 'Besi'],
            ['nama' => 'Kayu'],
            ['nama' => 'Batu Bata'],
            ['nama' => 'Genteng'],
            ['nama' => 'Cat'],
            ['nama' => 'Semen'],
            ['nama' => 'Pasir'],
        ];

        foreach ($data as $item) {
            JenisMaterial::create($item);
        }
    }
}
