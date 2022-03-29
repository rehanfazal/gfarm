<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";

    protected function getOrderItems(){
        return $this->hasMany(OrderItem::class,"order_id","id");
    }
    
    public function getOrderStatus($status){
        // 0 = Pending, 1 = Active, 2 = Confirmed, 3 = Ready, 4 = Delivered, 5 = Completed, 6 = Cancelled
        $orderArray = ["Pending","Pending","Confirmed", "Ready", "Delivered", "Completed", "Cancelled"];
        return $orderArray[$status];
    }
}
