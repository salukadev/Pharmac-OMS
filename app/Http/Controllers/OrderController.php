<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('customer:id,name')->get();
        $pOrders = Order::where('status',"Pending")->get(); //get pending orders
        return Inertia::render('Admin/Orders/Orders',[
            'orders'=>$orders,
            'pOrders'=>$pOrders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  error_log("hi there.............................. ");
        $orders = Order::with('customer:id,name')->get();


        return Inertia::render('Client/Orders/Order',[
            'orders'=>$orders
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*$validate = $request->validate([
            'cart_id' => 'required|integer|max:50',
            'frequency' => 'required|integer|max:50',
            'customer_id' => 'required|integer|max:50',
            'endDate' => 'required|date',
        ]);*/
        error_log("Order status updating.........");
        if($request->has('id')){
            error_log($request);
            Order::find($request->input('id'))->update($request->all());
            return redirect('orders')->withSuccess('Task Created Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect('orders');
        error_log("Deleting.......");
    }

    public function userorder()
    {
        //  error_log("hi there.............................. ");
        //$orders = Customer::find($id)->orders();
        return Inertia::render('Client/Orders/Order',[]);
    }
}
