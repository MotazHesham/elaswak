@can('offer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.offers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.offer.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.offer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-supplierOffers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.supplier') }}
                        </th>
                        <th>
                            {{ trans('cruds.offer.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $key => $offer)
                        <tr data-entry-id="{{ $offer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $offer->id ?? '' }}
                            </td>
                            <td>
                                {{ $offer->name ?? '' }}
                            </td>
                            <td>
                                {{ $offer->price ?? '' }}
                            </td>
                            <td>
                                @foreach($offer->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($offer->photo)
                                    <a href="{{ $offer->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $offer->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $offer->supplier->company_name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $offer->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $offer->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('offer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.offers.show', $offer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('offer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.offers.edit', $offer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('offer_delete')
                                    <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('offer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.offers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-supplierOffers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection