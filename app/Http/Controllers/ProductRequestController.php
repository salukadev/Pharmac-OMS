<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductRequestController extends Controller
{
    //
    public function index(){
        //collect all data from the product requests table
        $productRequests = ProductRequest::all();

        return Inertia::render('Admin/ProductRequest/ProductRequestsAll',[
           'productRequests' => $productRequests,
        ]);
    }

    public function create()
    {

        return Inertia::render('Admin/ProductRequest/AddProductRequest');

    }

    public function store(Request $request)
    {
        error_log($request);
        //ProductRequest::create($request->all());

        $productRequest = new ProductRequest();
        $productRequest->user_id = $request->user_id;
        $productRequest->generic = $request->generic;
        $productRequest->brand = $request->brand;
        $productRequest->description = $request->description;

        $productRequest->save();

        return redirect::route('ProductRequest.index');
    }

    public function storeClientRequest(Request $request)
    {
        error_log($request);
        //ProductRequest::create($request->all());

        $productRequest = new ProductRequest();
        $productRequest->user_id = $request->user_id;
        $productRequest->generic = $request->generic;
        $productRequest->brand = $request->brand;
        $productRequest->description = $request->description;

        $productRequest->save();

        return Inertia::render('UserProfile');
    }


    public function destroy($id){

        error_log($id);

        ProductRequest::where('reqestId',$id)->delete();
        return redirect::route('ProductRequest.index');

    }

}
