<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\StaffAcc;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use phpDocumentor\Reflection\Types\Integer;

class SubRole_Controller extends Controller
{
    public function displaySubroles() //display all Staff Member details
    {
        $staff = StaffAcc::all();// create object form Model class
        return inertia::render('Reshan11/SubRoleView',['Staff' => $staff]);
    }


    public function display() //display all User details
    {
        $user = User::all();// create object form Model class
        return inertia::render('Reshan11/User_Profile',['users' => $user]); //pass data to view components
    }


    public function Create() // create from to add Staff member
    {
        return Inertia::render("Reshan11/SubRole", []); //pass the form to view components
    }

    public function add(Request $request) //data adding to form
    {
        $request->validate([

            'user_id'=>'required|integer|min:0'


        ]);

        $staff = new StaffAcc();
        $staff->user_id = $request->user_id;
        $staff->name = $request->name;
        $staff->telephone = $request->telephone;
        $staff->department = $request->department;
        $staff->accessLevel = $request->accessLevel;

        $staff->save(); // save relevent data

        return redirect::route('displayClient'); //back

    }
    public function deleteSubRole($id) // create delete function
    {
        StaffAcc::where('id',$id)->delete(); // find data from ID
        return redirect::route('displaySubrole');
    }
    public function EditSubRole(Request $request) // create Edit function
    {
        return Inertia::render('Reshan11/Edit_SubRole',['SubRoleUpdate'=>$request]); // pass data to view component

    }

    public function updateSubRole(Request $request) // cretae update function
    {


        if ($request->has('id')){
            StaffAcc::where('id',$request->input('id'))->update([
                'user_id'=>$request->input('user_id'),
                'name'=>$request->input('name'),
                'telephone'=>$request->input('telephone'),
                'department'=>$request->input('department'),
                'accessLevel'=>$request->input('accessLevel'),
            ]);
            return redirect::route('displaySubrole');
        }


    }


}

