<header>
    <div class="top-bar">
        <div class="container row">
            <div class="top-bar-right col-6">
                @auth
                    <div class="dropdown mobile-sign account-sign">
                        <button class="btn btn-secondary dropdown-toggle shadow-none" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" onclick="this.blur();">
                            {{ $user->name . ' ' . $user->last_name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('frontend.profile') }}">
                                    <i class="far fa-user client-menu-icon"></i>
                                    حسابي
                                </a></li>

                            <li><a class="dropdown-item" href="{{ route('frontend.orders.index') }}">
                                    <img class="client-menu-icon" src="{{ asset('frontend/img/track-orders.png') }}">
                                    تتبع الطلبات
                                </a></li>

                            <li><a class="dropdown-item signout-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="fas fa-sign-out-alt client-menu-icon"></i>
                                    تسجيل الخروج
                                </a></li>
                        </ul>
                    </div>
                @else
                    <a class="top-bar-links" href="{{ route('login') }}">
                        تسجيل الدخول
                    </a>
                @endauth
            </div>
            <div class="top-bar-left col-6">
                <div class="top-bar-social desktop-top-bar-left">
                    <a class="top-bar-links" href="tel:{{ $setting->phone ?? '' }}">
                        <i class="fas fa-phone-alt"></i>
                        {{ $setting->phone ?? '' }}
                    </a>
                    <a class="top-bar-links" href="mailto:{{ $setting->email ?? '' }}">
                        <i class="fas fa-envelope"></i>
                        {{ $setting->email ?? '' }}
                    </a>
                </div>
                <div class="top-bar-social mobile-top-bar-left">
                    <a class="top-bar-links" href="tel:{{ $setting->phone ?? '' }}">
                        <i class="fas fa-phone-alt"></i>
                    </a>
                    <a class="top-bar-links" href="mailto:{{ $setting->email ?? '' }}">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container row">
            <div class="col-3 header-icons">
                <div class="desktop-menu">
                    <a href="#"><img class="header-signs cat-menu-sign"
                            src="{{ asset('frontend/img/menu-sign.png') }}" /></a>
                    <div class="categories-menu categories-menu-hide">
                        <ul class="right-cat-links">
                            @if ($halved[0] ?? '')
                                @foreach ($halved[0] as $category)
                                    <li><a
                                            href="{{ route('frontend.offers', ['category_id' => $category['id']]) }}">{{ $category['name'] }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="left-cat-links">
                            @if ($halved[1] ?? '')
                                @foreach ($halved[1] as $category)
                                    <li><a
                                            href="{{ route('frontend.offers', ['category_id' => $category['id']]) }}">{{ $category['name'] }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <a href="#" class="shopping-cart-wrap">
                        <img class="header-signs shopping-cart-icon"
                            src="{{ asset('frontend/img/shopping-cart.png') }}" />
                        @auth
                            <p class="orders-quantity">
                                {{ $productCarts->count() + $offerCarts->count() }}
                            </p>
                        @endauth
                    </a>
                    <div class="orders-store-icon orders-pop-hide">
                        @auth
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="partials-scrollable">
                                        <div class="text-center mt-2">
                                            @if ($productCarts->count() > 0)
                                                <a class="btn btn-outline-filter btn-block rounded-pill btn-lg"
                                                    href="#">المنتجات</a>
                                            @endif
                                        </div>

                                        @foreach ($productCarts as $cart)
                                            <div id="div-product-{{ $cart->id }}">
                                                <div class="order-info-store-icon">
                                                    <div class="order-store-icon-thumbnail">
                                                        <a href="{{ route('frontend.product',$cart->product_id)}}">
                                                            <img src="{{ $cart->product->photo->getUrl() ?? '' }}" />
                                                        </a>
                                                    </div>
                                                    <div class="name-price-order">
                                                        <p class="name-pop">{{ $cart->product->name ?? '' }}
                                                        </p>
                                                        <p class="price-pop">{{ $cart->product->price ? $cart->product->price  . ' ريال': '' }}
                                                            </p>
                                                        <p class="total-quantity">الكمية <span id="quantity-product-{{ $cart->id }}">{{ $cart->quantity }}</span></p>
                                                        <i class="far fa-trash-alt"
                                                            onclick="delete_cart({{ $cart->product_id }},1,'product',{{ $cart->id }})"></i>
                                                    </div>
                                                </div> 
                                                <p class="total-price" >الاجمالي: 
                                                    <span id="product-{{ $cart->id }}">
                                                        {{ $cart->total_cost . ' ريال'}}
                                                    </span>
                                                </p>

                                                @if (!$loop->last)
                                                    <hr>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="partials-scrollable">
                                        <div class="text-center mt-2">
                                            @if ($offerCarts->count() > 0)
                                                <a class="btn btn-outline-filter btn-block rounded-pill btn-lg"
                                                    href="#">العروض</a>
                                            @endif
                                        </div>

                                        @foreach ($offerCarts as $cart)
                                            <div id="div-offer-{{ $cart->id }}">
                                                <div class="order-info-store-icon">
                                                    <div class="order-store-icon-thumbnail">
                                                        <a href="{{ route('frontend.offer',$cart->offer_id)}}">
                                                            <img src="{{ $cart->offer->photo->getUrl() ?? '' }}" />
                                                        </a>
                                                    </div>
                                                    <div class="name-price-order">
                                                        <p class="name-pop">{{ $cart->offer->name ?? '' }}
                                                        </p>
                                                        <p class="price-pop">{{ $cart->offer->price ? $cart->offer->price  . ' ريال' : '' }}
                                                            </p>
                                                        <p class="total-quantity">الكمية <span id="quantity-offer-{{ $cart->id }}">{{ $cart->quantity }}</span>
                                                        </p>
                                                        <i class="far fa-trash-alt"
                                                            onclick="delete_cart({{ $cart->offer_id }},1,'offer',{{ $cart->id }})"></i>
                                                    </div>
                                                </div>
                                                <p class="total-price" >الاجمالي: 
                                                    <span id="offer-{{ $cart->id }}">
                                                        {{ $cart->total_cost  . ' ريال'}}
                                                    </span>  
                                                </p>
                                                @if (!$loop->last)
                                                    <hr>
                                                @endif

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endauth

                        <div class="pay-store-link">
                            <a href="{{ route('frontend.carts.index') }}"><img
                                    src="{{ asset('frontend/img/shopping-cart.png') }}" />
                                عرض أو تحرير عربة التسوق
                            </a>
                            <button class="pay-button" onclick="window.location.href='/payment/info';">
                                الدفع
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('frontend.favorites.index', ['type' => 'products']) }}"><i
                            class="far fa-heart header-signs"></i></a>
                    {{-- <select class="language-select" onchange="location = this.value;">
                        <option value="" class="arabic-lang">AR</option>
                        <option value="">EN</option>
                    </select> --}}
                </div>
                <i class="fas fa-align-right mobile-menu-icon"></i>
                <div class="mobile-menu">
                    <li class="cat-mobile">
                        <a href="#"><img class="header-signs cat-menu-sign"
                                src="{{ asset('frontend/img/menu-sign2.png') }}" />الفئات</a>
                    </li>
                    <div class="categories-menu-mobile categories-menu-hide">
                        <ul class="right-cat-links">
                            @if ($halved[0] ?? '')
                                @foreach ($halved[0] as $category)
                                    <li><a
                                            href="{{ route('frontend.offers', ['category_id' => $category['id']]) }}">{{ $category['name'] }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="left-cat-links">
                            @if ($halved[1] ?? '')
                                @foreach ($halved[1] as $category)
                                    <li><a
                                            href="{{ route('frontend.offers', ['category_id' => $category['id']]) }}">{{ $category['name'] }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <li>
                        <a href="#"><img class="header-signs"
                                src="{{ asset('frontend/img/shopping-cart.png') }}" />عربة التسوق</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.favorites.index', ['type' => 'products']) }}"><i
                                class="far fa-heart header-signs"></i>المفضلة</a>
                    </li>
                    <li>
                        <select class="language-select" onchange="location = this.value;">
                            <option value="index.html" class="arabic-lang">AR</option>
                            <option value="index-en.html">EN</option>
                        </select>
                    </li>
                    <div class="search-bar search-mobile">
                        <div class="search-container">
                            <form action="{{ route('frontend.offers') }}">
                                <input type="text" placeholder="" name="search" value="{{ $search ?? '' }}" />
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 header-left">
                <div class="logo-container">
                    <a class="logo" href="{{ route('frontend.home') }}">Logo</a>
                </div>
                <div class="search-bar search-desktop">
                    <div class="search-container">
                        <form action="{{ route('frontend.offers') }}">
                            <input type="text" placeholder="" name="search" value="{{ $search ?? '' }}" />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
