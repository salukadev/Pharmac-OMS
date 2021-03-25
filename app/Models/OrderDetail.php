<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListing;

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
    public function productListing(){
        return $this->belongsTo(ProductListing::class);
    }
}
