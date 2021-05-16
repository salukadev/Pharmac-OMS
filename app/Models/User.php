<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userType',
        'userName',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //one to one relationship with agent
    public function agent(){
        return $this->hasOne(Agent::class);
    }

    public function customer(){
        return $this ->hasOne(Customer::class);
    }

    //one to may relationship with product requests
    public function productRequest(){
        return $this->hasMany(ProductRequest::class);
    }

    public function complaints(){
        return $this->hasmany(Complaints::class);
    }


}
