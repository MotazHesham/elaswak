@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.offerFavorite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.offer-favorites.update", [$offerFavorite->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.offerFavorite.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $offerFavorite->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.offerFavorite.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="offer_id">{{ trans('cruds.offerFavorite.fields.offer') }}</label>
                <select class="form-control select2 {{ $errors->has('offer') ? 'is-invalid' : '' }}" name="offer_id" id="offer_id" required>
                    @foreach($offers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('offer_id') ? old('offer_id') : $offerFavorite->offer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('offer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('offer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.offerFavorite.fields.offer_helper') }}</span>
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