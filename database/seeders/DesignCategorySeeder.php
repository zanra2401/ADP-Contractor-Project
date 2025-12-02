<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Design;
use App\Models\Category;
use Illuminate\Support\Arr;

class DesignCategorySeeder extends Seeder
{
    public function run(): void
    {
        $designs = Design::all();
        $categories = Category::all()->pluck('id')->toArray();

        foreach ($designs as $design) {

            // Ambil 1–3 kategori random untuk setiap design
            $assignedCategories = Arr::random($categories, rand(1, 3));

            // Insert ke pivot table
            $design->categories()->sync($assignedCategories);
        }
    }
}
