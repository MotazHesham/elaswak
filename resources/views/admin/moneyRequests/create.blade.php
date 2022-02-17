@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.moneyRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.money-requests.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="amount">{{ trans('cruds.moneyRequest.fields.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                    @if($errors->has('amount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.moneyRequest.fields.amount_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="delegate_id">{{ trans('cruds.moneyRequest.fields.delegate') }}</label>
                    <select class="form-control select2 {{ $errors->has('delegate') ? 'is-invalid' : '' }}" name="delegate_id" id="delegate_id" required>
                        @foreach($delegates as $id => $entry)
                            <option value="{{ $id }}" {{ old('delegate_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('delegate'))
                        <div class="invalid-feedback">
                            {{ $errors->first('delegate') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.moneyRequest.fields.delegate_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="description">{{ trans('cruds.moneyRequest.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.moneyRequest.fields.description_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">{{ trans('cruds.moneyRequest.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\MoneyRequest::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 'pending') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.moneyRequest.fields.status_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="target_id">{{ trans('cruds.moneyRequest.fields.target') }}</label>
                    <select class="form-control select2 {{ $errors->has('target') ? 'is-invalid' : '' }}" name="target_id" id="target_id" required>
                        @foreach($targets as $id => $entry)
                            <option value="{{ $id }}" {{ old('target_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('target'))
                        <div class="invalid-feedback">
                            {{ $errors->first('target') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.moneyRequest.fields.target_helper') }}</span>
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