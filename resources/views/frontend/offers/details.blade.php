@extends('layouts.frontend')

@section('content') 
    @php 
        $quantities= [];
        foreach($offer->products as $raw){
            if($raw->pivot->quantity > 0){
                $quantities[] = round($raw->quantity / $raw->pivot->quantity,0);
            }
        }
        $max_qunatity =  min($quantities);
    @endphp
    <div class="product-section container">
        <div class="row row-card">
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <form action="{{ route('frontend.carts.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                        <input type="hidden" name="type" value="offer">

                        <h4>{{ $offer->name }}</h4>
                        <div class="mt-2 pr-3 content">
                            <p class="product-page-description">
                                @foreach ($offer->products as $product)
                                    <?php echo nl2br($product->description ?? ''); ?>
                                    <br>
                                @endforeach
                            </p>
                        </div>
                        <h4 class="product-page-price">{{ $offer->price }} SR</h4>
                        <h4 class="quantity">الكميه</h4>
                        <div id="field1">
                            <button type="button" id="sub" class="sub">-</button>
                            <input class="quantity-number" type="number" name="quantity" id="1" value="1" min="1" max="{{ $max_qunatity }}" />
                            <button type="button" id="add" class="add">+</button>
                        </div>
                        <small class="text-center">المتاح في المخزن ({{ $max_qunatity }})</small>
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
                            $fav = \App\Models\ProductFavorite::where('product_id', $offer->id)
                                ->where('user_id', Auth::id())
                                ->first();
                        @endphp
                        <i class="@if ($fav) fas @else far @endif fa-heart product-fav" data-id="{{ $offer->id }}"
                            data-type="product"></i>
                    @else
                        <i class="far fa-heart product-fav" data-id="{{ $offer->id }}" data-type="product"></i>
                    @endauth
                    <img src="{{ $offer->photo->getUrl() }}" id="main_product_image" width="" />
                </div>
                <div class="customer-opinins-div">
                    <div class="customers-opinins">
                        <a href="ratings.html"> أراء العملاء <span>(3)</span></a>
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
                            <div class="star-container">
                                <input type="radio" name="star" id="five" />
                                <label for="five">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" id="four" />
                                <label for="four">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" id="three" />
                                <label for="three">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" id="two" />
                                <label for="two">
                                    <svg class="star">
                                        <use xlink:href="#star" />
                                    </svg>
                                </label>
                                <input type="radio" name="star" id="one" />
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
            <h4>عروض أخرى</h4>
            <div class="list-products row">
                @foreach ($offers as $offer)
                    <div class="col-lg-4">
                        <div class="product-card">
                            <div class="product-img">
                                @auth
                                    @php
                                        $fav = \App\Models\OfferFavorite::where('offer_id', $offer->id)
                                            ->where('user_id', Auth::id())
                                            ->first();
                                    @endphp
                                    <i class="@if ($fav) fas @else far @endif fa-heart product-fav" data-id="{{ $offer->id }}"
                                        data-type="product"></i>
                                @else
                                    <i class="far fa-heart product-fav" data-id="{{ $offer->id }}" data-type="product"></i>
                                @endauth
                                <a class="" href="{{ route('frontend.offer', $offer->id) }}"><img
                                        src="@if($offer->photo) {{ $offer->photo->getUrl() }} @endif" /></a>
                            </div>
                            <a>
                                <p class="product-name">{{ $offer->name }}</p>
                            </a>
                            <p class="product-price">{{ $offer->price }} SR</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
