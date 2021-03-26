<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringOrder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'endDate',
        'cart_id',
        'frequency'
      ];

    //Eloquent relationships
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
