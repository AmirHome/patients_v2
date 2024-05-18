@extends('layouts.admin')
@section('content')

@includeIf('admin.tasks.relationships.formFilter')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Task">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.task.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.created_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.emergency') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.assigned_to') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.attachment') }}
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
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasks.massDestroy') }}",
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
    // buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.tasks.index') }}",
        data: function(d) {
            d.ff_content = $('.filter[name="content"]').val();
            d.ff_status_id = $('.filter[name="status_id"]').val();
            d.ff_assignee = $('.filter[name="assignee"]').val();
        }
    },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'created_at', name: 'created_at' },
{ data: 'due_date', name: 'due_date' },
{ data: 'name', name: 'name' },
{ data: 'emergency', name: 'emergency' ,visible: false},
{ data: 'status_name', name: 'status.name' },
{ data: 'assigned_to_name', name: 'assigned_to.name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    createdRow: function (row, data, dataIndex) {
        if (data['emergency'] == 'Emergency') {
            $(row).addClass('emergency');
        }
    },
    orderCellsTop: true,
    order: [[ 8, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Task').DataTable(dtOverrideGlobals);
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