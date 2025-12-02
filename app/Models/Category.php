<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ['nama', 'slug'];

    public function designs(): BelongsToMany
    {
        return $this->belongsToMany(Design::class, 'category_design', 'category_id', 'design_id');
    }
}
