<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function payment(){
        return $this->belongsTo('App\Payment');
    }
    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function productReturn(){
        return $this->belongsTo('App\ProductReturn');
    }
    public function orderDetails(){
        return $this->belongsTo('App\OrderDetail');
    }
    public function cart(){
        return $this->hasOne('App\Order');
    }
}
