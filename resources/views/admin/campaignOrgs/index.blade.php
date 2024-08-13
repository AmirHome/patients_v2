@extends('layouts.admin')
@section('content')
@includeIf('admin.campaignOrgs.create')
@includeIf('admin.campaignOrgs.relationships.delete_modal')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            {{ trans('cruds.campaignOrg.title_singular') }} {{ trans('global.list') }}
        </div>
        @can('campaign_org_create')
            <div>
                <button class="btn btn-success" data-toggle="modal" data-target="#create-campaign-orgs">
                    {{ trans('global.add') }} {{ trans('cruds.campaignOrg.title_singular') }}
                </button>
            </div>
        @endcan
    </div>

    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        <table class=" table table-bordered  table-hover ajaxTable datatable datatable-CampaignOrg">
            <thead>
                <tr>
                    <th width="10">

                    </th>

                    <th>
                        {{ trans('cruds.campaignOrg.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.campaignOrg.fields.channel') }}
                    </th>
                    <th>
                        {{ trans('cruds.campaignOrg.fields.started_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.campaignOrg.fields.status') }}
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
@can('campaign_org_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.campaign-orgs.massDestroy') }}",
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
    ajax: "{{ route('admin.campaign-orgs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'title', name: 'title' },
{ data: 'channel_title', name: 'channel.title' },
{ data: 'started_at', name: 'started_at' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-CampaignOrg').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection