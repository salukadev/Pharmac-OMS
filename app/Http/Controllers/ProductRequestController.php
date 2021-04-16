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

        $productRequests = ProductRequest::all();

        return Inertia::render('ProductRequest/ProductRequestsAll',[
           'productRequests' => $productRequests,
        ]);
    }

    public function create()
    {

        return Inertia::render('ProductRequest/AddProductRequest');

    }

    public function store(Request $request)
    {
        ProductRequest::create($request->all());
        return redirect::route('ProductRequest.index');
    }

}
