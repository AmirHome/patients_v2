@extends('layouts.admin')
@section('content')
@can('doctor_create')
    <div style="margin-bottom: 10px;" class="row">
    <button type="button" class="btn btn-s btn-info" data-toggle="modal" data-target="#doctors-store">
    {{ trans('global.add') }} {{ trans('cruds.doctor.title_singular') }}

    </button>
    @includeIf('admin.doctors.relationships.modal_create')

    </div>

 


@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.doctor.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Doctor">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.hospital') }}
                    </th>
                    <th>
                        {{ trans('cruds.hospital.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.doctor.fields.department') }}
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
@can('doctor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.doctors.massDestroy') }}",
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
  // dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.doctors.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'phone', name: 'phone' },
{ data: 'email', name: 'email' },
{ data: 'address', name: 'address' },
{ data: 'city_name', name: 'city.name' },
{ data: 'hospital_name', name: 'hospital.name' },
{ data: 'hospital.phone', name: 'hospital.phone' },
{ data: 'department_name', name: 'department.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Doctor').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection