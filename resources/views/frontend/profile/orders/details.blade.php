<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{__('Order id')}}: {{ $order->id }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@php
    $status = $order->delivery_status; 
    $name = 'name_' . app()->getLocale();
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div class="pt-4">
        @if($status != 'canceled')
            <ul class="process-steps clearfix">
                <li @if($status == 'pending') class="active" @else class="done" @endif>
                    <div class="icon">1</div>
                    <div class="title">تم الطلب</div>
                </li>
                <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                    <div class="icon">2</div>
                    <div class="title">قيد المراجعة</div>
                </li>
                <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                    <div class="icon">3</div>
                    <div class="title">مع المندوب </div>
                </li>
                <li @if($status == 'delivered') class="done" @endif>
                    <div class="icon">4</div>
                    <div class="title">تم التوصيل </div>
                </li>
            </ul>
        @else
            <ul class="process-steps clearfix">
                <li @if($status == 'canceled') class="active" @else class="done" @endif>
                    <div class="icon" style="background:brown"></div>
                    <div class="title" style="color:black">تم ألغاء الطلب</div>
                    <span>السبب : {{$order->cancel_reason}}</span>
                </li>
            </ul>
        @endif
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
            <div class="float-left">ملخص الطلب </div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">كود الطلب:</td>
                            <td>{{ $order->id }}</td>
                        </tr> 
                        <tr>
                            <td class="w-50 strong-600">البريد الألكتروني:</td>
                            <td>{{ $order->email }}</td>
                        </tr> 
                        <tr>
                            <td class="w-50 strong-600">المنطقة:</td>
                            <td>{{$order->district->$name}}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">المدينة:</td>
                            <td>{{$order->city->$name}}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">العنوان:</td>
                            <td>{{$order->address}}</td>
                        </tr> 
                        <tr>
                            <td class="w-50 strong-600">الجوال:</td>
                            <td>{{$order->phone}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">تاريخ الأضافة:</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">كود الخصم:</td>
                            <td>{{ $order->discount_code }}</td>
                        </tr>
                        <tr> 
                            <td class="w-50 strong-600">حالة الطلب:</td>
                            <td> {{ \App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] }}</td>
                        </tr>     
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">تفاصيل الطلب </div>
                <div class="card-body pb-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>العرض</th>
                                <th>الكمية</th>
                                <th>الأجمالي</th> 
                            </tr>
                        </thead>
                        <tbody> 

                            @foreach ($order->offers as $key => $orderOffer)
                                @php
                                    $total += $orderOffer->total_cost;
                                @endphp
                                <tr id="table-tr-offer-{{$orderOffer->id}}">
                                    <td>
                                        {{ $orderOffer->offer->name ?? '' }} 
                                    </td>
                                    <td>
                                        {{ $orderOffer->quantity}}
                                    </td>
                                    <td>
                                        <span>{{ $orderOffer->total_cost . ' SR'}}</span>
                                    </td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Total')}}</div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th>{{__('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">+0</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Extra Commission')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">+0</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Deposit')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">-0</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Shipping')}}<br><small>({{__('From System')}})</small></th>
                                <td class="text-right">
                                    <span class="text-italic">+0</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600">{{__('Total')}}</span></th>
                                <td class="text-right">
                                    <strong><span>0</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div> 
