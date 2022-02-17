@if($viewGate)
    @if($crudRoutePart == 'delegate.orders')  
        <button type="button" class="btn btn-xs btn-primary" onclick="order_details({{$row->id}})" data-toggle="modal" data-target=".bd-example-modal-lg">
            {{ trans('global.view') }}
        </button>
    @else  
        <a class="btn btn-xs btn-primary" href="{{ route($crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
    @endif
@endif
@if($editGate)
    <a class="btn btn-xs btn-info" href="{{ route($crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endif
@if($deleteGate)
    <form action="{{ route($crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endif