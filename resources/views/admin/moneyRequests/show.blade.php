@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.moneyRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.money-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.moneyRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $moneyRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.moneyRequest.fields.amount') }}
                        </th>
                        <td>
                            {{ $moneyRequest->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.moneyRequest.fields.delegate') }}
                        </th>
                        <td>
                            {{ $moneyRequest->delegate->discount_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.moneyRequest.fields.description') }}
                        </th>
                        <td>
                            {{ $moneyRequest->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.moneyRequest.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\MoneyRequest::STATUS_SELECT[$moneyRequest->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.moneyRequest.fields.target') }}
                        </th>
                        <td>
                            {{ $moneyRequest->target->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.money-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection