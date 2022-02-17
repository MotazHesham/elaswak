@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.target.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.targets.update", [$target->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.target.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $target->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.target.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $target->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="num_of_orders">{{ trans('cruds.target.fields.num_of_orders') }}</label>
                <input class="form-control {{ $errors->has('num_of_orders') ? 'is-invalid' : '' }}" type="number" name="num_of_orders" id="num_of_orders" value="{{ old('num_of_orders', $target->num_of_orders) }}" step="1" required>
                @if($errors->has('num_of_orders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_of_orders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.num_of_orders_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.target.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $target->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.target.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $target->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="delegates">{{ trans('cruds.target.fields.delegate') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('delegates') ? 'is-invalid' : '' }}" name="delegates[]" id="delegates" multiple required>
                    @foreach($delegates as $id => $delegate)
                        <option value="{{ $id }}" {{ (in_array($id, old('delegates', [])) || $target->delegates->contains($id)) ? 'selected' : '' }}>{{ $delegate }}</option>
                    @endforeach
                </select>
                @if($errors->has('delegates'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delegates') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.delegate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="profit">{{ trans('cruds.target.fields.profit') }}</label>
                <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit" value="{{ old('profit', $target->profit) }}" step="0.01" required>
                @if($errors->has('profit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.profit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.target.fields.profit_type') }}</label>
                @foreach(App\Models\Target::PROFIT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('profit_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="profit_type_{{ $key }}" name="profit_type" value="{{ $key }}" {{ old('profit_type', $target->profit_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="profit_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('profit_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profit_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.target.fields.profit_type_helper') }}</span>
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