@extends('layouts.frontend')

@section('content')
    <div class="shopping-cart-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p class="shopping-cart-title">المنتجات</p>
                    <div class="shopping-cart-wrapper">
                        <div class="track-orders-section">
                            <ul class="order-info-list">
                                <li>الصوره</li>
                                <li>الاسم</li>
                                <li>السعر</li>
                                <li>الكمية</li>
                            </ul>

                            @php
                                $total = 0;
                            @endphp

                            @foreach ($productCarts as $key => $cart)
                                @php
                                    $total += $cart->total_cost;
                                @endphp
                                <div class="row order" id="table-tr-product-{{ $cart->id }}">
                                    <div class="order-info order-thumbnail">
                                        <h6 class="order-info-mob-title">الصوره</h6>
                                        @if($cart->product && $cart->product->photo)
                                            <figure>
                                                <img class="" src="{{ $cart->product->photo->getUrl('thumb')}}" />
                                            </figure>
                                        @endif
                                    </div>
                                    <div class="order-info order-number">
                                        <h6 class="order-info-mob-title">الاسم</h6>
                                        <p>{{ $cart->product->name ?? '' }}</p>
                                    </div>

                                    <div class="order-info order-price">
                                        <h6 class="order-info-mob-title">السعر</h6>
                                        <p>
                                            <span id="table-product-{{ $cart->id }}">{{ $cart->total_cost}}</span> SR
                                        </p>
                                    </div>

                                    <div class="order-info order-payment-way">
                                        <h6 class="order-info-mob-title">الكمية</h6>
                                        <div id="field1">
                                            <button type="button" id="sub" class="sub"
                                                onclick="update_qunatity({{ $cart->product_id }},-1,'product',{{ $cart->id }})">-</button>
                                            <input class="quantity-number" type="number" id="1"
                                                value="{{ $cart->quantity }}" min="1" disabled />
                                            <button type="button" id="add" class="add"
                                                onclick="update_qunatity({{ $cart->product_id }},1,'product',{{ $cart->id }})">+</button>
                                        </div>
                                    </div>

                                    <div class="shopping-cart-buttons">
                                        <img src="{{ asset('frontend/img/close.png') }}" onclick="delete_cart({{ $cart->product_id }},1,'product',{{ $cart->id }})" /> 
                                        @auth
                                            @php
                                                $fav = \App\Models\ProductFavorite::where('product_id',$cart->product_id)->where('user_id',Auth::id())->first();
                                            @endphp
                                            <i class="@if($fav) fas @else far @endif fa-heart product-fav" data-id="{{$cart->product_id}}" data-type="product"></i>
                                        @else
                                            <i class="far fa-heart product-fav" data-id="{{$cart->product_id}}" data-type="product"></i>
                                        @endauth 
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <p class="shopping-cart-title">العروض</p>
                    <div class="shopping-cart-wrapper">
                        <div class="track-orders-section">
                            <ul class="order-info-list">
                                <li>الصوره</li>
                                <li>الاسم</li>
                                <li>السعر</li>
                                <li>الكمية</li> 
                            </ul>

                            @foreach ($offerCarts as $key => $cart)
                                @php
                                    $total += $cart->total_cost;
                                @endphp
                                <div class="row order" id="table-tr-offer-{{ $cart->id }}">

                                    <div class="order-info order-thumbnail">
                                        <h6 class="order-info-mob-title">الصوره</h6>
                                        @if($cart->offer && $cart->offer->photo)
                                            <figure>
                                                <img class="" src="{{ $cart->offer->photo->getUrl('thumb')}}" />
                                            </figure>
                                        @endif
                                    </div>

                                    <div class="order-info order-number">
                                        <h6 class="order-info-mob-title">الاسم</h6>
                                        <p>{{ $cart->offer->name ?? '' }}</p>
                                    </div>

                                    <div class="order-info order-price">
                                        <h6 class="order-info-mob-title">السعر</h6>
                                        <p>
                                            <span id="table-offer-{{ $cart->id }}">{{ $cart->total_cost}}</span> SR
                                        </p>
                                    </div>

                                    <div class="order-info order-payment-way">
                                        <h6 class="order-info-mob-title">الكمية</h6>
                                        <div id="field1">
                                            <button type="button" id="sub" class="sub"
                                                onclick="update_qunatity({{ $cart->offer_id }},-1,'offer',{{ $cart->id }})">-</button>
                                            <input class="quantity-number" type="number" id="1"
                                                value="{{ $cart->quantity }}" min="1" max="" disabled />
                                            <button type="button" id="add" class="add"
                                                onclick="update_qunatity({{ $cart->offer_id }},1,'offer',{{ $cart->id }})">+</button>
                                        </div>
                                    </div>
                                    <div class="shopping-cart-buttons">
                                        <img src="{{ asset('frontend/img/close.png') }}"
                                            onclick="delete_cart({{ $cart->offer_id }},1,'offer',{{ $cart->id }})" /> 
                                        @auth
                                            @php
                                                $fav = \App\Models\OfferFavorite::where('offer_id', $cart->offer_id)
                                                    ->where('user_id', Auth::id())
                                                    ->first();
                                            @endphp
                                            <i class="@if ($fav) fas @else far @endif fa-heart product-fav" data-id="{{ $cart->offer_id }}"
                                                data-type="offer"></i>
                                        @else
                                            <i class="far fa-heart product-fav" data-id="{{ $cart->offer_id }}" data-type="offer"></i>
                                        @endauth 
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row shopping-cart-pay-information">
                <div class="shopping-cart-totel-pay">
                    <p class="total-p-cart">الاجمالي</p>
                    <div class="price-pay-div">
                        <p class="total-price-cart"><span id="cart-total-cost">{{ $total }}</span> SR</p>
                        <a class="btn go-pay" href="{{ route('frontend.payment.index') }}">الدفع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
