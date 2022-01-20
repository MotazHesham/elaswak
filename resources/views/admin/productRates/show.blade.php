@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productRate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-rates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productRate.fields.id') }}
                        </th>
                        <td>
                            {{ $productRate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productRate.fields.product') }}
                        </th>
                        <td>
                            {{ $productRate->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productRate.fields.user') }}
                        </th>
                        <td>
                            {{ $productRate->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productRate.fields.rate') }}
                        </th>
                        <td>
                            {{ $productRate->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productRate.fields.review') }}
                        </th>
                        <td>
                            {{ $productRate->review }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-rates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection