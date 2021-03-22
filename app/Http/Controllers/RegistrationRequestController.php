<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationRequestController extends Controller
{
    public function store(Request $request){
        $validate = $this->validate([
            'telephone'=>'required|numeric|min:9|max:10',
        ]);
    }
}
