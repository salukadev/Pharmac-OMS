<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Inertia\Inertia;

class ComplaintsController extends Controller
{
    public function display(){
        $complaint = Complaints::all();
        return inertia::render('complaints/Complaint',['complaints'=>$complaint]);
    }
    
    public function create(){
        return inertia::render('complaints/CreateComplaint',[]);
    }

    public function add(Request $REQUEST){
        $complaint= new Complaints();
        $complaint->user_id = $REQUEST->user_id;
        $complaint->category = $REQUEST->category;
        $complaint->message = $REQUEST->message;

        $complaint->save();

        return redirect()->route('displayComplaint');
    }


    public function edit(Request $REQUEST){
       return Inertia::render('complaints/editComplaint',['complaint'=>$REQUEST]);
    }

    public function update(Request $REQUEST){
       
        if($REQUEST->has('complaintId')){
            Complaints::where('complaintId',$REQUEST->input('complaintId'))->update([
                'complaintId' => $REQUEST->input('complaintId'),
                'user_id' => $REQUEST->input('user_id'),
                'category' => $REQUEST->input('category'),
                'message' => $REQUEST->input('message'),

            ]);
            return redirect::route('displayComplaint');
        }   

    }


  
    public function deleteComplaint($id){
        error_log($id);
        Complaints::where('complaintId', $id)->delete();
        return redirect::route('displayComplaint');

    }

}