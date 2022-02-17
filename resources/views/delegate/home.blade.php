@extends('layouts.delegate')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">  
                <div class="card-body">
                    <div class="form-group"> 
                        <table class="table table-bordered table-striped">
                            <tbody> 
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
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-lg-8">
            <div class="card"> 
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif   
                    <h3 class="text-center mb-3">{{trans('cruds.target.title')}}</h3>
                    @foreach($delegate->delegateTargets()->orderBy('created_at','desc')->get() as $target)
                        @php
                            $percent = ($target->pivot->orders / $target->num_of_orders) * 100;
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="color: white">
                                    <p class="badge bg-info">
                                        {{$target->start_date}} {{trans('cruds.target.fields.start_date')}}
                                    </p>
                                    <p class="badge bg-light text-dark">
                                        {{$target->num_of_orders}} {{trans('cruds.target.fields.num_of_orders')}}
                                    </p>
                                    <p class="badge bg-info">
                                        {{$target->end_date}} {{trans('cruds.target.fields.end_date')}}
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between  mt-2">
                                    <h5>
                                        {{$target->title}}
                                        @if($target->pivot->achieved)
                                            <i class="fas fa-check-circle" style="color: blue"></i> 
                                        @else 
                                            <i class="fas fa-spinner" style="color: blueviolet"></i>
                                        @endif</h5>
                                    <h5>{{$target->pivot->profit ? $target->pivot->profit . ' EGP' : ''}}</h5>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$percent}}%;" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100">{{$target->pivot->orders}} / {{$target->num_of_orders}}</div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> 
@endsection