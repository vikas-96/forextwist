<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, Notifiable;
    protected $fillable = ['account_no','firstname','lastname','email','password','contact','dob','country','state','city','pincode','address','email_verified','status'];
    protected $table = "users";

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getCountry(){
        return $this->hasOne('App\Models\Country','id','country');
    }

    public function getState(){
        return $this->hasOne('App\Models\State','id','state');
    }

}
