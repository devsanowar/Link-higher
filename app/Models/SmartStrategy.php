<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmartStrategy extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'features' => 'array',
    ];

}
