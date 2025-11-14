<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\Uid\Ulid;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasUlids;

    protected $table = 'users';
    protected $keyType =  'string';
    
    protected $fillable = [
        'role_id', 
        'nama',
        'nomor_telpon',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function newUniqueId(): string
    {
        return Ulid::generate();
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function designs(): HasMany {
        return $this->hasMany(Material::class, 'created_by', 'id');
    }

    public function activeForgetCode(): HasOne {
        return $this->hasOne(ForgetCode::class, 'user_id', 'id')->where('expired_at', '>', now())->latest('created_at');
    }
}
