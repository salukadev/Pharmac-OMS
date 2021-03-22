<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustommerController extends Controller
{
    public function store(Request $request){
        $validate = $request->validate([
                'telephone' => 'required|string|min:9|max:10',
        ]);
    }
}
