@extends('layouts.admin')
@section('content')
@includeIf('admin.faqQuestions.create')
@includeIf('admin.faqQuestions.relationships.delete_modal')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            {{ trans('cruds.faqQuestion.title_singular') }} {{ trans('global.list') }}
        </div>
        @can('faq_question_create')
            <div>
                <button class="btn btn-success" data-toggle="modal" data-target="#create-faq-questions">
                    {{ trans('global.add') }} {{ trans('cruds.faqQuestion.title_singular') }}
                </button>
            </div>
        @endcan
    </div>

    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        <table class=" table table-bordered table-hover ajaxTable datatable datatable-FaqQuestion">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.faqQuestion.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.faqQuestion.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.faqQuestion.fields.question') }}
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
@can('faq_question_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.faq-questions.massDestroy') }}",
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
  //// dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.faq-questions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'category_category', name: 'category.category' },
{ data: 'question', name: 'question' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-FaqQuestion').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection