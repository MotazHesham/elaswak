<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\Product;
use App\Models\OfferCart;
use App\Models\Offer;
use Auth; 
use Alert;

class CartsController extends Controller
{
    public function index(){ 
        
        $user = Auth::user();
        $productCarts = ProductCart::with('product')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $offerCarts = OfferCart::with('offer')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        return view('frontend.profile.cart',compact('productCarts','offerCarts'));
    }

    public function store(Request $request){
        $user = Auth::user();

        if($request->type == 'product'){
            $product = Product::findOrFail($request->product_id);
            $cart = ProductCart::where('product_id',$request->product_id)->where('user_id',$user->id)->first();
            if($cart){
                $cart->quantity += $request->quantity;
                $cart->total_cost = $cart->quantity * $product->price;
                $cart->save();
            }else{
                ProductCart::create([
                    'user_id' => $user->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'total_cost' => $request->quantity * $product->price,
                ]);
            }
            Alert::success('تم بنجاح');
    
            return redirect()->route('frontend.product',$request->product_id);
            
        }elseif($request->type == 'offer'){
            $offer = Offer::findOrFail($request->offer_id);
            $cart = OfferCart::where('offer_id',$request->offer_id)->where('user_id',$user->id)->first();
            if($cart){
                $cart->quantity += $request->quantity;
                $cart->total_cost = $cart->quantity * $offer->price;
                $cart->save();
            }else{
                OfferCart::create([
                    'user_id' => $user->id,
                    'offer_id' => $request->offer_id,
                    'quantity' => $request->quantity,
                    'total_cost' => $request->quantity * $offer->price,
                ]);
            }
            Alert::success('تم بنجاح');
    
            return redirect()->route('frontend.offer',$request->offer_id);
            
        }else{
            return abort(404);
        }
    }

    public function update(Request $request){
        
        $user = Auth::user();

        if($request->type == 'product'){
            $cart = ProductCart::where('product_id',$request->id)->where('user_id',$user->id)->first();
            $product = Product::findOrFail($request->id);
            $price = $product->price;
        }elseif($request->type == 'offer'){ 
            $cart = OfferCart::where('offer_id',$request->id)->where('user_id',$user->id)->first(); 
            $offer = Offer::findOrFail($request->id);
            $price = $offer->price;
        } 
        if($cart->quantity == 1 && $request->num == -1){
            return $cart->total_cost; 
        }else{
            $cart->quantity += $request->num;
            $cart->total_cost = $cart->quantity * $price;
            $cart->save();
            return $cart->total_cost; 
        }
    }

    public function delete(Request $request){
        
        $user = Auth::user();

        if($request->type == 'product'){
            $cart = ProductCart::where('product_id',$request->id)->where('user_id',$user->id)->first(); 
        }elseif($request->type == 'offer'){ 
            $cart = OfferCart::where('offer_id',$request->id)->where('user_id',$user->id)->first();  
        } 
        $cart->delete();
        return 1;
    }
}
