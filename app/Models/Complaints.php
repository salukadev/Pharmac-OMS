<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $fillable=[
        'category',
        'message'
    ];

    public function user(){
        return $this->belongsto(User::class);
    }
    
    
}
