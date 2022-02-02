@extends('layouts.frontend')

@section('content')

    <div class="favourites-hero-section container">
        <div class="list-products row">

            <div class="col-lg-3 signup-options-wrap">
                <ul class="signup-options">
                    <li>
                        <a class="signup-active" href="{{ route('frontend.favorites.index',['type' => 'offers'])}}">
                            <div class="check-radio"></div>
                            عروض
                        </a>
                    </li>
                    <li>
                        <a class=""  href="{{ route('frontend.favorites.index',['type' => 'products'])}}">
                            <div class="check-radio"></div>
                            منتجات
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @forelse($favorites as $raw)
                        <div class="col-lg-3">
                            <div class="product-card">
                                <div class="product-img">
                                    <a class="" href="product.html"><img
                                            src="{{ $raw->offer->photo->getUrl() }}" /></a>
                                    @auth
                                        @php
                                            $fav = \App\Models\OfferFavorite::where('offer_id', $raw->offer->id)
                                                ->where('user_id', Auth::id())
                                                ->first();
                                        @endphp
                                        <i class="@if ($fav) fas @else far @endif fa-heart product-fav"
                                            data-id="{{ $raw->offer->id }}" data-type="product"></i>
                                    @else
                                        <i class="far fa-heart product-fav" data-id="{{ $raw->offer->id }}"
                                            data-type="product"></i>
                                    @endauth
                                </div>
                                <a class="" href="product.html">
                                    <p class="product-name">{{ $raw->offer->name }}</p>
                                </a>
                                <p class="product-price">{{ $raw->offer->price }} SR</p>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-notmateched text-center">لم يتم العثور علي أي بيانات</div>
                    @endforelse
                </div>
                <div class="mt-5">
                    {{ $favorites->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
