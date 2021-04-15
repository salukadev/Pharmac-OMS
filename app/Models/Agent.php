<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cheque;
class Agent extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable=[
        'user_id',
        'name',
        'telephone',
        'NIC',
        'BlacklistStatus'
    ];
    public function cheque(){
        return $this->hasMany(Cheque::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customers(){
        return $this->hasMany(customer::class);
    }

}
