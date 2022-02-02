@extends('layouts.frontend')

@section('content')

    <div class="signup-section">
        <h4 class="title_pink text-underline">تسجيل جديد</h4> 
        <div class="container row">
            <div class="col-lg-3 signup-options-wrap">
                <ul class="signup-options">
                    <li>
                        <a class="signup-active" href="{{ route('frontend.register.client')}}">
                            <div class="check-radio"></div>
                            عميل
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ route('frontend.register.delegate')}}">
                            <div class="check-radio"></div>
                            مورد
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ route('frontend.register.supplier')}}">
                            <div class="check-radio"></div>
                            مندوب
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 signup-form-wrap">
                <form class="signup-form" action="{{ route('frontend.register.client')}}" method="POST">
                    @csrf
                    <div class="form-line">
                        <div class="form-group">
                            <input type="text" placeholder="الاسم الأول" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"  name="name" value="{{ old('name') }}" required/>
                            @if ($errors->has('name'))
                                <div class="alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="الاسم الأخير" class="{{ $errors->has('last_name') ? 'is-invalid' : '' }}"  name="last_name" value="{{ old('last_name') }}" required/>
                            @if ($errors->has('last_name'))
                                <div class="alert-danger">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-line">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="البريد الالكتروني" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"   value="{{ old('email') }}" required/>
                            @if ($errors->has('email'))
                                <div class="alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="number" name="phone" placeholder="رقم الهاتف" class="{{ $errors->has('phone') ? 'is-invalid' : '' }}"   value="{{ old('phone') }}" required/>
                            @if ($errors->has('phone'))
                                <div class="alert-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-line">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="الرقم السري" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"   value="{{ old('password') }}" required/>
                            @if ($errors->has('password'))
                                <div class="alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="تأكيد الرقم السري" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"   value="{{ old('password_confirmation') }}" required/>
                            @if ($errors->has('password_confirmation'))
                                <div class="alert-danger">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-line">
                        <div class="form-group"> 
                            <div class="payment-page-select"> 
                                <select class="my-select form-control {{ $errors->has('district') ? 'is-invalid' : '' }}"
                                    name="district_id" id="district_id" required onchange="district_change()">
                                    @foreach ($districts as $id => $entry)
                                        <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('district_id'))
                                    <div class="alert-danger">
                                        {{ $errors->first('district_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="payment-page-select"> 
                                <select class="my-select form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id"
                                    id="city_id" required> 
                                    <option value="">المدينة</option>
                                </select>
                                @if ($errors->has('city_id'))
                                    <div class="alert-danger">
                                        {{ $errors->first('city_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-line">
                        <div class="form-group">
                            <input type="text" placeholder="Zip Code" name="zip_code" class="{{ $errors->has('zip_code') ? 'is-invalid' : '' }}"   value="{{ old('zip_code') }}" required/>
                            @if ($errors->has('zip_code'))
                                <div class="alert-danger">
                                    {{ $errors->first('zip_code') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="العنوان" name="address" class="{{ $errors->has('address') ? 'is-invalid' : '' }}"   value="{{ old('address') }}" required/>
                            @if ($errors->has('address'))
                                <div class="alert-danger">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <label class="checkbox-search checkbox-signup">
                        <input type="checkbox" required name="terms_conditions"/>
                        <span class="checkmark {{ $errors->has('address') ? 'is-invalid' : '' }}"></span>
                        أوافق على
                        <a class="terms-conditions-link" data-toggle="modal" data-target=".bd-example-modal-lg">الشروط و الأحكام</a>
                        @if ($errors->has('terms_conditions'))
                            <div class="alert-danger">
                                {{ $errors->first('terms_conditions') }}
                            </div>
                        @endif
                    </label> 
                    <button type="submit" class="btn btn-default form-submit-btn shadow-none signup-btn">
                        تسجيل الدخول
                    </button>
                    <p class="signup-p">
                        هل لديك حساب من قبل؟
                        <a class="signin-link" href="{{ route('login') }}">دخول</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
