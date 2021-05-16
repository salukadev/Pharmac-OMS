<?php

namespace App\Http\Controllers;
use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function display(){
        $discount = Discount::all();
        return inertia('Admin/Discount/DiscountPlanList',['discounts'=>$discount]);
    }

    public function create(){
        return Inertia::render('Admin/Discount/AddNewDiscountPlan',[]);
    }

    public function add(Request $request){
        $discount = new Discount();
        $discount->itemCount = $request->itemCount;
        $discount->freeItem = $request->freeItem;

        $discount->save();
        return redirect('/discount');

    }

    public function edit(Request $request){
        return Inertia::render('Admin/Discount/EditDiscountPlan', ['discount' => $request]);
    }


public function update(Request $request){

            DB::update('update discounts set itemCount = ?,freeItem = ? where id = ?',[$request->itemCount,$request->freeItem,$request->id]);
            return redirect()->route('displayDiscount');
}




    public function delete($id){
        Discount::where('id',$id)->delete();
        return redirect('discount');
    }


}
