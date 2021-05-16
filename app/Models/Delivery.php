<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Delivery extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'order_id',
        'date',
        'deliveryStatus',
    ];

    public function order(){
        return $this->hasOne(Order::class);
    }
}
