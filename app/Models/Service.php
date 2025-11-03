<?php

namespace App\Models;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    // protected $casts = [
    //     'service_features' => 'array',
    // ];

    public function ServiceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

}



