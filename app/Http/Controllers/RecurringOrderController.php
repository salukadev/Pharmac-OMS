<?php

namespace App\Http\Controllers;

use App\Models\RecurringOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Cart;

class RecurringOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reOrder = RecurringOrder::get(['id', 'customer_id', 'cart_id', 'frequency', 'endDate']);
        $users = Customer::all()->pluck('id')->toArray();
        $carts = Cart::all()->pluck('id')->toArray();
        return Inertia::render('Admin/RecurringOrder/RecurringOrder', ['recurringOrders'=>$reOrder,'users'=>$users,'carts'=>$carts]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'cart_id' => 'required|integer',
            'frequency' => 'required|integer',
            'customer_id' => 'required|integer',
            'endDate' => 'required|date',
        ]);
        RecurringOrder::create($request->all());
        return redirect('recurringorder');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecurringOrder  $recurringOrder
     * @return \Illuminate\Http\Response
     */
    public function show(RecurringOrder $recurringOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecurringOrder  $recurringOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(RecurringOrder $recurringOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecurringOrder  $recurringOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecurringOrder $recurringOrder)
    {

        $validate = $request->validate([
            'cart_id' => 'required|integer',
            'frequency' => 'required|integer',
            'customer_id' => 'required|integer',
            'endDate' => 'required|date',
        ]);

        if($request->has('id')){
            RecurringOrder::find($request->input('id'))->update($request->all());
            return redirect('recurringorder')->withSuccess('Task Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecurringOrder  $recurringOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RecurringOrder::find($id)->delete();
        return redirect('recurringorder');
    }


}
