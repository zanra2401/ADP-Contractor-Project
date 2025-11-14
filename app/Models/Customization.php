<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    protected $table = "customizations";
    protected $fillable = [ 
        'project',
        'material'
    ];
}
