@extends('layouts.admin')
@section('content')
    @can('target_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.targets.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.target.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.target.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Target">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.target.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.num_of_orders') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.delegate') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.profit') }}
                            </th>
                            <th>
                                {{ trans('cruds.target.fields.profit_type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($targets as $key => $target)
                            <tr data-entry-id="{{ $target->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $target->id ?? '' }}
                                </td>
                                <td>
                                    {{ $target->title ?? '' }}
                                </td>
                                <td>
                                    {{ $target->num_of_orders ?? '' }}
                                </td>
                                <td>
                                    {{ $target->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $target->end_date ?? '' }}
                                </td>
                                <td>
                                    @foreach ($target->delegates as $key => $item)
                                        <span class="badge badge-info">{{ $item->user->name ?? '' }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $target->profit ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Target::PROFIT_TYPE_RADIO[$target->profit_type] ?? '' }}
                                </td>
                                <td>
                                    @can('target_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.targets.show', $target->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('target_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.targets.edit', $target->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('target_delete')
                                        <form action="{{ route('admin.targets.destroy', $target->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
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
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('target_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.targets.massDestroy') }}",
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
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-Target:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
