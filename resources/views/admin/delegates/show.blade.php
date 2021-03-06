@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-3">
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
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $delegate->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.last_name') }}
                                </th>
                                <td>
                                    {{ $delegate->user->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $delegate->user->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone') }}
                                </th>
                                <td>
                                    {{ $delegate->user->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.approved') }}
                                </th>
                                <td>
                                    <input type="checkbox" disabled="disabled" {{ $delegate->user->approved ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.district') }}
                                </th>
                                <td>
                                    {{ $delegate->user->district->name_ar ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.city') }}
                                </th>
                                <td>
                                    {{ $delegate->user->city->name_ar ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.zip_code') }}
                                </th>
                                <td>
                                    {{ $delegate->user->zip_code }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.address') }}
                                </th>
                                <td>
                                    {{ $delegate->user->address }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.photo') }}
                                </th>
                                <td>
                                    @if($delegate->user->photo)
                                        <a href="{{ $delegate->user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $delegate->user->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email_verified_at') }}
                                </th>
                                <td>
                                    {{ $delegate->user->email_verified_at }}
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
                                    {{ trans('cruds.delegate.fields.discount') }}
                                </th>
                                <td>
                                    {{ $delegate->discount }}
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
    </div>
    <div class="col-md-9"> 
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#delegate_money_requests" role="tab" data-toggle="tab">
                        {{ trans('cruds.moneyRequest.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#delegate_targets" role="tab" data-toggle="tab">
                        {{ trans('cruds.target.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" role="tabpanel" id="delegate_money_requests">
                    @includeIf('admin.delegates.relationships.delegateMoneyRequests', ['moneyRequests' => $delegate->delegateMoneyRequests])
                </div>
                <div class="tab-pane" role="tabpanel" id="delegate_targets">
                    @includeIf('admin.delegates.relationships.delegateTargets', ['targets' => $delegate->delegateTargets,'delegate' => $delegate])
                </div>
            </div>
        </div>
    </div>
</div>



@endsection