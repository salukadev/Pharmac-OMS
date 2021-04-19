<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;


class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return Inertia::render('Stock/Categories', ['data' => $data]);
    }

    public function store(Request $request)
    {
            Category::create($request->all());
            return redirect()->back();
    }

    public function update(Request $request){
        if($request->has('id')){
            Category::find($request->input('id'))->update($request->all());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        if($request->has('id')){
            Category::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
