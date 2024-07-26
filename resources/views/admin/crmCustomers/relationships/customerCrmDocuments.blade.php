<div class="card">
    <div class="card-header">
        {{-- Create Modal --}}
        @includeIf('admin.crmCustomers.relationships.customerCrmDocumentsCreate', ['crmDocuments' => $crmCustomer->customerCrmDocuments])
        @includeIf('admin.crmCustomers.relationships.customerCrmDocumentsEdit', ['crmDocuments' => $crmCustomer->customerCrmDocuments])
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-customerCrmDocuments">
                <tbody >
                    @foreach($crmDocuments as $key => $crmDocument)
                    <tr data-entry-id="{{ $crmDocument->id }}" class="activity-hover">
                        <td colspan="3" class="activity-hover">
                            <div class="container-fluid custom-border activity-card">
                                <div class="row mb-3">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div>
                                            <div class="activity-title">
                                                <i class="fas fa-chevron-down mx-3 mb-3 pointer"  style="color:#006C9C"></i>
                                                 <i class="fas fa-chevron-right test mx-3 mb-3 pointer"  style="color:#006C9C;"></i> 
                                                 {{ $crmDocument->status->name ?? '' }}
                                                </div>
                                            <div class="activity-info mx-3 pt-2">     {{ $crmDocument->user->name ?? '' }}
                                            </div>
                                            <div class="mx-3">
                                                @if (!empty($crmDocument->description))
                                                <div class="activity-desc mt-2">
                                                    {{ $crmDocument->description ?? '' }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="activity-info"><span> {{ $crmDocument->created_at ?? '' }} </span></div>
                                            @can('crm_document_edit')
                                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#crm_document_edit_modal" data-crm_document_id={{$crmDocument->id}}>
                                    {{ trans('global.edit') }}
                                </button>
                                @endcan

                                @can('crm_document_delete')
                                    <form action="{{ route('admin.crm-documents.destroy', $crmDocument->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"> {{ trans('global.delete') }} </button>
                                    </form>
                                @endcan

                                        </div>
                                    </div>
                                </div>
                                <table class="table table-custom">
                                    <thead>
                                        <tr class="activity-th">
                                            <th>Dosya</th>
                                            <th>Yükleyen</th>
                                            <th>Açıklama</th>
                                            <th>Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="activity-td">
                                            <td>
                                                @foreach($crmDocument->document_file as $key => $media)
                                                    <div>
                                                        <a href="{{ $media->getUrl() }}" target="_blank" title="{{ $media->file_name }}">
                                                            {{  Str::limit($media->name, 48) }}
                                                        </a><sup>{{ formatSize($media->size) }}</sup>
                                                    </div>
                                                @endforeach
                                            </td>
                                           <td>Serra Tacar - Merkez Ofis</td>
                                            <td>test deneme2344</td>
                                            <td>12/03/2024 08:56:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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

document.addEventListener('DOMContentLoaded', (event) => {
    const downIcons = document.querySelectorAll('.fa-chevron-down'); 
    const rightIcons = document.querySelectorAll('.test');
    const tables = document.querySelectorAll('.table-custom'); 

    downIcons.forEach((icon, index) => {
        const table = tables[index];
        const rightIcon = rightIcons[index];

        table.style.display = 'table'; 
        icon.style.display = 'inline';
        rightIcon.style.display = 'none';

        icon.addEventListener('click', () => {
            table.style.display = 'none'; 
            icon.style.display = 'none'; 
            rightIcon.style.display = 'inline'; 
        });

        rightIcon.addEventListener('click', () => {
            table.style.display = 'table'; 
            rightIcon.style.display = 'none'; 
            icon.style.display = 'inline'; 
        });
    });
});

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
  // dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-customerCrmDocuments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>

@endsection