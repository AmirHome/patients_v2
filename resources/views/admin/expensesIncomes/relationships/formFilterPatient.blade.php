
<div class="row">
    <input type="hidden" class="filter" name="category" value="1">
    <div class="col-6">
        @can('expenses_income_create')
            <a class="btn btn-success" href="{{ route('admin.expenses-incomes.create') }}">
                <i class="fas fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.expensesIncome.title_singular') }}
            </a>
        @endcan
    </div>
    <div class="col-6">
        <button id="filter-expenses" class="filter btn btn-info"><i class="fas fa-search"></i> Expenses</button>
 
        <button id="filter-income" class="filter btn btn-secondary"><i class="fas fa-search"></i> Income</button>
   
        <button id="filter-expenses-commission" class="filter btn btn-secondary"><i class="fas fa-search"></i> Commission Ex</button>
   
        <button id="filter-income-commission" class="filter btn btn-secondary"><i class="fas fa-search"></i> Commission</button>
    </div>
</div>

