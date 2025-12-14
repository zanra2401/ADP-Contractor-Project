<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\Uid\Ulid;

class Payment extends Model
{   
    use HasUlids;

    protected $table = 'payments';
    protected $keyType = 'string';
    public $incrementing =  false;

    protected $fillable = [
        'project_id',
        'pengunjung_id',
        'total_harga',
        'status',
        'updated_at',
        'created_at'
    ];

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function progresses(): HasMany {
        return $this->hasMany(PaymentProgress::class, 'payment_id', 'id');
    }
}