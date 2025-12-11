<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForgetCode extends Model
{
    protected $table = 'forget_codes';
    public $timestamps = false;

    protected $fillable = [ 
        'user_id',
        'code',
        'expired_at',
        'created_at'
    ];

    protected static function booted()
    {
        static::creating(function ($forgetCode) {
            $forgetCode->created_at = Carbon::now();

            // Jika expired_at belum diset, otomatis 5 menit
            if (!$forgetCode->expired_at) {
                $forgetCode->expired_at = Carbon::now()->addMinutes(5);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
