<div class="card">


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-travelActivities">
                <thead class="d-none">
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.id') }}
                     
                            {{ trans('cruds.activity.fields.user') }}
                        
                            {{ trans('cruds.user.fields.email') }}
                        
                            {{ trans('cruds.activity.fields.travel') }}
                       
                            {{ trans('cruds.travel.fields.reffering') }}
                        
                            {{ trans('cruds.activity.fields.description') }}
                        
                            {{ trans('cruds.activity.fields.status') }}
                       
                            {{ trans('cruds.activity.fields.document_file') }}
                        
                            {{ trans('cruds.activity.fields.document_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $key => $activity)
                        <tr data-entry-id="{{ $activity->id }}">
                            <td>

                            </td>

                            <td>
                                <span>{{ $activity->created_at ?? '' }}</span>
                                <h1>{{ $activity->status->title ?? '' }}</h1>
                                <div>
                                    <i class="fas fa-user"></i> {{ $activity->user->name ?? '' }}  <i class="far fa-envelope"></i> {{ $activity->user->email ?? '' }}
                                </div>             
                                <div>
                                    <pre><i class="fas fa-comments"></i> {{ $activity->description ?? '' }}</pre>
                                </div>
                                
                                @foreach($activity->document_file as $key => $media)
                                <div class="">
                                    <i class="fas fa-file-medical-alt"></i>
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                {{ $activity->document_name ?? '' }}
                            </td>
                            <td>
                                @can('activity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.activities.show', $activity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('activity_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.activities.edit', $activity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('activity_delete')
                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
//   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-travelActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection