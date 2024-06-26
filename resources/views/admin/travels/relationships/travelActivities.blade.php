
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
                        <td style="max-width: 100px; width: 100px; text-align: center;">
                        <div class="d-flex justify-content-center">
                         <span style='font-size:30px;border: 1px solid #00b8d9;color: white !important;border-radius:50%;min-width:50px;background-color:#00b8d9'>{{ $key + 1 }}</span>
                           </div>
                            </td>
                            <td>
                                <h5 class="activity-title">{{ $activity->status->title ?? '' }}</h5>
                                <div class="activity-info">
                                    <i class="fas fa-user"></i>  &nbsp; {{ $activity->user->name ?? '' }}   &nbsp;  - &nbsp; {{ $activity->user->email ?? '' }} &nbsp;  - &nbsp;  <span>{{ $activity->created_at ?? '' }} </span>
                                </div>             
                                @if (!empty($travelTreatmentActivity->description))
                                <div class="activity-desc">
                                    <pre><i class="fas fa-comments"></i> {{ $activity->description ?? '' }}</pre>
                                </div>
                                @endif

                                @foreach($activity->document_file as $key => $media)
                                <div class="activity-files">
                                <div style="display: flex; align-items: center;">
                               <i class="fas fa-file-medical-alt" style="margin-right: 5px;"></i> {{ $key + 1 }}. Dosyayı Görütülemek için &nbsp;
                            <a href="{{ $media->getUrl() }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: 500;">
                                   {{ trans('global.view_file') }}
                              </a> &nbsp;&nbsp;
                               </div>
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
  

@section('scripts')
@parent
<script>
    $(function () {
//   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-travelActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection