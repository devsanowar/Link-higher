<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(ProjectCategory::class, 'category_id', 'id');
    }

    protected $casts = [
        'images' => 'array',
    ];
}
