<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\Complaints;
use Inertia\Inertia;

class ComplaintsController extends Controller
{
    //display function
    public function display(){
        $complaint = Complaints::all();
        return inertia::render('Admin/complaints/Complaint',['complaints'=>$complaint]);
    }

    //create function define
    public function create(){
        return inertia::render('Admin/complaints/CreateComplaint',[]);
    }

    //add function define
    public function add(Request $REQUEST){
        $complaint= new Complaints();
        $complaint->user_id = $REQUEST->user_id;
        $complaint->category = $REQUEST->category;
        $complaint->message = $REQUEST->message;

        $complaint->save();

        return redirect()->route('displayComplaint');
    }

    //edit function
    public function edit(Request $REQUEST){
       return Inertia::render('Admin/complaints/editComplaint',['complaint'=>$REQUEST]);
    }

    public function update(Request $REQUEST){

        //backend validation
        $validated = $REQUEST->validate([
            'complaintId' => 'required',
            'user_id'=> 'required',
            'category'=> 'required',
            'message'=> 'required',
            'status'=> 'required',

        ]);

        if($REQUEST->has('complaintId')){
            Complaints::where('complaintId',$REQUEST->input('complaintId'))->update([
                'complaintId' => $REQUEST->input('complaintId'),
                'user_id' => $REQUEST->input('user_id'),
                'category' => $REQUEST->input('category'),
                'message' => $REQUEST->input('message'),
                'status' => $REQUEST->input('status'),

            ]);
            return redirect::route('displayComplaint');
        }

    }


   // delete function
    public function deleteComplaint($id){

        Complaints::where('complaintId', $id)->delete();
        return redirect::route('displayComplaint');

    }

}
