<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\Uid\Ulid;

class Project extends Model
{

    use HasUlids;

    protected $table = 'projects';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [ 
        "pengawas_id",
        "pengunjung_id",
        "design_id",
        "deskripsi",
        "nama_proyek",
        "harga",
        "alamat",
        "tanggal_mulai",
        "tanggal_selesai",
        "updated_at",
    ];

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function pengawas(): BelongsTo {
        return $this->belongsTo(User::class, 'pengawas_id', 'id');
    }

    public function pengunjung(): BelongsTo {
        return $this->belongsTo(User::class, 'pengunjung_id', 'id');
    }

    public function design(): BelongsTo {
        return $this->belongsTo(Design::class, 'design_id', 'id');
    }

    public function materials(): BelongsToMany {
        return $this->belongsToMany(Material::class, 'customizations', 'project', 'material');
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class, 'project_id', 'id');
    }

    public function progresses(): HasMany {
        return $this->hasMany(ProgressLog::class, 'project_id', 'id');
    }
}