<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;

    

    protected $fillable=[
        'order_id',
        'reason',
        'date',
        'remark',
        'type',
        'returnStatus',
    ];

    public function Order(){
        return $this->belongsTo(Order::class);
    }
}
