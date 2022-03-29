<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";

    protected function getOrder(){
        return $this->hasOne(Order::class,"id","order_id");
    }
    protected function getProduct(){
        return $this->hasOne(Product::class,"id","product_id");
    }
}
