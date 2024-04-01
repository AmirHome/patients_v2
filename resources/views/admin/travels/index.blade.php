@extends('layouts.admin')
@section('content')
@can('travel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.travels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.travel.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.travel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Travel">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.patient') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.surname') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.group') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.hospital') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.attendant_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.attendant_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.attendant_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.has_pestilence') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.hospital_mail_notify') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.reffering') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.reffering_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.reffering_other') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.notify_hospitals') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.hospitalization_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.planning_discharge_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.arrival_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.departure_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.wants_shopping') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.visa_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.visa_start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.visa_end_date') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('travel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.travels.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.travels.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'patient_name', name: 'patient.name' },
{ data: 'patient.middle_name', name: 'patient.middle_name' },
{ data: 'patient.surname', name: 'patient.surname' },
{ data: 'patient.code', name: 'patient.code' },
{ data: 'group_name', name: 'group.name' },
{ data: 'hospital_name', name: 'hospital.name' },
{ data: 'department_name', name: 'department.name' },
{ data: 'status_title', name: 'status.title' },
{ data: 'attendant_name', name: 'attendant_name' },
{ data: 'attendant_address', name: 'attendant_address' },
{ data: 'attendant_phone', name: 'attendant_phone' },
{ data: 'has_pestilence', name: 'has_pestilence' },
{ data: 'hospital_mail_notify', name: 'hospital_mail_notify' },
{ data: 'reffering', name: 'reffering' },
{ data: 'reffering_type', name: 'reffering_type' },
{ data: 'reffering_other', name: 'reffering_other' },
{ data: 'notify_hospitals', name: 'notify_hospitals' },
{ data: 'hospitalization_date', name: 'hospitalization_date' },
{ data: 'planning_discharge_date', name: 'planning_discharge_date' },
{ data: 'arrival_date', name: 'arrival_date' },
{ data: 'departure_date', name: 'departure_date' },
{ data: 'wants_shopping', name: 'wants_shopping' },
{ data: 'visa_status', name: 'visa_status' },
{ data: 'visa_start_date', name: 'visa_start_date' },
{ data: 'visa_end_date', name: 'visa_end_date' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Travel').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection