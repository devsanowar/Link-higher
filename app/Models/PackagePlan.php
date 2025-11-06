<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePlan extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $casts = [
        'features'    => 'array',
        'is_free'     => 'boolean',
        'is_popular'  => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
