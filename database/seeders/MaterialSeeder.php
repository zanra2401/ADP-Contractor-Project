<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\JenisMaterial;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua jenis material
        $beton = JenisMaterial::where('nama', 'Beton')->first();
        $besi = JenisMaterial::where('nama', 'Besi')->first();
        $kayum = JenisMaterial::where('nama', 'Kayu')->first();

        $data = [
            [
                'nama_material' => 'Beton K300',
                'jenis' => $beton->id,
                'harga_per_unit' => 750000.00,
                'satuan' => 'm3',
                'media_path' => 'uploads/materials/beton_k300.jpg',
            ],
            [
                'nama_material' => 'Besi Ulir 12mm',
                'jenis' => $besi->id,
                'harga_per_unit' => 95000.00,
                'satuan' => 'batang',
                'media_path' => 'uploads/materials/besi_ulir_12.jpg',
            ],
            [
                'nama_material' => 'Kayu Balok 6x12',
                'jenis' => $kayum->id ?? 3,
                'harga_per_unit' => 30000.00,
                'satuan' => 'meter',
                'media_path' => 'uploads/materials/kayu_balok_6x12.jpg',
            ],
        ];

        foreach ($data as $item) {
            Material::create($item);
        }
    }
}
