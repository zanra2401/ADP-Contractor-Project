<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\Uid\Ulid;

class Role extends Model
{
    use HasUlids;

    public $incrementing = false;
    protected $table = 'roles';
    protected $keyType = 'string';

    protected $fillable = [
        'nama_role'
    ];

    public function newUniqueId(): string
    {
        return (string) Ulid::generate();
    }

    public function users(): HasMany {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
