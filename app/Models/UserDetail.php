<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;

class UserDetail extends Model
{

    use HasUlids;

    protected $table = 'user_details';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'photo_profile',
        'alamat',
        'created_at',
        'updated_at'
    ];

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}