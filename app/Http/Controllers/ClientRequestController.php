<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationRequest;
use Inertia\Inertia;

class ClientRequestController extends Controller
{
    public function display(){
         $Reg = RegistrationRequest::all();
        //return inertia::render('complaints/Complaint',['complaints'=>$complaint]);
    }

    public function add(Request $REQUEST){
        $Reg= new RegistrationRequest();
        $Reg->name = $REQUEST->name;
        $Reg->address = $REQUEST->address;
        $Reg->customerType = $REQUEST->customerType;
        $Reg->telephone = $REQUEST->telephone;

        $Reg->save();
    }
}
