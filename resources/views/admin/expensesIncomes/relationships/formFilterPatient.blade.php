


<div class="row">
    <input type="hidden" class="filter" name="category" value="1">
    <div class="col-8">
        <button class="btn-filter btn btn-info" data-category="1"><i class="fas fa-search" ></i> {{ trans('cruds.expense.title') }}</button>
 
        <button class="btn-filter btn btn-secondary" data-category="3"><i class="fas fa-search"></i> {{ trans('cruds.income.title') }}</button>
   
        <button class="btn-filter btn btn-secondary" data-category="2"><i class="fas fa-search"></i> {{ trans('cruds.expensesIncome.commission_ex') }}</button>
   
        <button class="btn-filter btn btn-secondary" data-category="4"><i class="fas fa-search"></i> {{ trans('cruds.expensesIncome.commission_in') }}</button>
    </div>    
    <div class="col-4">
        @can('expenses_income_create')          
            <a class="btn btn-success float-right" href="{{ route('admin.expenses-incomes.create') }}">
              {{ trans('global.add') }} <span id="category-name"> {{ trans('cruds.expensesIncome.title_singular') }}</span> 
            </a>
        @endcan
    </div>

</div>

