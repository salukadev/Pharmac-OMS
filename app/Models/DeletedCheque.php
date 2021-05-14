<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedCheque extends Model
{
    use HasFactory;
    protected $fillable=[
        'chequeNo',
        'payment_id',
        'agent_id',
        'admin_id',
        'frontImg',
        'backImg',
        'agent_Note',
        'admin_Note',
        'created_Date'
    ];
}
