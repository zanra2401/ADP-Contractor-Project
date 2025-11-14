<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentMedia extends Model
{
    protected $table = 'content_media';
    
    protected $fillable = [
        'design_id',
        'content_path',
        'created_at',
        'updated_at'
    ];

    public function design(): BelongsTo {
        return $this->belongsTo(Design::class, 'design_id', 'id');
    }
}