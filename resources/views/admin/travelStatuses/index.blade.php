@extends('layouts.admin')
@section('content')
@can('travel_status_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.travel-statuses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.travelStatus.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.travelStatus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row m-1 pb-3">
            <form action="{{ route('admin.travel-statuses.index') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control search" name="title" placeholder="Title">
                    <input type="text" class="form-control search" name="id" placeholder="Id">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="search-form-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TravelStatus">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.travelStatus.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.travelStatus.fields.ordering') }}
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
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.travel-statuses.index') }}",
        data: function(d) {
            d.s_title = $('.search[name="title"]').val();
            d.s_id = $('.search[name="id"]').val();
        }
    },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'title', name: 'title' },
{ data: 'ordering', name: 'ordering' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-TravelStatus').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

    $('#search-form-submit').click(function () {
        table.ajax.reload();
    })
});


</script>
@endsection