<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discount;
use App\Models\Stock;
use App\Models\OrderDetail;
use App\Models\Cart;

class ProductListing extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'imagePath',
        'unitPrice',
    ];
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
    public function stock(){
        return $this->belongsTo(Stock::class);
    }
    public function orderDetail(){
        return $this->hasOne(OrderDetail::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
