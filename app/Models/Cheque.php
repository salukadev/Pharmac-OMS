<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\Agent;

class Cheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'chequeNo',
        'frontImg',
        'backImg',
        'remark',
        'status',
        'agentNote',
        'adminNote'
    ];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
