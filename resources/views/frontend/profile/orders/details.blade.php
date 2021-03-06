@section('styles')
    <style>
        .process-steps {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .process-steps li {
            width: 25%;
            float: left;
            text-align: center;
            position: relative;
        }

        .process-steps li .title {
            font-weight: 600;
            font-size: 13px;
            color: #777;
            margin-top: 8px;
        }

        .process-steps li .icon {
            height: 30px;
            width: 30px;
            margin: auto;
            background: #fff;
            border-radius: 50%;
            line-height: 30px;
            font-size: 14px;
            font-weight: 700;
            color: #adadad;
            position: relative;
        }

        .process-steps li+li:after {
            position: absolute;
            content: "";
            height: 3px;
            width: calc(100% - 30px);
            background: #fff;
            top: 14px;
            z-index: 0;
            right: calc(50% + 15px);
        }

        .process-steps li.done .icon {
            color: transparent;
        }

        .process-steps li.done:after,
        .process-steps li.active:after,
        .process-steps li.active .icon {
            color: #fff;
        }

        .process-steps li.done .icon:before {
            position: absolute;
            content: "";
            left: 11px;
            top: 7px;
            width: 8px;
            height: 14px;
            border: solid #fff;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        } 

        .process-steps li.done:after, .process-steps li.done .icon,
        .process-steps li.active:after, .process-steps li.active .icon{
            background: #B896A2;
        }
        

    </style>
@endsection 

@php
    $status = $order->delivery_status;
    $name = 'name_' . app()->getLocale();
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div class="pt-4">
        @if ($status != 'canceled')
            <ul class="process-steps clearfix">
                <li @if($status == 'pending') class="active" @else class="done" @endif>
                    <div class="icon">1</div>
                    <div class="title">???? ??????????</div>
                </li>
                <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                    <div class="icon">2</div>
                    <div class="title">?????? ????????????????</div>
                </li>
                <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                    <div class="icon">3</div>
                    <div class="title">???? ?????????????? </div>
                </li>
                <li @if($status == 'delivered') class="done" @endif>
                    <div class="icon">4</div>
                    <div class="title">???? ?????????????? </div>
                </li>
            </ul>
        @else
            <ul class="process-steps clearfix">
                <li @if ($status == 'canceled') class="active" @else class="done" @endif>
                    <div class="icon" style="background:brown"></div>
                    <div class="title" style="color:black">???? ?????????? ??????????</div>
                    <span>?????????? : {{ $order->cancel_reason }}</span>
                </li>
            </ul>
        @endif
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
            <div class="float-left">???????? ?????????? </div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">?????? ??????????:</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">???????????? ????????????????????:</td>
                            <td>{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">??????????????:</td>
                            <td>{{ $order->district->$name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">??????????????:</td>
                            <td>{{ $order->city->$name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">??????????????:</td>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">????????????:</td>
                            <td>{{ $order->phone }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">?????????? ??????????????:</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">???????? ??????????:</td>
                            <td> {{ \App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] }}</td>
                        </tr>
                        @if($order->discount)
                            <tr>
                                <td class="w-50 strong-600">?????? ??????????:</td>
                                <td>{{ $order->discount_code }}</td>
                            </tr>
                            <tr>
                                <td class="w-50 strong-600"><b>??????????:</b></td>
                                <td style="color:#B896A2"><b>  {{ $order->discount . ' ????????' }}</b> </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="w-50 strong-600"><b>???????????? ??????????:</b>@if($order->discount)<br> <small>?????? ??????????</small>@endif</td>
                            <td style="color:#B896A2"><b> {{ $order->total_cost . ' ????????' }}</b> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">???????????? </div>
                <div class="card-body pb-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>??????????</th>
                                <th>????????????</th>
                                <th>????????????????</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($order->offers as $key => $orderOffer) 
                                <tr>
                                    <td> 
                                        <a href="{{ route('frontend.offer',$orderOffer->offer->id)}}">
                                            @if($orderOffer->offer && $orderOffer->offer->photo)
                                                <img src="{{ $orderOffer->offer->photo->getUrl('thumb') }}" alt="">
                                            @endif 
                                            <br>
                                            {{ $orderOffer->offer->name ?? '' }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $orderOffer->quantity }}
                                    </td>
                                    <td>
                                        <span>{{ $orderOffer->total_cost . ' ????????' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">???????????????? </div>
                <div class="card-body pb-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>????????????</th>
                                <th>????????????</th>
                                <th>????????????????</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($order->products as $key => $orderProduct) 
                                <tr>
                                    <td>
                                        <a href="{{ route('frontend.product',$orderProduct->product->id)}}">
                                            @if($orderProduct->product && $orderProduct->product->photo)
                                                <img src="{{ $orderProduct->product->photo->getUrl('thumb') }}" alt="">
                                            @endif 
                                            <br>
                                            {{ $orderProduct->product->name ?? '' }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $orderProduct->quantity }}
                                    </td>
                                    <td>
                                        <span>{{ $orderProduct->total_cost . ' ????????' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>
