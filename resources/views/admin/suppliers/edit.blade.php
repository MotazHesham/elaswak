@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.supplier.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suppliers.update", [$supplier->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.supplier.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $supplier->company_name) }}" required>
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="commerical_num">{{ trans('cruds.supplier.fields.commerical_num') }}</label>
                <input class="form-control {{ $errors->has('commerical_num') ? 'is-invalid' : '' }}" type="text" name="commerical_num" id="commerical_num" value="{{ old('commerical_num', $supplier->commerical_num) }}" required>
                @if($errors->has('commerical_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.commerical_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="commerical_expiry">{{ trans('cruds.supplier.fields.commerical_expiry') }}</label>
                <input class="form-control date {{ $errors->has('commerical_expiry') ? 'is-invalid' : '' }}" type="text" name="commerical_expiry" id="commerical_expiry" value="{{ old('commerical_expiry', $supplier->commerical_expiry) }}" required>
                @if($errors->has('commerical_expiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_expiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.commerical_expiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="licence_num">{{ trans('cruds.supplier.fields.licence_num') }}</label>
                <input class="form-control {{ $errors->has('licence_num') ? 'is-invalid' : '' }}" type="text" name="licence_num" id="licence_num" value="{{ old('licence_num', $supplier->licence_num) }}" required>
                @if($errors->has('licence_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('licence_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.licence_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="licence_expiry">{{ trans('cruds.supplier.fields.licence_expiry') }}</label>
                <input class="form-control date {{ $errors->has('licence_expiry') ? 'is-invalid' : '' }}" type="text" name="licence_expiry" id="licence_expiry" value="{{ old('licence_expiry', $supplier->licence_expiry) }}" required>
                @if($errors->has('licence_expiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('licence_expiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.licence_expiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.supplier.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $supplier->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.user_helper') }}</span>
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