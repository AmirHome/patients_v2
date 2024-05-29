<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.expenses-incomes.index') }}" method="GET">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">patient Code</label>
                        <input type="text" class="form-control filter" placeholder="Enter patient code"
                            name="patient_code">
                        <span class="text-danger">@error('patient_code'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">patient name</label>
                        <input type="text" class="form-control filter" placeholder="Enter patient name"
                            name="patient_name">

                        <span class="text-danger">@error('patient_name'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>

            <div class="bar">
                <div class="row">
                    <div class="col-8">
                        @can('expenses_income_create')
                            <a class="btn btn-success" href="{{ route('admin.expenses-incomes.create') }}">
                                <i class="fas fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.expensesIncome.title_singular') }}
                            </a>
                        @endcan
                    </div>
                    <div class="col-4">
                        <button class="float-right btn btn-primary" type="button" id="form-filter-submit">
                            Search <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>