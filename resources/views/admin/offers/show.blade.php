@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.offer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.id') }}
                        </th>
                        <td>
                            {{ $offer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.name') }}
                        </th>
                        <td>
                            {{ $offer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.description') }}
                        </th>
                        <td>
                            {{ $offer->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.price') }}
                        </th>
                        <td>
                            {{ $offer->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.category') }}
                        </th>
                        <td>
                            @foreach($offer->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.tag') }}
                        </th>
                        <td>
                            @foreach($offer->tags as $key => $tag)
                                <span class="badge badge-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.photo') }}
                        </th>
                        <td>
                            @if($offer->photo)
                                <a href="{{ $offer->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $offer->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.products') }}
                        </th>
                        <td>
                            @foreach($offer->products as $key => $products)
                                <div class="badge badge-info">{{ $products->name }} 
                                    ({{ $products->pivot->quantity }})</div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.offer.fields.supplier') }}
                        </th>
                        <td>
                            {{ $offer->supplier->company_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#offer_offer_rates" role="tab" data-toggle="tab">
                {{ trans('cruds.offerRate.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="offer_offer_rates">
            @includeIf('admin.offers.relationships.offerOfferRates', ['offerRates' => $offer->offerOfferRates])
        </div>
    </div>
</div>

@endsection