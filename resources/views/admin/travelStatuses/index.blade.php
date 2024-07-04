@extends('layouts.admin')
@section('content')
@includeIf('admin.travelStatuses.create')

@can('travel_status_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button class="btn btn-success"  data-toggle="modal" data-target="#create-travel-status">
                {{ trans('global.add') }} {{ trans('cruds.travelStatus.title_singular') }}
            </button>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.travelStatus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        @includeIf('admin.travelStatuses.relationships.formFilter', [])
        <table class=" table table-bordered  table-hover ajaxTable datatable datatable-TravelStatus">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.travelStatus.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.travelStatus.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.travelStatus.fields.ordering') }}
                    </th>
                    <th width="0">
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
@can('travel_status_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.travel-statuses.massDestroy') }}",
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
        url: "{{ route('admin.travel-statuses.index') }}",
        data: function(d) {
            d.ff_title = $('.filter[name="title"]').val();
            d.ff_id = $('.filter[name="id"]').val();
        }
    },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'ordering', name: 'ordering' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'asc' ], [ 1, 'asc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-TravelStatus').DataTable(dtOverrideGlobals);
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