<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListing;
class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'itemCount',
        'freeItem'
    ];

    public function display(){
        return $this->hasMany(ProductListing::class);
    }
}
