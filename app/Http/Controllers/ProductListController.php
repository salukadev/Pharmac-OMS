<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Models\ProductListing;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use PhpParser\Node\Expr\List_;

class ProductListController extends Controller
{
    //
    public function display(){
        $list = ProductListing::all();
        return Inertia::render('List',['lists'=>$list]);

    }

    public function create(){
        return Inertia::render('AddNew',[]);

    }

    public function add(Request $request){
        $porduct = new ProductListing();

        $porduct->stock_id= $request->stock_id;
        $porduct-> name = $request-> name;
        $porduct-> unitPrice = $request-> unitPrice;
        $porduct-> discount_id = $request-> discount_id;

        //store img
        if($request->hasFile('imagePath')){
            $imagePath = $request->imagePath;

           if(!($imagePath->getClientOriginalName()==null)){

               $fileName = uniqid().'-'.$imagePath->getClientOriginalName();
               $request->imagePath->move(public_path('upload/products'),$fileName);
               $porduct->imagePath='/upload/products/'.$fileName;

           }
        }

        $porduct->save();

        return Inertia::render('AddNew',[]);

    }

    public function deleteProduct($id){
        ProductListing::where('id',$id)->delete();
        return redirect()->back();
    }

    public function edit(Request $request){
        return Inertia::render('UpdateProduct',);
    }








}
