<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = "user_addresses";
    
    protected function getUser(){
        return $table->hasOne(Users::class,'id','user_id');
    }
}
