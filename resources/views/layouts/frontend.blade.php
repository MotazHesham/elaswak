<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--style css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/style.css') }}" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" />

    <!---fontawesome--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/all.css') }}" />

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!----google-fonts---->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet" />

    <!---owl-carousel---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />

    <script type="text/javascript" src="{{ asset('frontend/js/selectize.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/selectize.css') }}" />
    <!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <!--java scripts-->
    <script src="{{ asset('frontend/js/myScript.js') }}"></script>
    
    <!--My Custom Style-->
    <style>
        .alert-notmateched {
            color: white;
            background-color: #B896A2;
            border-color: #B896A2;
        }

        .btn-filter {
            color: white;
            background-color: #005376;
            border-color: #005376;
        }

        .btn-outline-filter {
            color: #005376;
            border-color: #005376;
        }

        .partials-scrollable {
            max-height: 490px;
            overflow: scroll;
            overflow-x: hidden;
        }

        .partials-scrollable::-webkit-scrollbar {
            width: 5px;
        }

        .partials-scrollable::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, .0);
            border-radius: 10px;
        }

        .partials-scrollable::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: rgba(0, 0, 0, .3);
        }

        .partials-scrollable::-webkit-scrollbar-thumb:hover {
            background: black;
        }

        .my-select {
            border: none;
            background-color: #fff;
            height: 45px;
            padding: 0px 15px;
        }

        .is-invalid {
            border-color: #e55353;
        }

        .orders-store-icon{
            width: 600px
        }
    </style>

    @yield('styles')
</head>

<body>
    @php
        $setting = \App\Models\Setting::first();
        $user = Auth::user();
        
        $links = \App\Models\Link::orderBy('created_at', 'desc')
            ->get()
            ->take(7);
        $categories = \App\Models\ProductCategory::orderBy('created_at', 'desc')
            ->get()
            ->take(7);
        
        $categories2 = \App\Models\ProductCategory::orderBy('created_at', 'desc')
            ->get()
            ->toArray();

        if(count($categories2) > 0){
            $halved = array_chunk($categories2, ceil(count($categories2) / 2));
        } 

        if ($user) {
            $productCarts = \App\Models\ProductCart::with('product')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            $offerCarts = \App\Models\OfferCart::with('offer')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } 
    @endphp

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <div class="main-container">

        @include('partials.frontend_header')

        @yield('content')

        <div class="footer container-fluid">
            <div class="footer-inner row container">
                <div class="col-lg-4">
                    <h6 class="footer-title">منطقة العروض</h6>
                    <p class="p-footer">
                        <?php echo nl2br($setting->about_us ?? ''); ?>
                    </p>
                </div>
                <div class="col-lg-2">
                    <h6 class="footer-title">الفئات</h6>
                    <ul class="menu-footer">
                        @foreach ($categories as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-2">
                    <h6 class="footer-title">المساعدة</h6>
                    <ul class="menu-footer">
                        @foreach ($links as $link)
                            <li><a href="{{ $link->link }}">{{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 footer-social-media">
                    <h6 class="footer-title">التواصل</h6>
                    <div class="footer-buttons">
                        <a href="{{ $setting->whatsapp ?? ''}}"><i class="fab fa-whatsapp social-media-footer"></i></a>
                        <a href="{{ $setting->instagram ?? ''}}"><i class="fab fa-instagram social-media-footer"></i></a>
                        <a href="{{ $setting->facebook ?? ''}}"><i class="fab fa-facebook-f social-media-footer"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----end of main container----->

    @include('sweetalert::alert')

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!----owl-carousel--->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(".owl-one").owlCarousel({
            loop: true,
            margin: 3,
            autoplay: true,
            autoplayTimeout: 3000,
            nav: true,
            dots: false,
            rtl: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1025: {
                    items: 4,
                },
            },
        });
    </script>
    <script>
        function district_change() {
            var district_id = $('#district_id').val();
            console.log(district_id);
            $.post('{{ route('admin.cities.by_district') }}', {
                _token: '{{ csrf_token() }}',
                district_id: district_id
            }, function(data) {
                $('#city_id').html(data)
            });
        }

        function update_qunatity(id, num, type, cart_id) {
            $.post('{{ route('frontend.carts.update') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                num: num,
                type: type
            }, function(data) {
                if (type == 'product') {
                    $('#table-product-' + cart_id).html(data['cost'])
                    $('#product-' + cart_id).html(data['cost'])
                    $('#quantity-product-' + cart_id).html(data['quantity'])
                    $('#cart-total-cost').html(data['total_cost']);
                } else if (type == 'offer') {
                    $('#table-offer-' + cart_id).html(data['cost'])
                    $('#offer-' + cart_id).html(data['cost'])
                    $('#quantity-offer-' + cart_id).html(data['quantity'])
                    $('#cart-total-cost').html(data['total_cost']);
                }
            });
        }

        function delete_cart(id, num, type, cart_id) {
            $.post('{{ route('frontend.carts.delete') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                num: num,
                type: type
            }, function(data) {
                if (type == 'product') {
                    $('#div-product-' + cart_id).fadeOut(300, function() {
                        $(this).remove();
                        $('#table-tr-product-' + cart_id).remove();
                    });
                } else if (type == 'offer') {
                    $('#div-offer-' + cart_id).fadeOut(300, function() {
                        $(this).remove();
                        $('#table-tr-offer-' + cart_id).remove();
                    });
                }
                $('#cart-total-cost').html(data);
            });
        }

        $(".product-fav").on("click", function() {
            @auth
                var id = $(this).data('id');
                var type = $(this).data('type');
            
                $(this).toggleClass("far");
                $(this).toggleClass("fas");
                $.post('{{ route('frontend.favorites.ajax') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                type: type
                }, function(data) {
            
                });
            @else
                window.location.href = '/login';
            @endauth
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
