<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SupplierController extends Controller
{
    public function index()
    {
        //  error_log("hi there.............................. ");
        $suppliers = Supplier::get(['id','supName', 'email', 'address', 'telephone']);

        return Inertia::render('Admin/Supplier/Supplier', ['suppliers'=>$suppliers]);
    }


    public function create()
    {

        //
    }



    public function store(Request $request)
    {

        //backend validation
        $request->validate([

            'supName'=>['required', 'max:50'],
            'email'=>['required', 'max:50', 'email'],
            'address'=>'required',
            'telephone'=>'required',
        ]);

        //creating new supplier object
        $supplier =  new Supplier();

        //assigning values
        $supplier->supName = $request->supName;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->telephone = $request->telephone;

        //save user inputs
        $supplier->save();

        return redirect()->back()
            ->with('message', 'Supplier Details Uploaded Successfully.');

    }


    public function show($id)
    {
        $supplier = Supplier::where('id',$id)->get();
        return Inertia::render('Admin/Supplier/Supplier',['supplier'=>$supplier]);
    }


    public function edit(Supplier $supplier)
    {
        return Inertia::render('Admin/Supplier/SupplierEdit', []);
    }


    public function update(Request $request, Supplier $supplier)
    {
        $validate = $request->validate([
            'supName'=>['required', 'max:50'],
            'email'=>['required', 'max:50', 'email'],
            'address'=>'required',
            'telephone'=>'required|numeric|phone_number|size:11',
        ]);

        if($request->has('id')){
            Supplier::find($request->input('id'))->update($request->all());
            return redirect('Admin/Supplier/Supplier')->withSuccess('Suppleir Added Successfully!');
        }
    }


    public function destroy($id)
    {
        Supplier::find($id)->delete();
        //suppliers = Supplier::get(['id','supName', 'email', 'address', 'telephone']);
        return redirect()->back();
    }

}
