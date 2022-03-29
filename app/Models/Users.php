<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    
    protected function getSPServices(){
        return $this->belongsToMany(Services::class,'provider_services','sp_id','service_id');
    }

    protected function getAddresses(){
        return $this->hasMany(UserAddress::class,'user_id','id');
    }
    protected function getUserDetails(){
        return $this->hasOne(UserDetails::class,'user_id','id');
    }
}
