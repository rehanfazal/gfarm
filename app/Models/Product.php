<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected function getCategory(){
        return $this->hasOne(Services::class,"id","category_id");
    }
}
