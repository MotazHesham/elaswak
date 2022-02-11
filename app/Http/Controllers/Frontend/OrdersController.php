<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class OrdersController extends Controller
{
    public function index(){
        $user = Auth::user();

        $orders_current = Order::with(['products','offers'])->where('user_id',$user->id)->whereIn('delivery_status',['pending','on_review','on_delivery'])->orderBy('created_at','desc')->get();
        $orders_prev= Order::with(['products','offers'])->where('user_id',$user->id)->whereIn('delivery_status',['delivered','canceled'])->orderBy('created_at','desc')->get();

        return view('frontend.profile.orders.orders',compact('orders_prev','orders_current'));
    }
}
