@extends('layouts.frontend')

@section('content')

    <div class="product-section container">
        <div class="row row-card">
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <form action="{{ route('frontend.carts.store')}}" method="post">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="type" value="product">

                        <h4>{{ $product->name }}</h4>
                        <div class="mt-2 pr-3 content">
                            <p class="product-page-description"> 
                                <?php echo nl2br($product->description ?? ''); ?>
                            </p>
                        </div>
                        <h4 class="product-page-price">{{ $product->price }} SR</h4>
                        <h4 class="quantity">الكميه</h4>
                        <div id="field1">
                            <button type="button" id="sub" class="sub">-</button>
                            <input class="quantity-number" type="number" name="quantity" id="1" value="1" min="1" max="{{ $product->quantity }}" />
                            <button type="button" id="add" class="add">+</button>
                        </div> 
                        <small class="text-center">المتاح في المخزن ({{ $product->quantity }})</small>
                        <div class="buttons d-flex buy-buttons-wrap">
                            <button type="submit" id="addtobasket" class="btn buy-button add-to-basket-btn shadow-none">
                                <p id="add-p" class="add-basketp">أضف إلى السله</p>
                                <i class="fas fa-shopping-cart basket-add"></i>
                            </button> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main_image">
                    @auth
                        @php
                            $fav = \App\Models\ProductFavorite::where('product_id',$product->id)->where('user_id',Auth::id())->first();
                        @endphp
                        <i class="@if($fav) fas @else far @endif fa-heart product-fav" data-id="{{$product->id}}" data-type="product"></i>
                    @else
                        <i class="far fa-heart product-fav" data-id="{{$product->id}}" data-type="product"></i>
                    @endauth
                    <img src="@if($product->photo) {{ $product->photo->getUrl() }}  @else {{ asset('noimage.jpg') }} @endif" id="main_product_image" width="" />
                </div>
                <div class="customer-opinins-div">
                    <div class="customers-opinins"> 
                        <a href="{{ route('frontend.product.rating',$product->id) }}"> أراء العملاء <span>({{$product->productProductRates->count()}})</span></a>
                        <div class="rating rating2">
                            <!--
                                        <a href="#5" title="Give 5 stars">★</a>
                                        <a href="#4" title="Give 4 stars">★</a>
                                        <a href="#3" title="Give 3 stars">★</a>
                                        <a href="#2" title="Give 2 stars">★</a>
                                        <a href="#1" title="Give 1 star">★</a>
    -->

                            <div class="star-source">
                                <svg>
                                    <linearGradient x1="50%" y1="5.41294643%" x2="87.5527344%" y2="65.4921875%" id="grad">
                                        <stop stop-color="#005376" offset="0%"></stop>
                                    </linearGradient>
                                    <symbol id="star" viewBox="153 89 106 108">
                                        <polygon id="star-shape" stroke="url(#grad)" stroke-width="5" fill="currentColor"
                                            points="206 162.5 176.610737 185.45085 189.356511 150.407797 158.447174 129.54915 195.713758 130.842203 206 95 216.286242 130.842203 253.552826 129.54915 222.643489 150.407797 235.389263 185.45085">
                                        </polygon>
                                    </symbol>
                                </svg>
                            </div>
                            @php
                                $rate = $product->productProductRates()->where('user_id',Auth::id())->first()->rate ?? 0;
                            @endphp
                            <div class="star-container">
                                <input type="radio" name="star" data-product_id="{{$product->id}}" id="five" value="5" @if($rate == 5) checked @endif/>
                                <label for="five">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" data-product_id="{{$product->id}}" id="four" value="4" @if($rate == 4) checked @endif/>
                                <label for="four">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" data-product_id="{{$product->id}}" id="three" value="3" @if($rate == 3) checked @endif/>
                                <label for="three">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" data-product_id="{{$product->id}}" id="two" value="2" @if($rate == 2) checked @endif/>
                                <label for="two">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" data-product_id="{{$product->id}}" id="one" value="1" @if($rate == 1) checked @endif/>
                                <label for="one">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="related-products">
            <h4>منتجات أخرى</h4>
            <div class="list-products row">
                @foreach($products as $product)
                    <div class="col-lg-4">
                        <div class="product-card">
                            <div class="product-img">
                                @auth
                                    @php
                                        $fav = \App\Models\ProductFavorite::where('product_id',$product->id)->where('user_id',Auth::id())->first();
                                    @endphp
                                    <i class="@if($fav) fas @else far @endif fa-heart product-fav" data-id="{{$product->id}}" data-type="product"></i>
                                @else
                                    <i class="far fa-heart product-fav" data-id="{{$product->id}}" data-type="product"></i>
                                @endauth
                                <a class="" href="{{ route('frontend.product',$product->id)}}"><img src="@if($product->photo) {{ $product->photo->getUrl('preview')}}  @else {{ asset('noimage.jpg') }} @endif" /></a>
                            </div>
                            <a>
                                <p class="product-name">{{ $product->name }}</p>
                            </a>
                            <p class="product-price">{{ $product->price }} SR</p>
                        </div>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts') 
    <script>
        $('input[type=radio][name=star]').change(function() {  
            $.post('{{ route('frontend.product.rate') }}', {_token:'{{ csrf_token() }}', id:$(this).data('product_id'), rate:this.value}, function(data){ 

            });
        });
    </script>
@endsection
