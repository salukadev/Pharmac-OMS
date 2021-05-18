<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\DeletedCheque;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ChartController extends Controller
{
    public function incomeChart()
    {

        //get how much withdraw according to date
        $financialPay = Stock::select(DB::raw('SUM(unitPrice * Quantity) as amount'),DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')
            ->get();

        //get sales according to date
        $financialProf = Payment::select(DB::raw('SUM(amount) as amount'),DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
                ->groupBy('new_date')
                ->get();

        //get number of pending cheques
        $pendingCheques = Cheque::where('status','Pending')->get();

        //get all cheque
        $allCheques = Cheque::all();

        //get deleted cheques
        $deletedCheques = DeletedCheque::all();

        //get points according to agent
        $agentPerformance = DB::table('calculated_commissions')
            ->select(DB::raw('SUM(points) as amount'), 'agent_id')
            ->groupBy('agent_id')
            ->orderBy('points', 'desc')
            ->get();

        //get all payments
        $paymentReport = DB::table('payments')
            ->join('orders', 'payments.order_id', '=', 'orders.id')
            ->select(DB::raw('*'))
            ->get();

        //get product listening and order details
        $productAndStocks = DB::table('product_listings')
            ->join('stocks', 'product_listings.stock_id', '=', 'stocks.id')
            ->select(DB::raw('*'))
            ->get();
        //get order details and orders
        $financialReport = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('*'))
            ->get();


        //get sales according to customers
        $customerPerform = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select(DB::raw('SUM(orders.amount) as amount'), 'users.id')
            ->where(DB::raw('users.userType'), 'Buyer')
            ->groupBy('users.id')
            ->orderBy('amount', 'desc')
            ->get();


        //get all pending amounts in cheques
        $pendingPrices = DB::table('cheques')
            ->join('payments', 'cheques.payment_id', '=', 'payments.id')
            ->select(DB::raw('SUM(payments.amount) as amount'))
            ->where('cheques.status', 'Pending')
            ->get();

        //get payments details according to the cheques
        $chequeReport = DB::table('cheques')
            ->join('payments', 'cheques.payment_id', '=', 'payments.id')
            ->select(DB::raw('*'))
            ->get();

        //get profit according to date
        $OrdersPrice = OrderDetail::select(DB::raw('SUM(listed_price - calculatedDiscount) as amount'), DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();

        //get withdrawals according to date
        $StockPice = Stock::select(DB::raw('SUM(unitPrice) as amount'), DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();

        //get amounts according to payment type
        $oneTimeAmount = Payment::select(DB::raw('SUM(amount) as amount'), DB::raw('payment_Type'))
            ->groupBy('payment_Type')->get();

        //get amounts according to date
        $dailyPaiments = Payment::select(DB::raw('SUM(amount) as amount'), DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') new_date"))
            ->groupBy('new_date')->get();

        //get cheque amount according to date
        $amounts = Cheque::select(DB::raw('COUNT(*) as amount'), DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d')  new_date"))
            ->groupBy('new_date')->get();

        //get pending cheque
        $chqStatusAmount = Cheque::where('status', 'Pending')->get();

        //get pending cheque count
        $countPending = $chqStatusAmount->count();

        //get approved cheques
        $chqStatusAccept = Cheque::where('status', 'Approved')->get();

        //get approved cheques count
        $countAccept = $chqStatusAccept->count();

        //get rejected cheques
        $chqStatusRejected = Cheque::where('status', 'Rejected')->get();

        //get rejected cheque count
        $countReject = $chqStatusRejected->count();

        //calculate profit margin
        $totalSales = Payment::select(DB::raw('SUM(amount) as amount'))
            ->get();
        $totalWithdrawals = Stock::select(DB::raw('SUM(unitPrice * Quantity) as amount'))
            ->get();
        return Inertia::render('Payment/Financial/FinancialDashboard', [
            'amounts' => $amounts,
            'acceptCheque' => $countAccept,
            'rejectCheque' => $countReject,
            'pendingCheque' => $countPending,
            'oneTimeAmount' => $oneTimeAmount,
            'dailyPayments' => $dailyPaiments,
            'orderSales' => $OrdersPrice,
            'stocksPrices' => $StockPice,
            'pendingAmount' => $pendingPrices,
            'chequeReport' => $chequeReport,
            'agentPerform'=>$agentPerformance,
            'customerPerform'=>$customerPerform,
            'cheques'=>$pendingCheques,
            'allCheques'=>$allCheques,
            'deletedCheques'=>$deletedCheques,
            'currentUser'=>Auth::user(),
            'financialPay'=>$financialPay,
            'financialProf'=>$financialProf,
            'paymentReport'=>$paymentReport,
            'productAndStocks'=>$productAndStocks,
            'financialReport'=>$financialReport,
            'totalSales'=>$totalSales,
            'totalWithdrawals'=>$totalWithdrawals
        ]);
    }

    public function incomeChartHome(){
        $amounts = Order::all();
        return Inertia::render('Home',['amounts'=>$amounts,'currentUser'=>Auth::user()]);
    }

    public function agentChart(){
        $agents = Order::all();
        return Inertia::render('Home',['agents'=>$agents,'currentUser'=>Auth::user()]);
    }
}
