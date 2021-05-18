<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Inertia\Inertia;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //Show all
    public function index()
    {
        $stocks = Stock::with('Category', 'Supplier')->get();
        $cat = Category::all();
        $sup = Supplier::all();

        //For report
        $report = DB::table('stocks')->join('categories', 'categories.id', '=' ,'stocks.category_id')
        ->join('suppliers', 'suppliers.id', '=', 'stocks.supplier_id' )
        ->select('stocks.name', 'categories.catName', 'suppliers.supName', 'stocks.batchNo',
        'stocks.brand','stocks.unitPrice', 'stocks.quantity','stocks.mnfDate','stocks.expDate')->get();


        return Inertia::render('Admin/Stock/Stock', ['stocks' => $stocks, 'cat' => $cat, 'sup'=> $sup, 'report' => $report]);
    }

    //Store all
    public function store(Request $request)
    {

        Stock::create($request->all());
        return redirect('stock')->with('success', 'Product Created.')->with('successMessage', 'Product Added.');
    }

    //Update
    public function update(Request $request){

        if($request->has('id')){
            Stock::find($request->input('id'))->update($request->all());
            return redirect('stock')->with('success', 'Product Updated.')->with('successMessage', 'Product Updated.');
        }
    }

    //Delete
    public function destroy($id){
            Stock::find($id)->delete();
            return redirect('stock')->with('successMessage', 'Product Deleted.');
    }

    //Go to edit page
    public function edit(Request $request)
    {
        return Inertia::render('Admin/Stock/StockEdit',['stock'=> $request])->with('successMessage', 'Product Updated.');
    }

    //Go to create new page
    public function create(Request $request)
    {
        return Inertia::render('Admin/Stock/StockAdd',['stock'=> $request])->with('successMessage', 'Product Added.');
    }

}
