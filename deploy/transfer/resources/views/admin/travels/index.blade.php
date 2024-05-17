@extends('layouts.admin')
@section('content')


@includeIf('admin.travels.relationships.formFilter', [$genders])

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
                        {{ trans('cruds.travel.fields.last_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.travel.fields.created_at') }}
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
    // buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.travels.index') }}",
        data: function(d) {
            d.ff_patient_name = $('.filter[name="patient_name"]').val();
            d.ff_patient_code = $('.filter[name="patient_code"]').val();
        }
    },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'patient_name', name: 'patient.name' },
{ data: 'patient.code', name: 'patient.code' },
{ data: 'group_name', name: 'group.name' },
{ data: 'hospital_name', name: 'hospital.name' },
{ data: 'department_name', name: 'department.name' },
{ data: 'last_status_title', name: 'last_status.title' },
{ data: 'created_at', name: 'created_at' },

{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
    // dom: '<"top"i>rt<"bottom"flp><"clear">',
    // dom: '<"wrapper"flipt>',
    // rowGroup: {
    //     dataSrc: 'group_name'
    // }    
    createdRow: function (row, data, dataIndex) {
        if (data['group_name'] == 'Acil') {
            $(row).addClass('emergency');
        }
    },
  };
  let table = $('.datatable-Travel').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
  $('#form-filter-submit').click(function () {
    table.ajax.reload();
    })
});

</script>
@endsection