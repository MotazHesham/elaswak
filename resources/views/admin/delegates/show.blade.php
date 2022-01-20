@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.delegate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.delegates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.delegate.fields.id') }}
                        </th>
                        <td>
                            {{ $delegate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delegate.fields.discount_code') }}
                        </th>
                        <td>
                            {{ $delegate->discount_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delegate.fields.facebook') }}
                        </th>
                        <td>
                            {{ $delegate->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delegate.fields.instagram') }}
                        </th>
                        <td>
                            {{ $delegate->instagram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delegate.fields.youtube') }}
                        </th>
                        <td>
                            {{ $delegate->youtube }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delegate.fields.user') }}
                        </th>
                        <td>
                            {{ $delegate->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.delegates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection