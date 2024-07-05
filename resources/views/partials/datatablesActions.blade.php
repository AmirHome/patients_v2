@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
    </a>
@endcan
@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
    </a>
@endcan
@can($deleteGate)

<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete_modal_{{$crudRoutePart}}" data-id={{$row->id}}>
</button>
   
@endcan