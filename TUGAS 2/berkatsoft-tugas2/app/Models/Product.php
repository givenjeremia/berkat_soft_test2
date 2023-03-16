<?php

namespace App\Models;

use App\Models\Sales_Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public function sales_orders(){
        return $this->belongsToMany(Sales_Order::class,'sales_order_customer','products_id','sales_orders_id')->withPivot('qty','sub_total');
    }
}
