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
        $request->validate([

            'supName'=>['required', 'max:50'],
            'email'=>['required', 'max:50', 'email'],
            'address'=>'required',
            'telephone'=>'required',
        ]);

        $supplier =  new Supplier();

        $supplier->supName = $request->supName;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->telephone = $request->telephone;

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
        //
    }


    public function update(Request $request, Supplier $supplier)
    {
        //
    }


    public function destroy(Supplier $supplier)
    {
        //
    }

}
