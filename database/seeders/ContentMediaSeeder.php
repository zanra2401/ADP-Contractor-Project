<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Design;
use App\Models\ContentMedia;

class ContentMediaSeeder extends Seeder
{
    public function run(): void
    {
        $designs = Design::all();

        foreach ($designs as $index => $design) {
            ContentMedia::create([
                'design_id'   => $design->id,
                'content_path'=> 'uploads/designs/design_' . ($index + 1) . '.jpg',
            ]);
        }
    }
}
