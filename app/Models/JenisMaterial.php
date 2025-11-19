<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisMaterial extends Model
{
    public $timestamps = false;
    /**
     * Nama Table yang bersangkutan
     *
     * @var string
     */
    protected $table = "jenis_material";

    protected $fillable = [
        'nama'
    ];

    public function materials(): HasMany {
        return $this->hasMany(Material::class, 'jenis', 'id');
    }
}
