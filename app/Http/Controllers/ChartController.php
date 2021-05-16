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

    public function incomeChartHome(){
        $amounts = Order::all();
        return Inertia::render('Home',['amounts'=>$amounts]);
    }

    public function agentChart(){
        $agents = Order::all();
        return Inertia::render('Home',['agents'=>$agents]);
    }
}
