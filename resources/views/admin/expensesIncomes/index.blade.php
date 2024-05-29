@extends('layouts.admin')
@section('content')
@can('expenses_income_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.expenses-incomes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.expensesIncome.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.expensesIncome.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ExpensesIncome">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.expensesIncome.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.expensesIncome.fields.patient') }}
                    </th>
                    <th>
                         total_expenses 
                    </th>
                    <th>
                        total_income 
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

  let dtOverrideGlobals = {
    dom: 'rtlp',
    // buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.expenses-incomes.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'patient_id', name: 'patient_id' },
        { data: 'patient_name', name: 'patient.name' },
        { data: 'total_expenses', name: 'total_expenses' },
        { data: 'total_income', name: 'total_income' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-ExpensesIncome').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection