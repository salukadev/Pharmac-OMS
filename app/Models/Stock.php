<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductListning;

class Stock extends Model
{
    use HasFactory;

        protected $fillable = [
            'supplier_id',
            'batchNo',
            'category_id',
            'name',
            'brand',
            'unitPrice',
            'mnfDate',
            'expDate'
        ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function supplier(){
            return $this->belongsTo(Supplier::class);
    }
    public function productListning(){
        return $this->hasOne(ProductListning::class);
    }
}
