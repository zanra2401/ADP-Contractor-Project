<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class ForgetCode extends Model
{

    use HasUuids;

    protected $table = 'forget_codes';
    public $timestamps = false;

    protected $fillable = [ 
        'user_id',
        'code',
        'expired_at',
        'created_at'
    ];

    public static function booted()
    {
        static::creating(function ($forgetCode) {
            $forgetCode->created_at = Carbon::now();
        });
    }

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