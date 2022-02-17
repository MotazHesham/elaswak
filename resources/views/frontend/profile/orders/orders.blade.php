@extends('layouts.frontend')

@section('content')

    <div class="account-settings-section">
        <div class="container row">
            <div class="col-lg-4 account-nav-menu-wrap">
                <div class="account-nav-menu">
                    <ul>
                        <li class="account-nav-menu-item">
                            <i class="far fa-user client-menu-icon"></i>
                            <a href="{{ route('frontend.profile') }}"> حسابي </a>
                        </li>
                        <li class="account-nav-menu-item active-nav-menu-item">
                            <a class="" href="{{ route('frontend.orders.index') }}">
                                <img class="client-menu-icon" src="{{ asset('frontend/img/track-orders.png') }}" />
                                تتبع الطلبات
                            </a>
                        </li>
                        <li class="account-nav-menu-item">
                            <a class="signout-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="fas fa-sign-out-alt client-menu-icon"></i>
                                تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">
                                الطلبات الحالية
                                <span class="no_of_orders">({{ count($orders_current)}})</span>
                            </a></li>
                        <li><a href="#tabs-2">
                                الطلبات السابقة
                                <span class="no_of_orders">({{ count($orders_prev)}})</span>
                            </a></li>
                    </ul>
                    <div id="tabs-1">
                        <div class="track-orders-section">
                            <ul class="order-info-list"> 
                                <li>رقم الطلب</li>
                                <li>السعر</li>
                                <li>الدفع</li>
                                <li>الحاله</li>
                                <li>تفاصيل الطلب</li>
                            </ul>
                            
                            @foreach ($orders_current as $order) 
                                <div class="row order">
                                    <div class="order-info order-number">
                                        <h6 class="order-info-mob-title">رقم الطلب</h6>
                                        <p>{{ $order->id }}</p>
                                    </div> 

                                    <div class="order-info order-price">
                                        <h6 class="order-info-mob-title">السعر</h6>
                                        <p>SR
                                            {{ $order->total_cost }}
                                        </p>
                                    </div> 

                                    <div class="order-info order-payment-way">
                                        <h6 class="order-info-mob-title">الدفع</h6>
                                        <p>{{ trans('global.payment_type.'. \App\Models\Order::PAYMENT_TYPE_SELECT[$order->payment_type]) }}</p>
                                    </div>

                                    <div class="order-info order-status">
                                        <h6 class="order-info-mob-title">الحاله</h6>
                                        <p> {{ trans('global.delivery_status.'. \App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status]) }}</p>
                                    </div>

                                    <div class="order-info order-status order-dets">
                                        <h6 class="order-info-mob-title">تفاصيل الطلب</h6>
                                        <!-------------------------------------------------------------->
                                        <!-- Vertically centered modal -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary information-popup shadow-none"
                                            data-bs-toggle="modal" data-bs-target="#order-{{$order->id}}">
                                            <img class="info-img" src="{{ asset('frontend/img/information.png') }}">
                                        </button>
    
                                        <!-- Modal -->
                                        <div class="modal fade" id="order-{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="order-{{$order->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="order-{{$order->id}}Label">كود الطلب: {{ $order->id }}</h5>
                                                        <button type="button" class="btn-close shadow-none"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="background-color: #f3f3f3;">
                                                        @include('frontend.profile.orders.details')
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-------------------------------------------------------------->
    
                                    </div>
                                </div>
                            @endforeach 
                        </div> 
                    </div>
                    <div id="tabs-2">
                        
                        <div class="track-orders-section">
                            <ul class="order-info-list"> 
                                <li>رقم الطلب</li>
                                <li>السعر</li>
                                <li>الدفع</li>
                                <li>الحاله</li>
                                <li>تفاصيل الطلب</li>
                            </ul>
                            
                            @forelse ($orders_prev as $order) 
                                <div class="row order">
                                    <div class="order-info order-number">
                                        <h6 class="order-info-mob-title">رقم الطلب</h6>
                                        <p>{{ $order->id }}</p>
                                    </div> 

                                    <div class="order-info order-price">
                                        <h6 class="order-info-mob-title">السعر</h6>
                                        <p>SR
                                            {{ $order->total_cost }}
                                        </p>
                                    </div> 

                                    <div class="order-info order-payment-way">
                                        <h6 class="order-info-mob-title">الدفع</h6>
                                        <p>{{ trans('global.payment_type.'. \App\Models\Order::PAYMENT_TYPE_SELECT[$order->payment_type]) }}</p>
                                    </div>

                                    <div class="order-info order-status">
                                        <h6 class="order-info-mob-title">الحاله</h6>
                                        <p> {{ trans('global.delivery_status.'. \App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status]) }}</p>
                                    </div>

                                    <div class="order-info order-status order-dets">
                                        <h6 class="order-info-mob-title">تفاصيل الطلب</h6>
                                        <!-------------------------------------------------------------->
                                        <!-- Vertically centered modal -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary information-popup shadow-none"
                                            data-bs-toggle="modal" data-bs-target="#order-{{$order->id}}">
                                            <img class="info-img" src="{{ asset('frontend/img/information.png') }}">
                                        </button>
    
                                        <!-- Modal -->
                                        <div class="modal fade" id="order-{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="order-{{$order->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="order-{{$order->id}}Label">كود الطلب: {{ $order->id }}</h5>
                                                        <button type="button" class="btn-close shadow-none"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="background-color: #f3f3f3;">
                                                        @include('frontend.profile.orders.details')
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-------------------------------------------------------------->
    
                                    </div>
                                </div> 
                            @endforeach 
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
    </div>

@endsection
