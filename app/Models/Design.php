<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;
use App\Models\Users;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Mail\Mailables\Content;

class Design extends Model
{
    use HasUlids;

    protected $table = 'designs';    
    public $incrementing = false;

    protected $fillable = [
        "created_by",
        "nama",
        "deskripsi",
        "harga",
        'file_path'
    ];

    protected $keyType =  'string';

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function contents(): HasMany {
        return $this->hasMany(ContentMedia::class, 'design_id', 'id');
    }
}