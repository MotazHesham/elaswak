@extends('layouts.frontend')
@section('content')

    <div class="sign-in-section container">
        
        @if (session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif
        
        <h4 class="title_pink text-underline">تسجيل الدخول</h4>

        <form method="POST" action="{{ route('login') }}" class="signin-form">
            @csrf
            <div class="form-group sign_group_form">  
                <input id="email" name="email" type="text"
                class="form-control shadow-none{{ $errors->has('email') ? ' is-invalid' : '' }} " required 
                autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                value="{{ old('email', null) }}">

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group sign_group_form"> 
                <input id="password" name="password" type="password"
                    class="form-control shadow-none{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                    placeholder="{{ trans('global.login_password') }}">

                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
            </div>
            <div class="forget-psw">
                <div class="row">
                    <div class="col-md-6">
                        <div style="float:right">
                            <a href="{{ route('password.request') }}">
                                {{ trans('global.forgot_password') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-check checkbox">
                            <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                            <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                {{ trans('global.remember_me') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default form-submit-btn shadow-none">
                تسجيل الدخول
            </button> 
            <br>
            <a class="btn btn-link px-0" href="{{ route('frontend.register.client') }}" style="color: #b896a2; text-decoration: underline; transition: all .6s ease-in-out;">
                {{ trans('global.register') }}
            </a>
        </form> 
    </div>
@endsection
