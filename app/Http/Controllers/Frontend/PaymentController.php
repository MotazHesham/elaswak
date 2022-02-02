<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\ProductCart;
use App\Models\OfferCart;
use App\Models\OrderProduct;
use App\Models\OrderOffer; 
use App\Models\Order;  
use App\Http\Requests\StoreOrderRequest;
use Auth; 
use Alert;

class PaymentController extends Controller
{
    public function index(){
        $user = Auth::user();

        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $productCarts = ProductCart::with('product')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $offerCarts = OfferCart::with('offer')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        
        if($productCarts->count() == 0 && $offerCarts->count() == 0 ){
            Alert::warning('برجاء أضافة منتجات أو عروض ألي عربة التسوق أولا');
            return redirect()->route('frontend.home');
        }

        return view('frontend.profile.payment',compact('districts'));
    }

    public function payment(StoreOrderRequest $request){
        $order = Order::create($request->all());
        $user = Auth::user();

        $offerCarts = OfferCart::where('user_id',$user->id)->get();
        $productCarts = ProductCart::where('user_id',$user->id)->get();

        if($offerCarts){
            foreach($offerCarts as $cart){
                OrderOffer::create([
                    'order_id' => $order->id,
                    'offer_id' => $cart->offer_id,
                    'quantity' => $cart->quantity,
                    'total_cost' => $cart->total_cost,
                ]);
            }  
            OfferCart::where('user_id',$user->id)->delete();  
        }


        if($productCarts){
            foreach($productCarts as $cart){
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'total_cost' => $cart->total_cost,
                ]);
            }
            ProductCart::where('user_id',$user->id)->delete();
        }


        Alert::success('تم طلب الأوردر بنجاح');
        return back();
    }
}
