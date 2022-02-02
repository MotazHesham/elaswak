@extends('layouts.frontend')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>المنتجات</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>الكمية</th>
                                    <th>الأجمالي</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($productCarts as $key => $cart)
                                    @php
                                        $total += $cart->total_cost;
                                    @endphp
                                    <tr id="table-tr-product-{{$cart->id}}">
                                        <td>
                                            {{ $cart->product->name ?? '' }}
                                        </td>
                                        <td>
                                            <button type="button" id="sub" class="sub" onclick="update_qunatity({{$cart->product_id}},-1,'product',{{$cart->id}})">-</button>
                                            <input class="quantity-number" type="number" id="1" value="{{ $cart->quantity}}" min="1" max="" disabled/>
                                            <button type="button" id="add" class="add" onclick="update_qunatity({{$cart->product_id}},1,'product',{{$cart->id}})">+</button>
                                        </td>
                                        <td>
                                            <span id="table-product-{{$cart->id}}">{{ $cart->total_cost . ' SR' }}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger rounded-pill" onclick="delete_cart({{$cart->product_id}},1,'product',{{$cart->id}})"> 
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>العروض</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>العرض</th>
                                    <th>الكمية</th>
                                    <th>الأجمالي</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody> 

                                @foreach ($offerCarts as $key => $cart)
                                    @php
                                        $total += $cart->total_cost;
                                    @endphp
                                    <tr id="table-tr-offer-{{$cart->id}}">
                                        <td>
                                            {{ $cart->offer->name ?? '' }} 
                                        </td>
                                        <td>
                                            <button type="button" id="sub" class="sub" onclick="update_qunatity({{$cart->offer_id}},-1,'offer',{{$cart->id}})">-</button>
                                            <input class="quantity-number" type="number" id="1" value="{{ $cart->quantity}}" min="1" max="" disabled/>
                                            <button type="button" id="add" class="add" onclick="update_qunatity({{$cart->offer_id}},1,'offer',{{$cart->id}})">+</button>
                                        </td>
                                        <td>
                                            <span id="table-offer-{{$cart->id}}">{{ $cart->total_cost . ' SR'}}</span>
                                        </td>
                                        <td>  
                                            <button class="btn btn-danger rounded-pill" onclick="delete_cart({{$cart->offer_id}},1,'offer',{{$cart->id}})"> 
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2"> 
                <div class="card text-center">
                    <div class="card-header text-center" style="background: #B896A2;border-color: #B896A2;">
                        <h3>الأجمالي</h3>
                    </div>
                    <div class="card-body">
                        <h1>{{ $total . ' SR' }} </h1>
                        <br>  
                        <a class="btn btn-outline-info btn-block rounded-pill btn-lg" href="{{ route('frontend.payment.index') }}">
                            الدفع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
