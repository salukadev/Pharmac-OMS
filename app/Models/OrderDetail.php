<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListning;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'calculatedDiscount',
        'netValue'
    ];
    public function order(){
        return $this->hasOne('App\Order');
    }
    public function productListning(){
        return $this->belongsTo(ProductListning::class);
    }
}
