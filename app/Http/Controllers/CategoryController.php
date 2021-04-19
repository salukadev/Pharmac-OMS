<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Inertia\Inertia;

use App\Models\Category;

class CAtegoryController extends Controller
{
    //Show all
    public function index()
    {
        $category = Category::all();
        return Inertia::render('Admin/Category/Category', ['category' => $category]);
    }

    //Store all
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
    ]);
        Category::create($request->all());
        return redirect('category');
    }

    //Update
    public function update(Request $request){
        if($request->has('id')){
            Category::find($request->input('id'))->update($request->all());
            return redirect('category');
        }
    }

    //Delete
    public function destroy($id){
            Category::find($id)->delete();
            return redirect('category');
    }

    //Go to edit page
    public function edit(Request $request)
    {
        return Inertia::render('Admin/Category/CategoryEdit',['category'=> $request]);
    }

    //Go to create new page
    public function create(Request $request)
    {
        return Inertia::render('Admin/Category/CategoryAdd',['category'=> $request]);
    }



}
