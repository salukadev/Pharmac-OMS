<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'chequeNo',
        'paymentId',
        'frontImg',
        'backImg',
        'remark',
        'status',
        'agentId',
        'agentNote',
        'adminId',
        'adminNote'
    ];

    public function agent(){
        return $this->belongsTo('App\Agent');
    }
    public function admin(){
        return $this->belongsTo('App\Admin');
    }
}
