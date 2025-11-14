<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;

class Chat extends Model
{
    use HasUlids;

    protected $table = 'chats';

    protected $keyType = 'string';

    protected $fillable = [ 
        "pengirim_id",
        "penerima_id",
        "pesan",
        "waktu_kirim",
        "status",
        "updated_at"
    ];

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function sender(): BelongsTo {
        return $this->belongsTo(User::class, 'pengirim_id', 'id');
    }

    public function receiver(): BelongsTo {
        return $this->belongsTo(User::class, 'penerima_id', 'id');
    }
}