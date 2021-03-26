<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    protected $fillable = [
        'customer_id',
        'cart_id'
      ];
    use HasFactory;
}
