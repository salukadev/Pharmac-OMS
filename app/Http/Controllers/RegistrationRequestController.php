<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegistrationRequestController extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */

//display  registration request function define
    public function display(){
        $Reg = RegistrationRequest::all();
        return inertia::render('RegistrationRequest/RegistrationRequest',['Reg_Details'=>$Reg]);
    }



    //display customer details
    public function displaycustomer(){

        $Customer = User::join('customers', 'users.id', '=', 'customers.user_id')
            ->where('users.userType', '=', 'customer')
            ->get(['users.id', 'users.email', 'users.userName', 'users.password', 'customers.name', 'customers.telephone', 'customers.creditLimit']);


        return Inertia::render('Client/Customer/CustomerDetails',[
            'cus' => $Customer,
        ]);
    }

    //create function define
    public function create(){

        return inertia::render('RegistrationRequest/Create_Registration_Request',[]);
    }

    //edit function define
    public function edit(Request $REQUEST){
        return Inertia::render('RegistrationRequest/Edit_Registration_Request',['Reg'=>$REQUEST]);
    }


    //update function define
    public function update(Request $REQUEST){

        //backend validation
        $validated = $REQUEST->validate([
            'name' => 'required',
            'address'=> 'required',
            'cusType'=> 'required',
            'telephone'=> 'required',

        ]);

        if($REQUEST->has('requestId')){
            RegistrationRequest::where('requestId',$REQUEST->input('requestId'))->update([

                'status' => $REQUEST->input('status'),

            ]);
            return redirect::route('displayRequest');
        }

    }

   //add function define
    public function add(Request $REQUEST){
        $Reg= new RegistrationRequest();
        $Reg->name = $REQUEST->name;
        $Reg->address = $REQUEST->address;
        $Reg->cusType = $REQUEST->cusType;
        $Reg->telephone = $REQUEST->telephone;

        $Reg->save();

        return redirect()->route('login');
    }

    //delete function define
    public function deleteRegistrationRequest($id){

        RegistrationRequest::where('requestId', $id)->delete();
        return redirect::route('displayRequest');

    }
}
