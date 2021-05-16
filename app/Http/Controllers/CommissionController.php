<?php


namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CommissionRule;
use Illuminate\Support\Facades\Redirect;



class CommissionController
{
    public function displayCommissionRule() //display all Staff Member details
    {
        $Commission = CommissionRule::all();// create object form Model class
        return inertia::render('Reshan11/Commission',['Commissions' => $Commission]);
    }

    public function deleteCommission($i) // create delete function
    {
        CommissionRule::where('id',$i)->delete(); // find data from ID
        return redirect::route('Commission');
    }

    public function Create() // create from to add Staff member
    {
        return Inertia::render("Reshan11/AddCommission", []); //pass the form to view components
    }


    public function add(Request $request) //data adding to form
    {

        $commission = new CommissionRule();
        $commission->id = $request->id;
        $commission->admin_id = $request->admin_id;
        $commission->minRefs = $request->minRefs;
        $commission->pointPerRef = $request->pointPerRef;
        $commission->save(); // save relevent data

        return redirect::route('display'); //back

    }
}
