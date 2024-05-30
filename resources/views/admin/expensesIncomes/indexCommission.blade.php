@extends('layouts.admin')
@section('content')

{{-- <div style="height: 32rem;"> --}}
    <div class="card">
        <div class="card-header">
            head
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <livewire:livewire-column-chart
                        key="{{ $columnChartModel->reactiveKey() }}"
                        :column-chart-model="$columnChartModel" >
                </div>
                <div class="col-md-6">
    
                    <livewire:livewire-pie-chart
                        key="{{ $pieChartModel->reactiveKey() }}"
                        :pie-chart-model="$pieChartModel"
                    />
                 </div>
            </div>
        </div>
    </div>
    
    {{-- </div> --}}

@includeIf('admin.expensesIncomes.relationships.formFilter')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.expensesIncome.commission') }} {{ trans('global.list') }}
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
                         patient_code 
                    </th>
                    <th>
                         countery 
                    </th>
                    <th>
                        total commission expenses 
                    </th>
                    <th>
                        total commission income 
                    </th>
                    <th>
                        total difference
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
@livewireChartsScripts
<livewire:scripts />
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    dom: 'rlftp',
    // buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
    url: "{{ route('admin.expenses-incomes.index.commission') }}",
        data: function(d) {
            d.ff_patient_id = $('.filter[name="patient_id"]').val();
            d.ff_patient_name = $('.filter[name="patient_name"]').val();
            d.ff_patient_code = $('.filter[name="patient_code"]').val();
        }
    },
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'patient_id', name: 'patient_id' },
        { data: 'patient_name', name: 'patient.name' },
        { data: 'patient.code', name: 'patient.code' },
        { data: 'country_name', name: 'patient.city.country.name', sortable: false},
        { data: 'total_expenses_commission', name: 'total_expenses_commission', searchable:false, sortable: false },
        { data: 'total_income_commission', name: 'total_income_commission', searchable:false, sortable: false },
        { data: 'total_difference', name: 'total_difference', searchable:false, sortable: false },
        { data: 'actions', name: '{{ trans('global.actions') }}' , sortable: false}
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
  
  $('#form-filter-submit').click(function () {
      table.ajax.reload();
  })
});


</script>

@endsection