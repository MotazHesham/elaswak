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
                            <a class="" href="{{ route('frontend.orders.index') }}">
                                <img class="client-menu-icon" src="{{ asset('frontend/img/track-orders.png') }}" />
                                تتبع الطلبات
                            </a>
                        </li>
                        <li class="account-nav-menu-item">
                            <a class="signout-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
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
                        </p>
                        <p class="registered-email">{{ $user->email }}</p>
                    </div>
                    <div class="change-psw-wrap">
                        <p class="change-psw" data-bs-toggle="modal" data-bs-target="#exampleModal2" >تغيير الرقم السري</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 account-info-wrap">
                <div class="account-info-div">
                    <p class="edit-account">
                        المعلومات الشخصية
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img class="edit-icon" src="{{ asset('frontend/img/pen.png') }}" />
                        </a>
                    </p>
                    @php
                        $name = 'name_' . app()->getLocale();
                    @endphp
                    <div class="personal-info-wrap">
                        <p class="name">{{ $user->name . ' ' . $user->last_name }}</p>
                        <p class="phone-num">{{ $user->phone }}</p>
                        <p class="country">{{ $user->district->$name ?? '' }}</p>
                        <p class="city">{{ $user->city->$name ?? '' }}</p>
                        <p class="city">{{ $user->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل المعلومات الشخصية</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route("frontend.profile.update") }}" enctype="multipart/form-data">  
                        @csrf
                        <div class="row">
                            
                            <div class="form-group col-md-6">
                                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                @if($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                            </div>  
                            <div class="form-group col-md-6">
                                <label class="required" for="district_id">{{ trans('cruds.user.fields.district') }}</label>
                                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required onchange="district_change()">
                                    @foreach($districts as $id => $entry)
                                        <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $user->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('district'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('district') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="city_id">{{ trans('cruds.user.fields.city') }}</label>
                                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                                    @foreach($cities as $id => $entry)
                                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $user->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required>
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                            </div> 
                            <div class="form-group col-md-6">
                                <label class="required" for="zip_code">{{ trans('cruds.user.fields.zip_code') }}</label>
                                <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $user->zip_code) }}" required>
                                @if($errors->has('zip_code'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('zip_code') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.zip_code_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="address">{{ trans('cruds.user.fields.address') }}</label>
                                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $user->address) }}" required>
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.address_helper') }}</span>
                            </div>  
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>

    <!-- Modal2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal2Label">تغيير الرقم السري</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form class="" action="{{ route('frontend.profile.update_password') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="required" for="old_password">كلمة السر الحالية</label>
                            <input class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}" type="password" name="old_password" id="old_password" required>
                            @if($errors->has('old_password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('old_password') }}
                                </div>
                            @endif 
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">كلمة السر الجديدة</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif 
                        </div>
                        <div class="form-group">
                            <label class="required" for="password_confirmation">تأكيد كلمة السر </label>
                            <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" id="password_confirmation" required>
                            @if($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif 
                        </div> 
                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-danger">تحديث</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>

@endsection
