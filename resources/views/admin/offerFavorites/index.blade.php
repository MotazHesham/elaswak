@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.offerFavorite.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-OfferFavorite">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.offerFavorite.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.offerFavorite.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.offerFavorite.fields.offer') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offerFavorites as $key => $offerFavorite)
                        <tr data-entry-id="{{ $offerFavorite->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $offerFavorite->id ?? '' }}
                            </td>
                            <td>
                                {{ $offerFavorite->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $offerFavorite->offer->name ?? '' }}
                            </td>
                            <td>



                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-OfferFavorite:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection