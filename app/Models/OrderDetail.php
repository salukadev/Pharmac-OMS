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
        'listed_price',
        'productListing_id'
    ];
    
    //Eloquent relationships
    public function listing(){
        return $this->belongsTo(ProductListing::class,'productListing_id');
    }
}
