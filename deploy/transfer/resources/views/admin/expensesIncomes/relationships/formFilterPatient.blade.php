
<div class="row">
    <input type="hidden" class="filter" name="category" value="1">
    <div class="col-8">
        <button class="btn-filter btn btn-info" data-category="1"><i class="fas fa-search" ></i> Expenses</button>
 
        <button class="btn-filter btn btn-secondary" data-category="3"><i class="fas fa-search"></i> Income</button>
   
        <button class="btn-filter btn btn-secondary" data-category="2"><i class="fas fa-search"></i> Commission Ex</button>
   
        <button class="btn-filter btn btn-secondary" data-category="4"><i class="fas fa-search"></i> Commission In</button>
    </div>    
    <div class="col-4">
        @can('expenses_income_create')
            <a class="btn btn-success float-right" href="{{ route('admin.expenses-incomes.create') }}">
               {{ trans('global.add') }} <span id="category-name">Expenses Income</span>
            </a>
        @endcan
    </div>

</div>

