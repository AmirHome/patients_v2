@extends('layouts.admin')
@section('content')

<div class="card">
<div class="card-header d-flex justify-content-between align-items-center mb-0 pb-0">
            <span>  {{ trans('cruds.patient.title_ex') }} </span>
            <div class="form-group mb-0 pb-0">
                <a class="btn btn-default" href="{{ route('admin.expenses-incomes.index', ['type' => 'financial']) }}">
                    {{ trans('global.back_to_list') }} 
                </a>
            </div>
            </div>

    <div class="card-header">
    </div>
    <div class="card-body mb-5">
        <div class="row">
            <div class="col-md-6">
            <div class="text-left">

            <div class="show-header ml-4"> {{ trans('cruds.patient.patient_name') }}</div>
            <span class="show-header-text ml-1">  {{ $patient->name}} </span>
              </div>
              </div>

              <div class="col-md-6">
            <div class="text-left">

            <div class="show-header ml-4"> {{ trans('cruds.patient.patient_other_name') }} </div>
            <span class="show-header-text ml-1">   {{ $patient->middle_name}} </span>
              </div>
              </div>
              </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4"> {{ trans('cruds.patient.patient_surname') }}</div>
                            <span class="show-header-text ml-1"> {{ $patient->surname}} </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4"> {{ trans('cruds.patient.patient_code') }}</div>
                            <span class="show-header-text ml-1"> {{ $patient->code}} </span>
                        </div>
                    </div>
                    </div>
                    <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4"> {{ trans('cruds.patient.city') }}</div>
                            <span class="show-header-text ml-1"> {{ $patient->city->name}} </span>
                        </div>  
                        </div>  

            <div class="col-md-6">
            <div class="text-left">
                            <div class="show-header ml-4">  {{ trans('cruds.patient.country') }}</div>
                            <span class="show-header-text ml-1"> {{ $patient->city->country->name}} </span>
                          </div>  
                        </div>  
                    </div>
                </div>
            </div>
    <div class="card">
    <div class="card-header">
        @includeIf('admin.expensesIncomes.relationships.create')
        @includeIf('admin.expensesIncomes.relationships.formFilterPatient')
    </div>


    <div class="card-body" style="padding: 40px 16.6% 40px 0px; !important;margin:0px !important">
        <table class=" table table-bordered table-hover ajaxTable datatable datatable-ExpensesIncome">
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