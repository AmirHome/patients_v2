@extends('layouts.admin')
@section('content')
@includeIf('admin.hotels.create')
@includeIf('admin.hotels.relationships.delete_modal')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
        {{ trans('cruds.hotel.title_singular') }} {{ trans('global.list') }}
        </div>
        @can('hotel_create')
    <div>
        <button class="btn btn-success" data-toggle="modal" data-target="#create-hotels">
            {{ trans('global.add') }} {{ trans('cruds.hotel.title_singular') }}
        </button>
    </div>
        @endcan
    </div>

    <div class="card-body"  style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        <table class="table table-bordered table-hover ajaxTable datatable datatable-Hotel">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hotel.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.hotel.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.hotel.fields.location') }}
                    </th>
                    <th>
                        {{ trans('cruds.hotel.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.hotel.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.hotel.fields.city') }}
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
@can('hotel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hotels.massDestroy') }}",
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
    ajax: "{{ route('admin.hotels.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'location', name: 'location' },
{ data: 'price', name: 'price' },
{ data: 'country_name', name: 'country.name' },
{ data: 'city_name', name: 'city.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Hotel').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection