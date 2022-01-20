@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.city.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.id') }}
                        </th>
                        <td>
                            {{ $city->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $city->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.name_en') }}
                        </th>
                        <td>
                            {{ $city->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.district') }}
                        </th>
                        <td>
                            {{ $city->district->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.delivery') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $city->delivery ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.delivery_cost') }}
                        </th>
                        <td>
                            {{ $city->delivery_cost }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection