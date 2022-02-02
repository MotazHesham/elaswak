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

        $orders = Order::with(['products','offers'])->where('user_id',$user->id)->orderBy('created_at','desc')->get();

        return view('frontend.profile.orders.orders',compact('orders'));
    }
}
