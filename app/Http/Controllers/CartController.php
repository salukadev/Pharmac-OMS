<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
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
        $userId = Auth::id();
        $cart=null;
        if(Cart::where('customer_id',$userId)->where('type','Default')->exists()){
            $cart = Cart::where('customer_id',$userId)->where('type','Default')->get();
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
        }
    }

    public function removeItems(Request $request){
        $userId = Auth::id();
        $cart = Cart::where('customer_id',$userId)->where('type','Default')->get();
        $cart->items()->find($request->input('item_id'))->delete();
    }

}
