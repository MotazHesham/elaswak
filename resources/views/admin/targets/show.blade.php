@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.target.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.targets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.id') }}
                        </th>
                        <td>
                            {{ $target->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.title') }}
                        </th>
                        <td>
                            {{ $target->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.description') }}
                        </th>
                        <td>
                            {{ $target->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.num_of_orders') }}
                        </th>
                        <td>
                            {{ $target->num_of_orders }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.start_date') }}
                        </th>
                        <td>
                            {{ $target->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.end_date') }}
                        </th>
                        <td>
                            {{ $target->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.delegate') }}
                        </th>
                        <td>
                            @foreach($target->delegates as $key => $delegate)
                                <span class="label label-info">{{ $delegate->discount_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.profit') }}
                        </th>
                        <td>
                            {{ $target->profit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.target.fields.profit_type') }}
                        </th>
                        <td>
                            {{ App\Models\Target::PROFIT_TYPE_RADIO[$target->profit_type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.targets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection