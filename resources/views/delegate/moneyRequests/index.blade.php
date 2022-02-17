@extends('layouts.delegate')
@section('content') 
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.moneyRequest.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-MoneyRequest">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.moneyRequest.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.moneyRequest.fields.amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.moneyRequest.fields.delegate') }}
                            </th>
                            <th>
                                {{ trans('cruds.moneyRequest.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.moneyRequest.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.moneyRequest.fields.target') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moneyRequests as $key => $moneyRequest)
                            <tr data-entry-id="{{ $moneyRequest->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $moneyRequest->id ?? '' }}
                                </td>
                                <td>
                                    {{ $moneyRequest->amount ?? '' }}
                                </td>
                                <td>
                                    {{ $moneyRequest->delegate->discount_code ?? '' }}
                                </td>
                                <td>
                                    {{ $moneyRequest->description ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\MoneyRequest::STATUS_SELECT[$moneyRequest->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $moneyRequest->target->title ?? '' }}
                                </td>
                                <td> 
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('delegate.money-requests.show', $moneyRequest->id) }}">
                                        {{ trans('global.view') }}
                                    </a> 
                                    
                                    @if($moneyRequest->status == 'pending') 
                                        <form action="{{ route('delegate.money-requests.destroy', $moneyRequest->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>  
                                    @endif
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-MoneyRequest:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
