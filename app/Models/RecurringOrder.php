<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'customer_id',
        'endDate',
        'cart_id',
        'frequency'
      ];

    //Eloquent relationships
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    //Format date-time
    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
        'endDate' => 'datetime:Y-m-d',
    ];
}
