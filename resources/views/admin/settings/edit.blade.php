@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required" for="email">{{ trans('cruds.setting.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $setting->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="phone">{{ trans('cruds.setting.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.phone_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="address">{{ trans('cruds.setting.fields.address') }}</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $setting->address) }}" required>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.address_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="discount">{{ trans('cruds.setting.fields.discount') }}</label>
                    <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $setting->discount) }}" step="0.01">
                    @if($errors->has('discount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('discount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.discount_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="facebook">{{ trans('cruds.setting.fields.facebook') }}</label>
                    <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', $setting->facebook) }}">
                    @if($errors->has('facebook'))
                        <div class="invalid-feedback">
                            {{ $errors->first('facebook') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.facebook_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="instagram">{{ trans('cruds.setting.fields.instagram') }}</label>
                    <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', $setting->instagram) }}">
                    @if($errors->has('instagram'))
                        <div class="invalid-feedback">
                            {{ $errors->first('instagram') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.instagram_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="whatsapp">{{ trans('cruds.setting.fields.whatsapp') }}</label>
                    <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}">
                    @if($errors->has('whatsapp'))
                        <div class="invalid-feedback">
                            {{ $errors->first('whatsapp') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.whatsapp_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="about_us">{{ trans('cruds.setting.fields.about_us') }}</label>
                    <textarea class="form-control {{ $errors->has('about_us') ? 'is-invalid' : '' }}" name="about_us" id="about_us">{{ old('about_us', $setting->about_us) }}</textarea>
                    @if($errors->has('about_us'))
                        <div class="invalid-feedback">
                            {{ $errors->first('about_us') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.about_us_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="terms_and_conditions">{{ trans('cruds.setting.fields.terms_and_conditions') }}</label>
                    <textarea class="form-control {{ $errors->has('terms_and_conditions') ? 'is-invalid' : '' }}" name="terms_and_conditions" id="terms_and_conditions">{{ old('terms_and_conditions', $setting->terms_and_conditions) }}</textarea>
                    @if($errors->has('terms_and_conditions'))
                        <div class="invalid-feedback">
                            {{ $errors->first('terms_and_conditions') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.terms_and_conditions_helper') }}</span>
                </div> 
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection