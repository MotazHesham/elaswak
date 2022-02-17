@extends('layouts.frontend')

@section('content')

    <div class="categories-hero-section container">
        <div class="row cat-row1">
            <div class="col-md-3 categories-nav-list-wrap">
                
                <div class="search-filters">
                    <div class="mb-3 text-center">
                        <a class="btn btn-filter btn-block rounded-pill btn-lg">العروض</a>
                        <a class="btn btn-outline-filter btn-block rounded-pill btn-lg" href="{{ route('frontend.products')}}">المنتجات</a>
                    </div>
                    <hr>
                    <div>
                        <h3>الفئات</h3> 
                        <ul class="categories-nav-list">
                            <li>
                                <a class="@if($category_id == null) active-cat-page @endif" href="{{ route('frontend.offers')}}">الكل</a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a class="@if($category->id == $category_id) active-cat-page @endif" href="{{ route('frontend.offers',['category_id' => $category->id])}}">{{ $category->name }}</a>
                                </li>
                            @endforeach 
                        </ul> 
                    </div>
                    <form action="">
                        @if($category_id)
                            <input type="hidden" name="category_id" value="{{ $category_id }}">
                        @endif
                        <p>تصنيف المنتجات</p>
                        <div>
                            <label class="radio-search">الأحدث
                                <input type="radio" name="sorting" value="latest" @if($sorting == 'latest' || $sorting == null) checked @endif />
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-search">الأقدم
                                <input type="radio" name="sorting" value="oldest" @if($sorting == 'oldest') checked @endif/>
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-search">من الأرخص للأغلى
                                <input type="radio" name="sorting" value="cheapest" @if($sorting == 'cheapest') checked @endif/>
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-search">من الأغلى للأرخص
                                <input type="radio" name="sorting" value="expensive" @if($sorting == 'expensive') checked @endif/>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="slider-range-wrap">
                            <label class="price" for="amount">السعر: </label>
                            <div id="slider-range"></div>
                            <div class="slider-titles">
                                <input type="text" id="amount-max" placeholder="الحد الأقصى" readonly name="price_end"
                                    style="border: 0; font-weight: bold" >
                                <input type="text" id="amount-min" placeholder="الحد الأدنى" readonly name="price_start"
                                    style="border: 0; font-weight: bold" />
                            </div>
                            <button class="price-range-search" id="price-range-submit" type="submit">
                                تم
                            </button>
                        </div>
                    </form>
                </div> 
            </div>
            <div class="col-md-9">
                <div class="row">
                    @forelse($offers as $offer)
                        <div class="col-lg-3">
                            <div class="product-card">
                                <div class="product-img">
                                    <a class="" href="{{ route('frontend.offer',$offer->id)}}"><img src="@if($offer->photo) {{ $offer->photo->getUrl() }}  @else {{ asset('noimage.jpg') }} @endif" /></a>
                                    @auth
                                        @php
                                            $fav = \App\Models\OfferFavorite::where('offer_id',$offer->id)->where('user_id',Auth::id())->first();
                                        @endphp
                                        <i class="@if($fav) fas @else far @endif fa-heart product-fav" data-id="{{$offer->id}}" data-type="offer"></i>
                                    @else
                                        <i class="far fa-heart product-fav" data-id="{{$offer->id}}" data-type="product"></i>
                                    @endauth
                                </div>
                                <a class="" href="{{ route('frontend.offer',$offer->id)}}">
                                    <p class="product-name">{{ $offer->name }}</p>
                                </a>
                                <p class="product-price">{{ $offer->price }} SR</p>
                            </div>
                        </div> 
                    @empty 
                        <div class="alert alert-notmateched text-center">لم يتم العثور علي أي بيانات مطابقة <b>"{{ $search ?? ''}}"</b></div>
                    @endforelse  
                </div>
                <div class="mt-5">
                    {{ $offers->links() }}
                </div>
            </div>
        </div> 
    </div>
@endsection


@section('scripts')
    @parent 
    <script>
        
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: {{ $max_price + 10 }},
                step: 10,
                values: [{{ $price_start ?? 0 }}, {{ $price_end ?? $max_price + 10 }}],
                slide: function(event, ui) {
                    $("#amount").val("" + ui.values[0] + " " + ui.values[1]);
                    $("#amount-min").val("" + ui.values[0]);
                    $("#amount-max").val(" " + ui.values[1]);
                },
            });
            $("#amount").val(
                "SR " +
                $("#slider-range").slider("values", 0) +
                " - SR " +
                $("#slider-range").slider("values", 1)
            );

            $("#amount-min").val("" + $("#slider-range").slider("values", 0));
            $("#amount-max").val("" + $("#slider-range").slider("values", 1));
        });
    </script>

@endsection