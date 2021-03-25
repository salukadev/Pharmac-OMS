<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'userId',
        'name',
        'approvalStatus',
        'telephone',
        'creditLimit',
        'agentId'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function recurringOrder(){
        return $this->hasMany(RecurringOrder::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function agent(){
        return $this->belongsTo(agent::class);
    }
}
