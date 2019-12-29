<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, Notifiable;
    protected $fillable = ['firstname','lastname','email','password','contact','dob','country','state','city','pincode','address','email_verified','status'];
    protected $table = "users";
}
