<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable=[
        'agentId',
        'name',
        'telephone',
        'NIC',
        'BlacklistStatus'
    ];
    public function cheque(){
        return $this->hasMany('App\Cheque');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
