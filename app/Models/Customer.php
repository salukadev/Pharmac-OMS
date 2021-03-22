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
    public function customer(){
        return $this->hasMany('App\Order');
    }
    public function recurringOrder(){
        return $this->hasMany('App\RecurringOrder');
    }
    public function cart(){
        return $this->belongsTo('App\Cart');
    }
}
