<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable=[
        'listing_id',
        'quantity'
    ];

    public static function findOrCreate($cart,$listing)
    {
        $obj = static::where('cart_id',$cart)->where('listing_id',$listing);
        return $obj ?: new static;
    }

    public function belongsTo(){
        return $this->belongsTo(ProductListing::class,'listing_id');
    }
}
