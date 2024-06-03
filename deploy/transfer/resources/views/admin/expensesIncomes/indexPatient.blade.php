@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Patient Info
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ $patient->name}}  {{ $patient->middle_name}} {{ $patient->surname}} {{ $patient->code}}
            </div>
            <div class="col-md-6">
                {{ $patient->city->name}} {{ $patient->city->country->name}}

             </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        @includeIf('admin.expensesIncomes.relationships.formFilterPatient')
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
                        {{ trans('cruds.expensesIncome.fields.category') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.expensesIncome.fields.patient') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.surname') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.expensesIncome.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.expensesIncome.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.expensesIncome.fields.created_at') }}
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
    buttons: [],
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.expenses-incomes.patient.index', $patientId) }}",
        data: function(d) {
            d.ff_category = $('.filter[name="category"]').val();
        }
    },
    columns: [
    { data: 'placeholder', name: 'placeholder' },
    { data: 'id', name: 'id' , visible: false},
    { data: 'category', name: 'category' },
    // { data: 'patient_name', name: 'patient.name' },
    // { data: 'patient.surname', name: 'patient.surname' },
    { data: 'department_name', name: 'department.name' },
    { data: 'amount', name: 'amount' },
    { data: 'created_at', name: 'created_at' },
    { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-ExpensesIncome').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

    function handleFilterButtonClick(category, button) {
        $('.filter[name="category"]').val(category);
        $('.btn-filter').removeClass('btn-info').addClass('btn-secondary');
        button.removeClass('btn-secondary').addClass('btn-info');
        $('#category-name').text(button.text());
        table.ajax.reload(); 
    }

    $('.btn-filter').on('click', function() {
        const category = $(this).data('category');
        handleFilterButtonClick(category, $(this));
    });

});

</script>
@endsection