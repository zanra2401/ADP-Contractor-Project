<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Design;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $pengawas = User::whereHas('role', fn($q) => $q->where('nama_role', 'pengawas'))->first();
        $pengunjung = User::whereHas('role', fn($q) => $q->where('nama_role', 'pengunjung'))->first();
        $design = Design::first();

        Project::create([
            'pengawas_id' => $pengawas->id,
            'pengunjung_id' => $pengunjung->id,
            'design_id' => $design->id,
            'nama_proyek' => 'Pembangunan Rumah Minimalis',
            'deskripsi' => 'Proyek pembangunan rumah tipe minimalis modern.',
            'harga' => 250000000.00,
            'alamat' => 'Jl. Mawar No.123',
            'file_path' => 'projects/rumah_minimalis.pdf',
            'tanggal_mulai' => Carbon::now(),
            'tanggal_selesai' => Carbon::now()->addMonths(3),
        ]);
    }
}
