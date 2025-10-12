<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(CaseStudyCategory::class,'category_id','id');
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
}
