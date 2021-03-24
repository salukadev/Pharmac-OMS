<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'userId',
        'generic',
        'brand',
        'description'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
