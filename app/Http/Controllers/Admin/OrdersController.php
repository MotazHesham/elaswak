<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\delegate;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{

    public function details(Request $request){
        $order = Order::findOrFail($request->id);
        $order->load('user', 'district', 'city', 'products', 'offers');
        return view('frontend.profile.orders.details',compact('order'));
    }
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Order::with(['user', 'district', 'city', 'products', 'offers'])->select(sprintf('%s.*', (new Order())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_show';
                $editGate = 'order_edit';
                $deleteGate = 'order_delete';
                $crudRoutePart = 'orders';

                return view('partials.datatablesActions', compact(
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
            $table->editColumn('discount_code', function ($row) {
                return $row->discount_code ? $row->discount_code : '';
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

        return view('admin.orders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('cities', 'districts', 'users'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('user', 'district', 'city', 'products', 'offers');

        return view('admin.orders.edit', compact('cities', 'districts', 'order', 'users'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        if($request->delivery_status == 'delivered'){

            if(!$order->done_status){

                $delegate = delegate::find($order->delegate_id);
                if($delegate){
                    $targets = $delegate->delegateTargets()->wherePivot('delegate_id',$delegate->id)->wherePivot('achieved',0)->get();
                    $done = str_replace('/', '-', $order->created_at);
    
                    foreach($targets as $row){ 
                        $start_date = $row->start_date ? Carbon::createFromFormat(config('panel.date_format'), $row->start_date)->format('Y-m-d') : null;
                        $end_date = $row->end_date ? Carbon::createFromFormat(config('panel.date_format'), $row->end_date)->format('Y-m-d') : null;

                        $start = str_replace('/', '-', $start_date);
                        $end = str_replace('/', '-', $end_date);
    
                        if(strtotime($start) < strtotime($done) && strtotime($end) > strtotime($done)){
    
                            $orders = $row->pivot->orders + 1;
                            $row->pivot->orders = $orders;

                            if($row->profit_type == 'percentage'){
                                $row->pivot->profit += ($order->total_cost * ($row->profit / 100));
                            }

                            if($orders >= $row->num_of_orders){
                                
                                if($row->pivot->achieved == 0){
                                    $row->pivot->achieved_date = date('Y-m-d H:i:s');
                                }
    
                                $row->pivot->achieved = 1;
                                if($row->profit_type == 'flat'){
                                    $row->pivot->profit = $row->profit;
                                }
                            }
    
                            $row->pivot->save();
                            
                        }
    
                    }
    
                    $order->done_status = 1; 
                    $order->save();

                }

            } 

        } 
        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('user', 'district', 'city', 'products', 'offers');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
