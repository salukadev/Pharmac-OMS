<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\ProductListing;
class Order extends Model
{
    use HasFactory;
    //public $timestamps=false;

    protected $fillable = [
        'user_id',
      'type',
      'status',
      'amount',
    ];

    //Eloquent relationships
    public function payment(){
        return $this->hasOne(Payment::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'user_id');
    }
    public function productReturn(){
        return $this->hasOne(ProductReturn::class);
    }
    public function items(){
        return $this->hasMany(OrderDetail::class);
    }

    //Format date-time

    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];
}
