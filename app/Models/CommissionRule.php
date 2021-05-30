<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use PhpParser\Builder\Class_;

class CommissionRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'minRefs',
        'pointPerRef',
    ];



    public function calculatedCommission(){
        return $this->hasMany(CalculatedCommission::Class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::Class);
    }
}
