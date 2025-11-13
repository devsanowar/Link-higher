<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudy extends Model
{

    use SoftDeletes;
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(CaseStudyCategory::class,'category_id','id');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
}
