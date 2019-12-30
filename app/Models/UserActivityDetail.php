<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityDetail extends Model
{
    protected $fillable = ['user_id','type','ip_address','comment'];
    protected $table = "user_activity_details";
}
