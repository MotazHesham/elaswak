<div class="card">
    <div class="card-header">
        {{ trans('cruds.offerRate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userOfferRates">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.offerRate.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.offerRate.fields.offer') }}
                        </th>
                        <th>
                            {{ trans('cruds.offerRate.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.offerRate.fields.rate') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offerRates as $key => $offerRate)
                        <tr data-entry-id="{{ $offerRate->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $offerRate->id ?? '' }}
                            </td>
                            <td>
                                {{ $offerRate->offer->name ?? '' }}
                            </td>
                            <td>
                                {{ $offerRate->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $offerRate->rate ?? '' }}
                            </td>
                            <td>
                                @can('offer_rate_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.offer-rates.show', $offerRate->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('offer_rate_delete')
                                    <form action="{{ route('admin.offer-rates.destroy', $offerRate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('offer_rate_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.offer-rates.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-userOfferRates:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection