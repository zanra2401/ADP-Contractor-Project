<?php

namespace App\Services;

use App\Models\ProgressLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProgressService
{
    // Create a new progress entry.
    public function create(array $data): ProgressLog
    {
        if (empty($data['tanggal_upload'])) {
            $data['tanggal_upload'] = Carbon::now();
        }

        $payload = [
            'id'               => Str::random(26),
            'project_id'       => $data['project_id'],
            'deskripsi'        => $data['deskripsi'] ?? null,
            'file_path'        => $data['file_path'] ?? null,
            'status_publikasi' => $data['status_publikasi'] ?? 'menunggu',
            'tanggal_upload'   => $data['tanggal_upload'],
            'updated_at'       => now(),
            'created_at'       => now(),
        ];

        return ProgressLog::create($payload);
    }

    // Get all progress entries for a project.
    public function getByProject(string $projectId): Collection
    {
        return ProgressLog::where('project_id', $projectId)
            ->orderBy('tanggal_upload', 'desc')
            ->get();
    }

    // Get single progress entry by ID.
    public function getById(string $id): ProgressLog
    {
        return ProgressLog::findOrFail($id);
    }

    public function getProgressPengunjung()
    {
        return ProgressLog::with([
            'project.pengunjung.role'
        ])
            ->whereHas('project.pengunjung.role', function ($q) {
                $q->where('nama_role', 'pengunjung');
            })
            ->orderBy('tanggal_upload', 'desc')
            ->get();
    }

    // Update progress entry.
    public function update(string $id, array $data): ProgressLog
    {
        $progress = ProgressLog::findOrFail($id);

        // Only update allowed fields
        $up = [];
        if (array_key_exists('deskripsi', $data)) {
            $up['deskripsi'] = $data['deskripsi'];
        }
        if (array_key_exists('file_path', $data)) {
            $up['file_path'] = $data['file_path'];
        }
        if (array_key_exists('status_publikasi', $data)) {
            $up['status_publikasi'] = $data['status_publikasi'];
        }
        if (array_key_exists('tanggal_upload', $data)) {
            $up['tanggal_upload'] = $data['tanggal_upload'];
        }

        if (!empty($up)) {
            $progress->update($up);
        }

        return $progress->fresh();
    }

    // Delete progress entry.
    public function delete(string $id): ?bool
    {
        $progress = ProgressLog::findOrFail($id);

        // optionally delete the file from storage if exists
        if ($progress->file_path) {
            try {
                // assume file_path is storage path like 'progress/xxxx.jpg' on 'public' disk
                Storage::disk('public')->delete($progress->file_path);
            } catch (\Throwable $e) {
                // ignore deletion error; proceed to delete DB row
            }
        }

        return $progress->delete();
    }

    // Store uploaded file and return the storage path.
    public function storeUploadedFile($file): string
    {
        // store on 'public' disk under folder 'progress'
        // adjust disk/folder as needed for your project
        return $file->store('progress', 'public');
    }
}
