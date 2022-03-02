@extends('layouts.frontend')

@section('content')

@php
    $user = Auth::user();
@endphp
    <div class="container payment-page">
        <div class="row">
            <div class="col-lg-7 payment-form1"> 
                <form action="{{ route('frontend.payment.confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id  }}" id="">
                    <h3 class="payment-title">الدفع</h3>
                    <p>تفاصيل الفاتورة</p>
                    <div class="form-line">
                        <div class="form-group">
                            <label class="form1-label" for="first-name">الاسم الأول</label>
                            <input class=" {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" value="{{ old('first_name',$user->name ?? '' ) }}" required/>
                            @if ($errors->has('first_name'))
                                <div class="alert-danger">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                        </div> 
                        <div class="form-group">
                            <label class="form1-label" for="last-name">الاسم الأخير</label>
                            <input class=" {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" value="{{ old('last_name',$user->last_name ?? '') }}" required/>
                            @if ($errors->has('last_name'))
                                <div class="alert-danger">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-line">
                        <div class="form-group">
                            <label class="form1-label" for="phone-number">رقم الجوال</label>
                            <input class=" {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" value="{{ old('phone',$user->phone ?? '') }}" required/>
                            @if ($errors->has('phone'))
                                <div class="alert-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form1-label" for="email">البريد الالكتروني</label>
                            <input class=" {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email',$user->email ?? '') }}" required/>
                            @if ($errors->has('email'))
                                <div class="alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-line">
                        <div class="form-group">
                            <label class="form1-label" for="country">المنطقة</label>
                            <div class="payment-page-select"> 
                                <select class="my-select form-control {{ $errors->has('district') ? 'is-invalid' : '' }}"
                                    name="district_id" id="district_id" required onchange="district_change()">
                                    @foreach ($districts as $id => $entry)
                                        <option value="{{ $id }}" {{ old('district_id',$user->district_id ?? '') == $id ? 'selected' : '' }}>
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
                            <label class="form1-label" for="state">المدينة</label>
                            <div class="payment-page-select"> 
                                <select class="my-select form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id"
                                    id="city_id" required> 
                                    @foreach ($cities as $id => $entry)
                                        <option value="{{ $id }}" {{ old('city_id',$user->city_id ?? '' ) == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
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
                            <label class="form1-label" for="zip_code">ZIP Code</label>
                            <input class=" {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" value="{{ old('zip_code',$user->zip_code ?? '') }}" required/>
                            @if ($errors->has('zip_code'))
                                <div class="alert-danger">
                                    {{ $errors->first('zip_code') }}
                                </div>
                            @endif
                        </div> 
                        <div class="form-group ">
                            <label class="form1-label" for="first-name">العنوان</label>
                            <input class=" {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" value="{{ old('address',$user->address ?? '') }}" required/>
                            @if ($errors->has('address'))
                                <div class="alert-danger">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                    </div> 
                    <div class="form-line">
                        <div class="form-group">
                            <label class="form1-label" for="discount_code">كود الخصم</label>
                            <input class=" {{ $errors->has('discount_code') ? 'is-invalid' : '' }}" type="text" name="discount_code" value="{{ old('discount_code') }}"  />
                            @if ($errors->has('discount_code'))
                                <div class="alert-danger">
                                    {{ $errors->first('discount_code') }}
                                </div>
                            @endif
                        </div>  
                    </div> 
                    <button type="submit" class="btn confirm-credit-card">
                        تأكيد
                    </button>
                </form>
            </div>

            {{-- <div class="col-lg-5 payment-form2">
                <div class="form2-holder">
                    <div>
                        <h3 class="payment-title">Payment Info.</h3>
                        <p class="payment-methods">Payment Methods</p>
                        <div>
                            <label class="container-payment">Cash on Delivery
                                <input type="radio" checked="checked" name="radio" />
                                <span class="checkmark checkmark-payment"></span>
                            </label>
                            <label class="container-payment">Credit Card
                                <input type="radio" checked="checked" name="radio" />
                                <span class="checkmark checkmark-payment"></span>
                            </label>
                        </div>
                        <div class="form-group from2-group">
                            <label class="form2-label" for="name-on-card">Name on Card:</label>
                            <input class="form2-inputt" type="text" class="form-control" id="name-on-card" />
                        </div>
                        <div class="form-group from2-group credit-number">
                            <label class="form2-label" for="cardnumber">Card number</label>
                            <input class="form2-inputt" id="cardnumber" type="text" pattern="[0-9]{16,19}" maxlength="19"
                                placeholder="8888 8888 8888 8888" />
                            <img class="visa-icon" src="{{ asset('frontend/img/visa-card.png') }}" />
                            <img class="mastercard-icon" src="{{ asset('frontend/img/mastercard_PNG23.png') }}" />
                        </div>
                        <div class="card-exp-cvv">
                            <div class="input-group crdit-card-input-group">
                                <label class="form2-label" for="expiry-date">Expiry Date</label>
                                <input class="form2-inputt" type="text" id="exp" name="expdate" placeholder="MM/YY"
                                    minlength="5" maxlength="5" />
                            </div>
                            <div class="input-group crdit-card-input-group">
                                <label class="form2-label" for="cvv">CVV</label>
                                <input class="form2-inputt" type="password" name="cvv" placeholder="&#9679;&#9679;&#9679;"
                                    minlength="3" maxlength="3" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn confirm-credit-card">
                        Confirm
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
@endsection 
