<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegistrationRequestController extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        //$validate = $this->validate([
           // 'telephone'=>'required|numeric|min:9|max:10',
       // ]);
    }

    public function display(){
        $Reg = RegistrationRequest::all();
        return inertia::render('RegistrationRequest/RegistrationRequest',['Reg_Details'=>$Reg]);
    }

    public function displaycustomer(){
        $Cus = Customer::all();
        return inertia::render('ClientRegister/CustomerDetail',['Cus_Details'=>$Cus]);
    }

    public function create(){

        return inertia::render('RegistrationRequest/Create_Registration_Request',[]);
    }

    public function edit(Request $REQUEST){
        return Inertia::render('RegistrationRequest/Edit_Registration_Request',['Reg'=>$REQUEST]);
    }

    public function update(Request $REQUEST){

        if($REQUEST->has('requestId')){
            RegistrationRequest::where('requestId',$REQUEST->input('requestId'))->update([

                'status' => $REQUEST->input('status'),

            ]);
            return redirect::route('displayRequest');
        }

    }


    public function add(Request $REQUEST){
        $Reg= new RegistrationRequest();
        $Reg->name = $REQUEST->name;
        $Reg->address = $REQUEST->address;
        $Reg->cusType = $REQUEST->cusType;
        $Reg->telephone = $REQUEST->telephone;

        $Reg->save();

        return redirect()->route('displayRequest');
    }

    public function deleteRegistrationRequest($id){

        RegistrationRequest::where('requestId', $id)->delete();
        return redirect::route('displayRequest');

    }
}
