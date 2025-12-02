<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesignSpec extends Model
{
    protected $table = 'design_specs';

    protected $fillable = [
        'design_id',
        'spesifikasi',
    ];

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class, 'design_id', 'id');
    }
}
