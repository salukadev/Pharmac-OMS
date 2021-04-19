<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Inertia\Inertia;

class StockController extends Controller
{
    public function index()
    {
        $data = Stock::all();
        return Inertia::render('Stock/Stock', ['data' => $data]);
    }

    public function store(Request $request)
    {
        Stock::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request){
        if($request->has('id')){
            Stock::find($request->input('id'))->update($request->all());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        if($request->has('id')){
            Stock::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
