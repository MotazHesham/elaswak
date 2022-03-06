@extends('layouts.frontend')

@section('content')
    <div class="rating-section container">
        <div class="row">
            <div class="col-md-5">
                @php
                    $total_number = $product->productProductRates->count();

                    $avg = $product->avgRating();

                    $five_star = $product
                        ->productProductRates()
                        ->where('rate', 5)
                        ->get()->count();
                    $four_star = $product
                        ->productProductRates()
                        ->where('rate', 4)
                        ->get()->count();
                    $three_star = $product
                        ->productProductRates()
                        ->where('rate', 3)
                        ->get()->count();
                    $two_star = $product
                        ->productProductRates()
                        ->where('rate', 2)
                        ->get()->count();
                    $one_star = $product
                        ->productProductRates()
                        ->where('rate', 1)
                        ->get()->count();

                    $five_star_precentage = ($five_star / $total_number) * 100;
                    $four_star_precentage = ($four_star / $total_number) * 100;
                    $three_star_precentage = ($three_star / $total_number) * 100;
                    $two_star_precentage = ($two_star / $total_number) * 100;
                    $one_star_precentage = ($one_star / $total_number) * 100;
                @endphp
                <div class="total-rating">
                    <h4 class="final-rating">{{ $avg }}</h4>
                    <div class="stars"> 
                        <i class="@if ($avg == 5) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                        <i class="@if ($avg >= 4) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                        <i class="@if ($avg >= 3) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                        <i class="@if ($avg >= 2) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                        <i class="@if ($avg > 1) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                    </div>
                    <p class="rating-p">
                        <span class="no_of_ratings">{{ $total_number }}</span>
                        تقييمات موثقة للمنتج
                    </p>
                </div>
                <div class="total-stars-reviews">
                    <ul class="star-list">
                        <li>
                            <p class="star-num">5</p>
                            <i class="fas fa-star full-star"></i>
                            <p class="no_of_review_per_star">({{ $five_star }})</p>
                            <div class="review-bar">
                                <div class="review-bar-inner" style="width: {{$five_star_precentage}}"></div>
                            </div>
                        </li>
                        <li>
                            <p class="star-num">4</p>
                            <i class="fas fa-star full-star"></i>
                            <p class="no_of_review_per_star">({{ $four_star }})</p>
                            <div class="review-bar">
                                <div class="review-bar-inner" style="width: {{$four_star_precentage}}%"></div>
                            </div>
                        </li>
                        <li>
                            <p class="star-num">3</p>
                            <i class="fas fa-star full-star"></i>
                            <p class="no_of_review_per_star">({{ $three_star }})</p>
                            <div class="review-bar">
                                <div class="review-bar-inner" style="width: {{$three_star_precentage}}%"></div>
                            </div>
                        </li>
                        <li>
                            <p class="star-num">2</p>
                            <i class="fas fa-star full-star"></i>
                            <p class="no_of_review_per_star">({{ $two_star }})</p>
                            <div class="review-bar">
                                <div class="review-bar-inner" style="width: {{$two_star_precentage}}%"></div>
                            </div>
                        </li>
                        <li>
                            <p class="star-num">1</p>
                            <i class="fas fa-star full-star"></i>
                            <p class="no_of_review_per_star">({{ $one_star }})</p>
                            <div class="review-bar">
                                <div class="review-bar-inner" style="width: {{$one_star_precentage}}%"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 cusomers-reviews-wrap">
                @foreach ($product->productProductRates as $rate)
                    <div class="customer-review">
                        <div class="stars">
                            <i class="@if ($rate->rate == 5) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                            <i class="@if ($rate->rate >= 4) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                            <i class="@if ($rate->rate >= 3) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                            <i class="@if ($rate->rate >= 2) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                            <i class="@if ($rate->rate > 1) fas fa-star full-star @else far fa-star empty-star @endif"></i>
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name">{{ $rate->user->name }}</p>
                            <p class="review-date">{{ $rate->created_at }}</p>
                        </div>
                        <p class="review-text">{{ $rate->review }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
