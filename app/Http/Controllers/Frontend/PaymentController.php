<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\City;
use App\Models\ProductCart;
use App\Models\OfferCart;
use App\Models\OrderProduct;
use App\Models\OrderOffer; 
use App\Models\Order;  
use App\Models\Delegate;  
use App\Http\Requests\StoreOrderRequest;
use Auth; 
use Alert;

class PaymentController extends Controller
{
    public function index(){
        $user = Auth::user();

        $name = 'name_' . app()->getLocale();
        $districts = District::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $cities = City::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $productCarts = ProductCart::with('product')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $offerCarts = OfferCart::with('offer')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        
        if($productCarts->count() == 0 && $offerCarts->count() == 0 ){
            Alert::warning('برجاء أضافة منتجات أو عروض ألي عربة التسوق أولا');
            return redirect()->route('frontend.home');
        }

        return view('frontend.profile.payment',compact('districts','cities'));
    }

    public function payment(StoreOrderRequest $request){
        if($request->has('discount_code') && $request->discount_code != null){
            $delegate = Delegate::where('discount_code',$request->discount_code)->first();
    
            if(!$delegate){
                Alert::warning('كود الخصم خطأ');
                return redirect()->route('frontend.payment.index');
            }

            $discount = $delegate->discount;
        }else{
            $discount = 0;
        }

        $order = Order::create($request->all());
        $user = Auth::user();

        $offerCarts = OfferCart::where('user_id',$user->id)->get();
        $productCarts = ProductCart::where('user_id',$user->id)->get();

        $total_cost = 0;

        if($offerCarts){
            foreach($offerCarts as $cart){
                OrderOffer::create([
                    'order_id' => $order->id,
                    'offer_id' => $cart->offer_id,
                    'quantity' => $cart->quantity,
                    'total_cost' => $cart->total_cost,
                ]);
                $total_cost += $cart->total_cost;
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
                $total_cost += $cart->total_cost;
            }
            ProductCart::where('user_id',$user->id)->delete();
        }

        if($discount > 0){ 
            $discount_amount = $total_cost * ($discount /100);
            $order->total_cost = $total_cost - $discount_amount; 
            $order->discount = $discount_amount;
            $order->delegate_id = $delegate->id;
        }else{
            $order->total_cost = $total_cost;
        }
        $order->save();

        Alert::success('تم الطلب بنجاح');
        return redirect()->route('frontend.home');
    }
}
