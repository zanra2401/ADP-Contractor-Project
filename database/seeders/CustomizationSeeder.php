<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Material;

class CustomizationSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();
        $materials = Material::take(3)->get();

        if (!$project || $materials->isEmpty()) {
            throw new \Exception('Seeder Customization: Project atau Materials belum ada.');
        }

        foreach ($materials as $material) {
            DB::table('customizations')->insert([
                'project'  => $project->id,
                'material' => $material->id,
            ]);
        }
    }
}
