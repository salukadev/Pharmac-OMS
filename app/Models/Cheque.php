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
        'payment_id',
        'chequeNo',
        'frontImg',
        'backImg',
        'remark',
        'status',
        'agent_Note',
        'admin_Note',
        'cheque_Date',
        'agent_Id',
        'created_at',
    ];
    /**
     * @var mixed
     */

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
