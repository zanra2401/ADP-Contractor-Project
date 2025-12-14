<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;

class PaymentProgress extends Model
{
    use HasUlids;

    protected $table = 'payment_progress';
    protected $keyType =  'string';
    public $incrementing = false;

    protected $fillable = [
        'payment_id',
        'jumlah',
        'metode',
        'status',
        'deskripsi',
        'created_at',
        'updated_at'
    ];

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function payment(): BelongsTo {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}