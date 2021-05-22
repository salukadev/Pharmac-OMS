<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
   // public function store(Request $request){
     //   $validate = $request->validate([
            //    'telephone' => 'required|string|min:9|max:10',
     //   ]);
   // }

    public function display(){
        $Cus = Customer::all();
        return inertia::render('ClientRegister/CustomerDetail',['Cus_Details'=>$Cus]);
    }

    public function edit(Request $REQUEST){
        return Inertia::render('ClientRegister/CustomerRegistrationForm',['Reg'=>$REQUEST]);
    }

    public function deleteCustomerDetails($id){

        Customer::where('id', $id)->delete();
        return redirect::route('display');

    }

    public function create(){

        return inertia::render('ClientRegister/CustomerRegistrationForm',[]);
    }

}
