<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Customer extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'userId',
        'name',
        'approvalStatus',
        'telephone',
        'creditLimit',
        'agentId'
    ];

    //Eloquent relationships
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function rOrders(){
        return $this->hasMany(RecurringOrder::class);
    }
    public function cart(){
        return $this->hasOne(UserCart::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function agent(){
        return $this->belongsTo(agent::class);
    }



}
