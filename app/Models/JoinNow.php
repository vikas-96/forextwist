<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JoinNow extends Model
{
    use SoftDeletes;
    protected $table = 'join_now';
    protected $fillable = ['name','email','country','contact'];

    public function getCountry(){
        return $this->hasOne('App\Models\Country','id','country');
    }

}
