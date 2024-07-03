@extends('layouts.admin')
@section('content')

@includeIf('admin.crmCustomers.relationships.formFilter')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.crmCustomer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        <table class=" table table-bordered table-hover ajaxTable datatable datatable-CrmCustomer">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ministry.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.campaign') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.status') }}
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
@can('crm_customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-customers.massDestroy') }}",
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
        url: "{{ route('admin.crm-customers.index') }}",
        data: function(d) {
            d.ff_name = $('.filter[name="name"]').val();
            d.ff_status_id = $('.filter[name="status_id"]').val();
            d.ff_campaign_start = $('.filter[name="campaign_start"]').val();
            d.ff_campaign_end = $('.filter[name="campaign_end"]').val();
        }
    },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'full_name', name: 'full_name'},
{ data: 'email', name: 'email' },
{ data: 'phone', name: 'phone' },
{ data: 'city_name', name: 'city_name' },
{ data: 'campaign_title', name: 'campaign.title' },
{ data: 'status_name', name: 'status.name' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-CrmCustomer').DataTable(dtOverrideGlobals);
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