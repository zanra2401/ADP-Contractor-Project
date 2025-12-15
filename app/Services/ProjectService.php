<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Payment;
use App\Models\Customization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectService
{
    public function list()
    {
        return Project::with(['pengawas', 'pengunjung', 'design', 'materials'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            // Create project
            $project = Project::create([
                'pengawas_id'      => $data['pengawas_id'],
                'pengunjung_id'    => $data['pengunjung_id'],
                'design_id'        => $data['design_id'],
                'nama_proyek'      => $data['nama_proyek'],
                'deskripsi'        => $data['deskripsi'],
                'harga'            => $data['harga'],
                'alamat'           => $data['alamat'],
                'tanggal_mulai'    => $data['tanggal_mulai'],
                'tanggal_selesai'  => $data['tanggal_selesai'],
            ]);

            // Insert pivot (customizations)
            if (!empty($data['materials'])) {
                foreach ($data['materials'] as $materialId) {
                    Customization::create([
                        'project'  => $project->id,
                        'material' => $materialId
                    ]);
                }
            }

            // Auto-create Payment for this project
            Payment::create([
                'project_id'    => $project->id,
                'pengunjung_id' => $project->pengunjung_id,
                'total_harga'   => $data['harga'] ?? 0,
                'status'        => 'progress',
            ]);

            return $project->load(['materials']);
        });
    }

    public function update(Project $project, array $data)
    {
        return DB::transaction(function () use ($project, $data) {

            $project->update([
                'pengawas_id'      => $data['pengawas_id'],
                'pengunjung_id'    => $data['pengunjung_id'],
                'design_id'        => $data['design_id'],
                'nama_proyek'      => $data['nama_proyek'],
                'deskripsi'        => $data['deskripsi'],
                'harga'            => $data['harga'],
                'alamat'           => $data['alamat'],
                'tanggal_mulai'    => $data['tanggal_mulai'],
                'tanggal_selesai'  => $data['tanggal_selesai'],
            ]);

            // Clear old materials
            Customization::where('project', $project->id)->delete();

            // Insert new pivot materials
            if (!empty($data['materials'])) {
                foreach ($data['materials'] as $materialId) {
                    Customization::create([
                        'project'  => $project->id,
                        'material' => $materialId
                    ]);
                }
            }

            return $project->load(['materials']);
        });
    }

    public function delete(Project $project)
    {
        return DB::transaction(function () use ($project) {

            Customization::where('project', $project->id)->delete();
            $project->delete();

            return true;
        });
    }
}
