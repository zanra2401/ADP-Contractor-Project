<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Project;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();

        if (!$project) {
            throw new \Exception('Seeder Payment: Project belum ada. Jalankan ProjectSeeder dulu.');
        }

        $pengunjung = $project->pengunjung; // relasi ke user

        Payment::create([
            'project_id'   => $project->id,
            'pengunjung_id'=> $pengunjung->id,
            'total_harga'  => $project->harga ?? 250000000.00,
            'status'       => 'progress',
        ]);
    }
}
