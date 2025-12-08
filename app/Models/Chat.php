<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;
use Illuminate\Support\Facades\Auth;
 
class Chat extends Model
{
    use HasUlids;

    protected $table = 'chats';

    protected $keyType = 'string';

    protected $fillable = [ 
        "pengirim_id",
        "penerima_id",
        "media_path",
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

    public static function getMessageWith($receiver): Collection {
        $myId = Auth::id();

        return Chat::where(function ($query) use ($myId, $receiver) {
                // Kondisi 1: Saya kirim ke Dia
                $query->where('pengirim_id', $myId)
                    ->where('penerima_id', $receiver);
            })
            ->orWhere(function ($query) use ($myId, $receiver) {
                // Kondisi 2: Dia kirim ke Saya
                $query->where('pengirim_id', $receiver)
                    ->where('penerima_id', $myId);
            })
            ->orderBy('waktu_kirim', 'asc')
            ->get();
    }

    public static function getLastMessageWith($receiver): Chat|null {
        return Chat::where(function ($query) use ($receiver) { 
            $query->where('pengirim_id', Auth::id())->where('penerima_id', $receiver);
        })->orWhere(function ($query) use ($receiver) {
            $query->where('pengirim_id', $receiver)->where('penerima_id', Auth::id());
        })->orderBy('waktu_kirim', 'desc')->first();
    }

    public static function getUnreadMessagesWith($sender): Collection {
        return Chat::where('pengirim_id', $sender)->where('penerima_id', Auth::id())
            ->where('status', 'terkirim')->get();
    }
}