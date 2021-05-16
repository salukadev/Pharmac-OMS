<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ChartController extends Controller
{
    public function incomeChart(){
        $pendingPrices = DB::table('cheques')
            ->join('payments','cheques.payment_id','=','payments.id')
            ->select(DB::raw('SUM(payments.amount) as amount'))
            ->where('cheques.status','Pending')
            ->get();

        $chequeReport  = DB::table('cheques')
            ->join('payments','cheques.payment_id','=','payments.id')
            ->select(DB::raw('*'))
            ->get();

        $OrdersPrice = OrderDetail::select(DB::raw('SUM(listed_price - 	calculatedDiscount) as amount'),DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();

        $StockPice = Stock::select(DB::raw('SUM(unitPrice) as amount'),DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();

        $oneTimeAmount = Payment::select(DB::raw('SUM(amount) as amount'),DB::raw('payment_Type'))
            ->groupBy('payment_Type')->get();
        $dailyPaiments = Payment::select(DB::raw('SUM(amount) as amount'),DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();

        $amounts = Cheque::select(DB::raw('count(*) as amount'),DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();
        $chqStatusAmount = Cheque::where('status','Pending')->get();
        $countPending = $chqStatusAmount->count();

        $chqStatusAccept = Cheque::where('status','Approved')->get();
        $countAccept = $chqStatusAccept->count();

        $chqStatusRejected = Cheque::where('status','Rejected')->get();
        $countReject = $chqStatusRejected->count();
        return Inertia::render('FinancialDashboard',['amounts'=>$amounts,'acceptCheque'=>$countAccept,'rejectCheque'=>$countReject,'pendingCheque'=>$countPending,'oneTimeAmount'=>$oneTimeAmount,'dailyPayments'=>$dailyPaiments,'orderSales'=>$OrdersPrice,'stocksPrices'=>$StockPice,'pendingAmount'=>$pendingPrices,'chequeReport'=>$chequeReport]);
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
