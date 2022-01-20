@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.city.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_ar">{{ trans('cruds.city.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.name_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.city.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="district_id">{{ trans('cruds.city.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                    @foreach($districts as $id => $entry)
                        <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('delivery') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="delivery" id="delivery" value="1" required {{ old('delivery', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="delivery">{{ trans('cruds.city.fields.delivery') }}</label>
                </div>
                @if($errors->has('delivery'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.delivery_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="delivery_cost">{{ trans('cruds.city.fields.delivery_cost') }}</label>
                <input class="form-control {{ $errors->has('delivery_cost') ? 'is-invalid' : '' }}" type="number" name="delivery_cost" id="delivery_cost" value="{{ old('delivery_cost', '0') }}" step="0.01" required>
                @if($errors->has('delivery_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.delivery_cost_helper') }}</span>
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