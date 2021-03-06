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
            <table class=" table table-bordered table-striped table-hover datatable datatable-delegateTargets">
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
                            {{ trans('cruds.target.fields.date') }}
                        </th> 
                        <th>
                            {{ trans('cruds.target.fields.profit') }}
                        </th>  
                        <th>
                            {{ trans('cruds.target.fields.achievement') }}
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
                                <br>
                                <span class="badge badge-info">{{ trans('cruds.target.fields.num_of_orders') }} {{ $target->num_of_orders ?? '' }}</span>
                            </td> 
                            <td>
                                <span class="badge badge-light">{{ $target->start_date ?? '' }}</span>
                                <br>
                                <span class="badge badge-light">{{ $target->end_date ?? '' }}</span> 
                            </td> 
                            <td>
                                @if($target->profit_type == 'percentage') 
                                    {{ $target->profit . '%'?? '' }}
                                    <br>
                                    <span class="badge badge-light">???? ???????????? ?????????????? ???????????????? ???????? ?????????? ??????????????</span>
                                @elseif($target->profit_type == 'flat') 
                                    {{ $target->profit ?? '' }}
                                @endif
                            </td> 
                            <td>
                                @php
                                    $badge = $target->pivot->achieved ? 'badge-success' : 'badge-danger';
                                @endphp
                                <span class="badge {{$badge}}">
                                    @if($target->pivot->achieved)
                                        ???? ?????????????? ????
                                        {{ $target->pivot->achieved_date }}
                                    @else  
                                        ???? ?????? ?????????????? ??????
                                    @endif
                                </span>
                                <br>
                                <span class="badge {{$badge}}">{{ trans('cruds.target.fields.achieved_of_orders') }} {{ $target->pivot->orders ?? 0 }}</span>
                                <br>
                                <span class="badge {{$badge}}">{{ trans('cruds.target.fields.profit') }} {{ $target->pivot->profit ?? 0 }}</span>
                            </td>
                            <td> 
                                @if($target->pivot->achieved)
                                    @php
                                        $money_request = \App\Models\MoneyRequest::whereIn('status',['done','pending'])->where('delegate_id',$delegate->id)->where('target_id',$target->id)->first();
                                    @endphp

                                    @if($money_request)

                                        @if($money_request->status == 'done')
                                            <span class="badge badge-success">
                                                ???? ??????????
                                            </span> 
                                        @elseif($money_request->status == 'pending')
                                            <span class="badge badge-info">
                                                ?????????? ?????? ????????????????
                                            </span>  
                                        @endif
                                    @else 
                                        <button class="btn btn-xs btn-primary" onclick="open_modal('{{$delegate->id}}','{{$target->id}}')">
                                            ?????? ??????
                                        </button>  
                                    @endif
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">?????? ??????</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route("admin.money-requests.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="delegate_id"  id="delegate_id">
                    <input type="hidden" name="target_id"  id="target_id">
                    <div class="row"> 
                        <div class="form-group col-md-12">
                            <label class="required">{{ trans('cruds.moneyRequest.fields.status') }}</label>
                            <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\MoneyRequest::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.moneyRequest.fields.status_helper') }}</span>
                        </div> 
                        <div class="form-group col-md-12">
                            <label class="required" for="description">{{ trans('cruds.moneyRequest.fields.description') }}</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.moneyRequest.fields.description_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        function open_modal(d,t){ 
            $('#exampleModal').modal('show');
            $('#delegate_id').val(d);
            $('#target_id').val(t);
        }
    </script>

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
            let table = $('.datatable-delegateTargets:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
