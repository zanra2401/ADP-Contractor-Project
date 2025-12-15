<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressLog extends Model
{
    protected $table = "progress_log";

    protected $fillable = [
        "project_id",
        // "pengawas_id",
        "deskripsi",
        "file_path",
        "status_publikasi",
        "tanggal_upload",
        "updated_at"
    ];

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
