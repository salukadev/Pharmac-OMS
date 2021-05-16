<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['body'];
    protected $appends = ['selfMessage'];

    //Get current user
    public function getSelfMessageAttribute(){
    $user= Auth::id();
    return $user;
    }

    public function user(){
        return $this->belongsTo(User::class);}


}
