<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;
use App\Models\Users;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Design extends Model
{
    use HasUlids;

    protected $table = 'designs';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'created_by',
        'nama',
        'deskripsi',
        'harga',
    ];

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Banyak gambar
    public function contents(): HasMany {
        return $this->hasMany(ContentMedia::class, 'design_id', 'id');
    }

    // Banyak spesifikasi
    public function specs(): HasMany {
        return $this->hasMany(DesignSpec::class, 'design_id', 'id');
    }

    // Banyak kategori (many-to-many)
    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_design', 'design_id', 'category_id');
    }
}
