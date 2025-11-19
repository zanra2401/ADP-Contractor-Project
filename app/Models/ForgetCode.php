<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class ForgetCode extends Model
{

    use HasUuids;

    const UPDATED_AT = null;

    protected $table = 'forget_codes';
    
    protected $fillable = [ 
        'user_id',
        'code',
        'expired_at'
    ];

    public function uniqueIds(): array
    {
        return ['code'];
    }

    public function newUniqueId(): string
    {
        return Uuid::uuid4();
    }

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}