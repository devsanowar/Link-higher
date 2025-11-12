<?php
namespace App\Models;

use App\Models\User;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ["id"];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
