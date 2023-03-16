<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    
    public function sales_orders(){
        return $this->hasMany(Product::class,'customers_id','id');
    }

    
}
