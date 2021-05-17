<?php

namespace App\Http\Controllers;

use App\Models\ProductReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Inertia\Inertia;

class ProductReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Admin/Supplier/Supplier
        $product_return = ProductReturn::get(['order_id', 'reason', 'remark',  'type', 'returnStatus']);
        return Inertia::render('Admin/Returns/ReturnRequests',['product_returns'=>$product_return]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //backend validation

        $request->validate([
            'order_id'=> 'required',
            'reason'=>'required',
            'type'=>'required',
        ]);


        //creating new return object
        error_log('Incorrect Request');
        $product_ret = new ProductReturn();

        //assign values
        $product_ret->order_id = $request->order_id;
        $product_ret->reason = $request->reason;
        $product_ret->type = $request->type;

        $product_ret->save();

        return Inertia::render('Client/Return/ReturnRequestAdd',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //backend validation
        $request->validate([
            'order_id'=> 'required',
            'reason'=>'required',
            'type'=>'required',
        ]);

        //creating new return object
        $product_ret = new ProductReturn();

        //assign values
        $product_ret->order_id = $request->order_id;
        $product_ret->reason = $request->reason;
        $product_ret->type = $request->type;

        $product_ret->save();

        return redirect()-> back()->withSuccess('Return Request palced successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductReturn  $productReturn
     * @return \Illuminate\Http\Response
     */
    public function show(ProductReturn $productReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductReturn  $productReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductReturn $productReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductReturn  $productReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductReturn $productReturn)
    {

        if($request->has('order_id')){
            $productReturn = ProductReturn::find($request->input('order_id'));
            $productReturn = ProductReturn::where('order_id', $request->input('order_id'))
                ->update([
                    'returnStatus'=> $request->input('returnStatus'),
                    'remark'=> $request->input('remark'),
                ]);
            return redirect()-> back()->withSuccess('Return Status updated successfully!');
        }
    }

    /**order_id
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductReturn  $productReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReturn $productReturn)
    {
        //
    }
}
