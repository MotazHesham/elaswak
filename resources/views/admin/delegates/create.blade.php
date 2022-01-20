@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.delegate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.delegates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="discount_code">{{ trans('cruds.delegate.fields.discount_code') }}</label>
                <input class="form-control {{ $errors->has('discount_code') ? 'is-invalid' : '' }}" type="text" name="discount_code" id="discount_code" value="{{ old('discount_code', '') }}" required>
                @if($errors->has('discount_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delegate.fields.discount_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="facebook">{{ trans('cruds.delegate.fields.facebook') }}</label>
                <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', '') }}" required>
                @if($errors->has('facebook'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delegate.fields.facebook_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instagram">{{ trans('cruds.delegate.fields.instagram') }}</label>
                <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', '') }}" required>
                @if($errors->has('instagram'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instagram') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delegate.fields.instagram_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="youtube">{{ trans('cruds.delegate.fields.youtube') }}</label>
                <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube" id="youtube" value="{{ old('youtube', '') }}" required>
                @if($errors->has('youtube'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delegate.fields.youtube_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.delegate.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delegate.fields.user_helper') }}</span>
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