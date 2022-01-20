@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.offerRate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offer-rates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.offerRate.fields.id') }}
                        </th>
                        <td>
                            {{ $offerRate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerRate.fields.offer') }}
                        </th>
                        <td>
                            {{ $offerRate->offer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerRate.fields.user') }}
                        </th>
                        <td>
                            {{ $offerRate->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerRate.fields.rate') }}
                        </th>
                        <td>
                            {{ $offerRate->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offerRate.fields.review') }}
                        </th>
                        <td>
                            {{ $offerRate->review }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offer-rates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection