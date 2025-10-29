<?php

namespace App\Models;

use Dotenv\Repository\Adapter\GuardedWriter;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    protected $guarded = ['id'];
}
