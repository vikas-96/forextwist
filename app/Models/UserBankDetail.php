<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
    protected $table = "user_bank_details";
    protected $fillable = ['user_id','nick_name','bank_name','account_name','account_number','ifsc_code','branch_name','country','state','city'];
}
