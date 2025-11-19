<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgressLog;
use App\Models\Project;
use Carbon\Carbon;

class ProgressLogSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();

        if (!$project) {
            throw new \Exception("Project tidak ditemukan. Jalankan ProjectSeeder dulu.");
        }

        ProgressLog::create([
            'id' => 1,
            'project_id' => $project->id,
            'deskripsi' => 'Pondasi selesai dikerjakan.',
            'file_path' => 'uploads/progress/pondasi.jpg',
            'status_publikasi' => 'disetujui',
            'tanggal_upload' => Carbon::now(),
        ]);

        ProgressLog::create([
            'id' => 2,
            'project_id' => $project->id,
            'deskripsi' => 'Pemasangan struktur lantai 1.',
            'file_path' => 'uploads/progress/lantai1.jpg',
            'status_publikasi' => 'menunggu',
            'tanggal_upload' => Carbon::now()->addDays(3),
        ]);
    }
}
