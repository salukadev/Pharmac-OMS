<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $userId = Auth::id();
        $cart = Cart::where('customer_id',$userId)->where('type','Default')->get();
        $items = $cart->items();
        //error_log("Working");
        //error_log($orders);
        return Inertia::render('Client/Store/Cart',[
            'items'=>$items
        ]);
    }

    public function addItems(Request $request){
        ///$userId = Auth::user()->id;  //get user id
        $user = Auth::user();
        $customer = $user->customer;
        $userId = $customer->id;
        error_log($userId);

        $cart=null;
        if(Cart::where('customer_id',$userId)->where('type','Default')->exists()){
            $cart = Cart::where('customer_id',$userId)->where('type','Default')->first();
        }else{
            $cart = new Cart([
                'customer_id'=>$userId,
                'type'=>"Default"
            ]);
            $cart->save();
        }

        if($request->has('listing_id')){
            //use find or create method defined in the model
            $item = CartItem::findOrCreate($cart->id,$request->input('listing_id'));
            $item->cart_id = $cart->id;
            $item->listing_id = $request->input('listing_id');
            $item->quantity = $request->input('quantity');
            $cart->items()->save($item); //create an item in the cart
            return redirect('/store');
        }
    }

    public function removeItems(Request $request){
        $userId = Auth::id();
        $cart = Cart::where('customer_id',$userId)->where('type','Default')->get();
        $cart->items()->find($request->input('item_id'))->delete();
    }

}
