@extends('layouts.frontend')

@section('content')

    <div class="account-settings-section">
        <div class="container row">
            <div class="col-lg-4 account-nav-menu-wrap">
                <div class="account-nav-menu">
                    <ul>
                        <li class="account-nav-menu-item active-nav-menu-item">
                            <i class="far fa-user client-menu-icon"></i>
                            <a href="{{ route('frontend.profile') }}"> حسابي </a>
                        </li>
                        <li class="account-nav-menu-item">
                            <a class="" href="{{ route('frontend.orders.index')}}">
                                <img class="client-menu-icon" src="{{ asset('frontend/img/track-orders.png') }}" />
                                تتبع الطلبات
                            </a>
                        </li>
                        <li class="account-nav-menu-item">
                            <a class="signout-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="fas fa-sign-out-alt client-menu-icon"></i>
                                تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 account-email-psw-wrapper">
                <div class="account-email-psw">
                    <div class="account-email">
                        <p class="edit-account">
                            البريد الالكتروني
                            <img class="edit-icon" src="{{ asset('frontend/img/pen.png')}}" />
                        </p>
                        <p class="registered-email">{{ $user->email}}</p>
                    </div>
                    <div class="change-psw-wrap">
                        <p class="change-psw">تغيير الرقم السري</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 account-info-wrap">
                <div class="account-info-div">
                    <p class="edit-account">
                        المعلومات الشخصية
                        <img class="edit-icon" src="{{ asset('frontend/img/pen.png')}}" />
                    </p>
                    @php 
                        $name = 'name_' . app()->getLocale();
                    @endphp
                    <div class="personal-info-wrap">
                        <p class="name">{{ $user->name . ' ' . $user->last_name}}</p>
                        <p class="phone-num">{{ $user->phone}}</p>
                        <p class="country">{{ $user->district->$name }}</p>
                        <p class="city">{{ $user->city->$name }}</p>
                        <p class="city">{{ $user->address }}</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
