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

class StockController extends Controller
{
    //Show all
    public function index()
    {
        $stocks = Stock::with('Category', 'Supplier')->get();
        $cat = Category::all();
        $sup = Supplier::all();
        return Inertia::render('Admin/Stock/Stock', ['stocks' => $stocks, 'cat' => $cat, 'sup'=> $sup]);
    }

    //Store all
    public function store(Request $request)
    {

        Stock::create($request->all());
        return redirect('stock')->with('successMessage', 'Product Created.');
    }

    //Update
    public function update(Request $request){

        if($request->has('id')){
            Stock::find($request->input('id'))->update($request->all());
            return redirect('stock')->with('successMessage', 'Product Updated.');
        }
    }

    //Delete
    public function destroy($id){
            Stock::find($id)->delete();
            return redirect('stock');
    }

    //Go to edit page
    public function edit(Request $request)
    {
        return Inertia::render('Admin/Stock/StockEdit',['stock'=> $request]);
    }

    //Go to create new page
    public function create(Request $request)
    {
        return Inertia::render('Admin/Stock/StockAdd',['stock'=> $request])->with('successMessage', 'Product created.');
    }

}
