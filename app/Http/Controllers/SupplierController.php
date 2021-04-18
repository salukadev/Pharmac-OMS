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
        $suppliers = Supplier::get(['supName', 'email', 'address', 'telephone']);

        return Inertia::render('Supplier/SupplierHome', ['suppliers'=>$suppliers]);
    }


    public function create()
    {

        //
    }


    public function store(Request $request)
    {
      Request::validate([

        'supName'=>['required', 'max:50'],
        'email'=>['required', 'max:50', 'email'],
        'address'=>'required',
        'telephone'=>'required',
      ]);

      $user = Supplier::create(
        Request::only('supName', 'email', 'address', 'telephone')
      );

      return redirect()->back();



    }


    public function show($id)
    {
      $supplier = Supplier::where('id',$id)->get();
      return Inertia::render('Supplier/SupplierHome',['supplier'=>$supplier]);
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
