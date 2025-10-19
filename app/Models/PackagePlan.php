<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePlan extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'features'    => 'array',
        'is_free'     => 'boolean',
        'is_popular'  => 'boolean',
        'is_active'   => 'boolean',
    ];
}
