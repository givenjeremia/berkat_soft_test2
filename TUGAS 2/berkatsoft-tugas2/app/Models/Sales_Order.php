<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales_Order extends Model
{
    use HasFactory;
    protected $table = 'sales_orders';

    public function products(){
        return $this->belongsToMany(Product::class,'sales_order_customer','sales_orders_id','products_id')->withPivot('qty','sub_total');
    }
    public function customers(){
        return $this->belongsTo(Customer::class,'customers_id');
    }
}
