<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChartController extends Controller
{
    public function incomeChart(){
        $amounts = Order::all();
        return Inertia::render('FinancialDashboard',['amounts'=>$amounts]);
    }
}
