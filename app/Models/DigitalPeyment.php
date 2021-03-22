<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalPeyment extends Model
{
    use HasFactory;
    protected $fillable =[
        'transactionId',
        'paymentId',
        'remark',
        'status',
    ];

}
