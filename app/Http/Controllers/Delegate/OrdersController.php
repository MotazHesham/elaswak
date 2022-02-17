<?php

namespace App\Http\Controllers\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Delegate;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class OrdersController extends Controller
{
    public function details(Request $request){
        $order = Order::findOrFail($request->id);
        $order->load('user', 'district', 'city', 'products', 'offers');
        return view('frontend.profile.orders.details',compact('order'));
    }

    public function index(Request $request)
    { 
        $delegate = Delegate::where('user_id',Auth::id())->first();
        if ($request->ajax()) {
            $query = Order::where('delegate_id',$delegate->id)->with(['user', 'district', 'city', 'products', 'offers'])->select(sprintf('%s.*', (new Order())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 1;
                $editGate = 0;
                $deleteGate = 0;
                $crudRoutePart = 'delegate.orders';

                return view('partials.datatablesActions-noauth', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->addColumn('city_name_ar', function ($row) {
                return $row->city ? $row->city->name_ar : '';
            });

            $table->editColumn('payment_type', function ($row) {
                return $row->payment_type ? Order::PAYMENT_TYPE_SELECT[$row->payment_type] : '';
            });
            $table->editColumn('payment_status', function ($row) {
                return $row->payment_status ? Order::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
            });
            $table->editColumn('delivery_status', function ($row) {
                return $row->delivery_status ? Order::DELIVERY_STATUS_SELECT[$row->delivery_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'city']);

            return $table->make(true);
        }

        return view('delegate.orders.index');
    }   

    public function show(Order $order)
    { 

        $order->load('user', 'district', 'city', 'products', 'offers');

        return view('delegate.orders.show', compact('order'));
    }  
}
