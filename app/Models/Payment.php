<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'payment_Type',
        'amount',
        'date'];

public function order(){
    return $this->hasMany(Order::class);
}
}

