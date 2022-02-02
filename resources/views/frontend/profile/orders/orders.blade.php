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
                            <a class="" href="{{ route('frontend.orders.index')}}">
                                <img class="client-menu-icon" src="{{ asset('frontend/img/track-orders.png') }}" />
                                تتبع الطلبات
                            </a>
                        </li>
                        <li class="account-nav-menu-item">
                            <a class="signout-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
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
                        <li>
                            <a href="#tabs-1">
                                الطلبات الحالية
                                <span class="no_of_orders">(0)</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-2">
                                الطلبات السابقة
                                <span class="no_of_orders">(2)</span>
                            </a>
                        </li>
                    </ul>
                    <div id="tabs-1">
                        <div class="no-orders-tab">
                            <img class="no-orders-img" src="{{ asset('frontend/img/track-orders-cart.png') }}" />
                            <p class="signup-successful">لم تقم بطلب أي منتج حتي الأن</p>
                            <p class="after-signup-p">
                                سوف يتم حفظ كل منتجاتك هنا حتي تستطيع متابعة حالتهم في أي
                                وقت
                            </p>
                        </div>

                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Launch demo modal
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                ...
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            </div>
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
                            @foreach($orders as $order)
                                <div class="row order"> 
                                    <div class="order-info order-number">
                                        <h6 class="order-info-mob-title">رقم الطلب</h6>
                                        <p>{{ $order->id}}</p>
                                    </div>

                                    <div class="order-info order-price">
                                        <h6 class="order-info-mob-title">السعر</h6>
                                        <p>SR {{ $order->products()->get()->sum('total_cost') + $order->offers()->get()->sum('total_cost')}}</p>
                                    </div>

                                    <div class="order-info order-payment-way">
                                        <h6 class="order-info-mob-title">الدفع</h6>
                                        <p>{{ \App\Models\Order::PAYMENT_TYPE_SELECT[$order->payment_type]}}</p>
                                    </div>

                                    <div class="order-info order-status">
                                        <h6 class="order-info-mob-title">الحاله</h6>
                                        <p> {{ \App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] }}</p>
                                    </div>
                                    <div class="order-info order-status">
                                        
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
