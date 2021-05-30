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
        return inertia::render('Commission Rule/Commission',['Commissions' => $Commission]);
    }

    public function deleteCommission($i) // create delete function
    {
        CommissionRule::where('id',$i)->delete(); // find data from ID
        return redirect::route('displayCommisstion');
    }

    public function add(Request $request) //data adding to form
    {

        $commission = new CommissionRule();
        $commission->admin_id = $request->adminid;
        $commission->minRefs = $request->minref;
        $commission->pointPerRef = $request->pointerref;
        $commission->save(); // save relevent data

        return redirect::route('displayCommisstion'); //back

    }
}
