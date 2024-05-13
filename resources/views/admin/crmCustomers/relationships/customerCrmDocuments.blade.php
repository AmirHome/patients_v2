<div class="card">
    <div class="card-header">
        {{-- Create Modal --}}
        @includeIf('admin.crmCustomers.relationships.customerCrmDocumentsCreate', ['crmDocuments' => $crmCustomer->customerCrmDocuments])
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-customerCrmDocuments">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.crmDocument.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmDocument.fields.document_file') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmDocument.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmDocument.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmDocument.fields.created_at') }}
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($crmDocuments as $key => $crmDocument)
                        <tr data-entry-id="{{ $crmDocument->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $crmDocument->status->name ?? '' }}
                            </td>
                            <td>
                                @foreach($crmDocument->document_file as $key => $media)
                                    <div>
                                        <a href="{{ $media->getUrl() }}" target="_blank" title="{{ $media->file_name }}">
                                            {{  Str::limit($media->name, 48) }}
                                        </a><sup>{{ formatSize($media->size) }}</sup>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                {{ $crmDocument->description ?? '' }}
                            </td>
                            <td>
                                {{ $crmDocument->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $crmDocument->created_at ?? '' }}
                            </td>
                     
                            <td>
                                @can('crm_document_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.crm-documents.edit', $crmDocument->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('crm_document_delete')
                                    <form action="{{ route('admin.crm-documents.destroy', $crmDocument->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('crm_document_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-documents.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-customerCrmDocuments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>

@endsection