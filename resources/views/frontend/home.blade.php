@extends('layouts.frontend')

@section('content')


    <div class="hp-hero-section container">
        <div class="row"> 
            <div class="col-md-12">
                <div class="row">
                    @if($slider)
                        <img class="hp-hero-section-img" src="{{ $slider->slider->getUrl('preview') ?? '' }}" />
                    @endif
                </div>
                <div class="row links-container">
                    <div class="col-lg-6 link-div">
                        <a class="link-underline blue" href="{{ route('frontend.offers') }}">قسم العروض</a>
                    </div>
                    <div class="col-lg-6 link-div">
                        <a class="link-underline pink" href="{{ route('frontend.products') }}">قسم المنتجات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hp-second-section container">
        <div class="title_lines">
            <p class="title-a">العروض</p>
        </div>
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
                                    data-type="offer"></i>
                            @else
                                <i class="far fa-heart product-fav" data-id="{{ $offer->id }}" data-type="product"></i>
                            @endauth
                            <a class="" href="{{ route('frontend.offer', $offer->id) }}">
                                <img src="@if($offer->photo) {{ $offer->photo->getUrl() }}  @else {{ asset('noimage.jpg') }} @endif" /></a>
                        </div>
                        <a class="" href="{{ route('frontend.offer', $offer->id) }}">
                            <p class="product-name">{{ $offer->name }}</p>
                        </a>
                        <p class="product-price">{{ $offer->price }} SR</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="btn shadow-none pink-btn" href="{{ route('frontend.offers') }}">عرض الكل</a>
    </div>

    <div class="hp-third-section">
        <div class="title_lines">
            <p class="title-a">الخدمات</p>
        </div>
        <div class="services-section container">
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-lg-4 service-div">
                        <img src="{{ $service->photo->getUrl() }}" />
                        <p class="service-name">{{ $service->name }}</p>
                    </div>
                @endforeach
            </div>
            <div class="title_lines">
                <p class="title-a">المنتجات</p>
            </div>
            <div class="list-products row">
                @foreach ($products as $product)
                    <div class="col-lg-4">
                        <a class="" href="{{ route('frontend.product', $product->id) }}">
                            <div class="product-card">
                                <div class="product-img">
                                    <img src="@if($product->photo) {{ $product->photo->getUrl() }}  @else {{ asset('noimage.jpg') }} @endif" />
                                    @auth
                                        @php
                                            $fav = \App\Models\ProductFavorite::where('product_id', $product->id)
                                                ->where('user_id', Auth::id())
                                                ->first();
                                        @endphp
                                        <i class="@if ($fav) fas @else far @endif fa-heart product-fav" data-id="{{ $product->id }}"
                                            data-type="product"></i>
                                    @else
                                        <i class="far fa-heart product-fav" data-id="{{ $product->id }}"
                                            data-type="product"></i>
                                    @endauth
                                </div> 
                                <a class="" href="{{ route('frontend.product', $product->id) }}">
                                    <p class="product-name">{{ $product->name }}</p>
                                </a>
                                <p class="product-price">{{ $product->price }} SR</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="btn shadow-none pink-btn" href="{{ route('frontend.products') }}">عرض الكل</a>
        </div>
    </div>

    <div class="hp-forth-section">
        <div class="owl-one owl-carousel owl-theme owl-container">
            @foreach ($categories as $category)
                <div class="item">
                    <img class="slider-product" src="@if($category->photo) {{ $category->photo->getUrl('preview') }} @else {{ asset('noimage.jpg') }} @endif" />
                    <div class="slider-category-name">
                        <a href="categories.html">{{ $category->name }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
