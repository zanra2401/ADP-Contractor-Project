<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama' => 'Minimalis'],
            ['nama' => 'Eco-Friendly'],
            ['nama' => 'Modern'],
            ['nama' => 'Industrial'],
            ['nama' => 'Skandinavia'],
            ['nama' => 'Klasik'],
            ['nama' => 'Mewah'],
            ['nama' => 'Vintage'],
            ['nama' => 'Tropis'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
