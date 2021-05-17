<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductRequest;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Models\ProductListing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use PhpParser\Node\Expr\List_;

class ProductListController extends Controller
{
    public function display()
    {
        $list = ProductListing::all();
        return Inertia::render('List', ['lists' => $list]);

    }

    public function create()
    {

        return Inertia::render('AddNew', []);

    }

    public function add(Request $request)
    {
        //add data for table
        $porduct = new ProductListing();

        $porduct->stock_id = $request->stock_id;
        $porduct->name = $request->name;
        $porduct->unitPrice = $request->unitPrice;
        $porduct->discount_id = $request->discount_id;

        //store image
        if ($request->hasFile('imagePath')) {
            $imagePath = $request->imagePath;

            if (!($imagePath->getClientOriginalName() == null)) {

                $fileName = uniqid() . '-' . $imagePath->getClientOriginalName();
                $request->imagePath->move(public_path('uploads/products'), $fileName);
                $porduct->imagePath = '/uploads/products/' . $fileName;

            }
        }

        $porduct->save();

        //return Inertia::render('AddNew',[]);
        return redirect('list');

    }

    public function deleteProduct($id)
    {
        ProductListing::where('id', $id)->delete();
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        //$product = ProductListing::where('id', $request->input('id'))->first();
        return Inertia::render('UpdateProduct', ['product' => $request]);
    }

    public function update(Request $request)
    {



        $product = ProductListing::where('id',$request->input('id'))->first();
        $imgPath = $product->imagePath;

        if($request->hasFile('imagePath') && !($request->imagePath->getClientOriginalName()==null)){
            $imagePath = $request->imagePath;
            File::delete(public_path($imgPath));
            $fileName = 'Updated-'.uniqid().$imagePath->getClientOriginalName();
            $imagePath->move(public_path('/uploads/products/'),$fileName);
            $productImage = '/uploads/products/'.$fileName;
            $product->update(['imagePath'=>$productImage]);
        }

        $product->update([
            'stock_id'=>$request->stock_id,
            'name'=>$request->name,
            'unitPrice'=>$request->unitPrice,
            'discount_id'=>$request->discount_id,
        ]);

//        DB::update('update product_listings set stock_id = ?,unitPrice = ?, discount_id =?  where id = ?',[$request->stock_id,$request->unitPrice,$request->discount_id,$request->id]);

       return redirect()->route('ProductDisplay');
     }


}

    public function getProducts(){
        $list = ProductListing::all();
        $user = Auth::user();
        $customer = $user->customer;
        $userId = $customer->id;
        $cart = Cart::where('customer_id',$userId)->where('type','Default')->first();
        $items = null;
        return Inertia::render('Client/Store/Store',['products'=>$list,'items'=>$items]);
    }







}
