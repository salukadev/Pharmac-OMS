<?php

namespace App\Http\Controllers;

use App\Models\RecurringOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        return Inertia::render('Admin/RecurringOrder/RecurringOrder', ['recurringOrders'=>$reOrder]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecurringOrder  $recurringOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecurringOrder $recurringOrder)
    {
        //
    }
}
