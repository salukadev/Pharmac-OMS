<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListning;

class Cart extends Model
{
    use HasFactory;
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function productListning(){
        return $this->hasMany(ProductListning::class);
    }
}
