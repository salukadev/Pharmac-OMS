<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'paymentId',
        'payment_Type',
        'amount',
        'date'];

public function order(){
    return $this->hasMany('App\Order');
}
}

