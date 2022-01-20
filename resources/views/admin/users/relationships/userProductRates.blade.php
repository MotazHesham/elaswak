<div class="card">
    <div class="card-header">
        {{ trans('cruds.productRate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userProductRates">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productRate.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productRate.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.productRate.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.productRate.fields.rate') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productRates as $key => $productRate)
                        <tr data-entry-id="{{ $productRate->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productRate->id ?? '' }}
                            </td>
                            <td>
                                {{ $productRate->product->name ?? '' }}
                            </td>
                            <td>
                                {{ $productRate->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $productRate->rate ?? '' }}
                            </td>
                            <td>
                                @can('product_rate_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-rates.show', $productRate->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('product_rate_delete')
                                    <form action="{{ route('admin.product-rates.destroy', $productRate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_rate_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-rates.massDestroy') }}",
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
  let table = $('.datatable-userProductRates:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection