<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListning;
class Discount extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function productListning(){
        return $this->hasMany(ProductListning::class);
    }
}
