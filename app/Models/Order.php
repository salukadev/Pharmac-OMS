<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\ProductListning;
class Order extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable = [
      'type',
      'status',
      'amount'
    ];
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function productReturn(){
        return $this->belongsTo(ProductListning::class);
    }
    public function orderDetails(){
        return $this->belongsTo(OrderDetail::class);
    }
    public function cart(){
        return $this->hasOne(Cart::class);
    }
}
