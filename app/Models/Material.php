<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $table = 'materials';

    protected $fillable = [
        'nama_material',
        'jenis',
        'harga_per_unit',
        'satuan',
        'media_path',
        'created_by',
    ];

    public function jenis(): BelongsTo {
        return $this->belongsTo(JenisMaterial::class, 'jenis', 'id');
    }
}
