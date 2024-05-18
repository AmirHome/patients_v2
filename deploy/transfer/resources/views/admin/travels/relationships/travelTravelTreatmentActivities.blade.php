@can('travel_treatment_activity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.travel-treatment-activities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.travelTreatmentActivity.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-travelTravelTreatmentActivities">
                <thead class="d-none">
                    <tr >
                        <th width="10">

                        </th>
                        <th>
                            
                        </th>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.travel') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.reffering') }}
                        </th>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.travelTreatmentActivity.fields.treatment_file') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travelTreatmentActivities as $key => $travelTreatmentActivity)
                        <tr data-entry-id="{{ $travelTreatmentActivity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ trans('cruds.travelTreatmentActivity.fields.user') }}
                        
                                {{ $travelTreatmentActivity->user->name ?? '' }}
                                
                                {{ trans('cruds.user.fields.email') }}
                                {{ $travelTreatmentActivity->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $travelTreatmentActivity->travel->reffering_type ?? '' }}
                            </td>
                            <td>
                                {{ $travelTreatmentActivity->travel->reffering ?? '' }}
                            </td>
                            <td>
                                {{ $travelTreatmentActivity->status->title ?? '' }}
                            </td>
                            <td>
                                {{ $travelTreatmentActivity->description ?? '' }}
                            </td>
                            <td>
                                @foreach($travelTreatmentActivity->treatment_file as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('travel_treatment_activity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.travel-treatment-activities.show', $travelTreatmentActivity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('travel_treatment_activity_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.travel-treatment-activities.edit', $travelTreatmentActivity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('travel_treatment_activity_delete')
                                    <form action="{{ route('admin.travel-treatment-activities.destroy', $travelTreatmentActivity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  });
  let table = $('.datatable-travelTravelTreatmentActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

</script>
@endsection