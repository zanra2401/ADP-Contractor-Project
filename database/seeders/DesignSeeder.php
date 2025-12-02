<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ContentMedia;
use App\Models\Design;
use App\Models\DesignSpec;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DesignSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // pastikan ada user dulu
        if (!$user) return;

        // kategori
        $minimalis = Category::firstOrCreate(
            ['slug' => 'minimalis'],
            ['nama' => 'Minimalis']
        );
        $eco = Category::firstOrCreate(
            ['slug' => 'eco-friendly'],
            ['nama' => 'Eco-Friendly']
        );

        // desain utama
        $design = Design::create([
            'created_by' => $user->id,
            'nama'       => 'Rumah Minimalis Modern Tipe 45',
            'deskripsi'  => 'Desain hunian kompak yang dirancang khusus untuk keluarga muda di area perkotaan...',
            'harga'      => 350000000,
        ]);

        // spesifikasi (satu kolom spesifikasi)
        $specs = [
            '2 Kamar Tidur',
            '1 Kamar Mandi',
            'Luas Bangunan 45m²',
            'Carport 1 Mobil',
        ];

        foreach ($specs as $s) {
            DesignSpec::create([
                'design_id'   => $design->id,
                'spesifikasi' => $s,
            ]);
        }

        // gambar–gambar (nanti siapkan file di storage/app/public/designs/...)
        $images = [
            'designs/minimalis_main.jpg',
            'designs/minimalis_interior1.jpg',
            'designs/minimalis_interior2.jpg',
        ];

        foreach ($images as $path) {
            ContentMedia::create([
                'design_id' => $design->id,
                'file_path' => $path,
            ]);
        }

        // relasi kategori
        $design->categories()->sync([$minimalis->id, $eco->id]);
    }
}
