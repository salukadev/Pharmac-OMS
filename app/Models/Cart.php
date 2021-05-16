<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListing;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'type'
      ];

    public function productListing(){
        return $this->hasMany(ProductListing::class);
    }

    public function items(){
        return $this->hasMany(CartItem::class);
    }
}
