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
        $product_return = ProductReturn::get(['order_id', 'reason', 'date', 'remark', 'images', 'type', 'returnStatus']);
        return Inertia::render('ProductReturn/ProductReturnAd',['retdata'=>$product_return]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

     
    public function store(Request $request)
    {
        //validating inputs
        $request->validate([
            'order_id'=> 'required|integer',
            'reason'=>'nullable|max:255',
            'type'=>'required',
            'images' => 'required',
            'images.*' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);
        
        $returnReq = new ProductReturn();
            
        $oid = $request->order_id;
        
        //image input 
        /*
        if($request->has('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imgName = $oid.'_'.time();
                $image->move(public_path().'uploads/returns', $imgName);
                $data[] = $imgName; 

               // $request->images->move(public_path('uploads/returns'), $imgName);
                //$cheque->images ='/uploads/returns/'. $imgName;
            }
       }*/

       if($request->hasFile('images')){
        $images = $request->images;
        
        $imgName = $oid.'_'.time().$images->getClientOriginalName();
        $request->images->move(public_path('uploads/returns'), $imgName);
        $returnReq->images = '/uploads/returns/'.$imgName;
        }
    

       //creating new product return object
       

       //assign values
       $returnReq ->order_id = $request->order_id;
       $returnReq ->reason = $request->reason;
       $returnReq ->remark = $request->remark;
       $returnReq ->type = $request->type;
    //   $returnReq ->images = json_encode($data);

       //save return request data to the db
       $returnReq->save();

       return back()->with('success', 'Request Uploaded');
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
        //
    }

    /**
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
