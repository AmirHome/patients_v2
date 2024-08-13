<form class="" action="{{ route('admin.expenses-incomes.index',$type) }}" method="GET">
<div class="card-header ml-3">Expenses Filter</div>
<div class="card-body mb-2">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">{{ trans('cruds.travel.fields.patient_code') }}</label>
                <input type="text" class="form-control filter"
                    name="patient_code">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">{{ trans('cruds.travel.fields.patient_name') }}</label>
                <input type="text" class="form-control filter"
                    name="patient_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mt-1">
                <label>{{ trans('cruds.province.fields.country') }}</label>
                <select class="form-control select2 filter" name="country_id">
                    <option value=""></option>
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="bar">
        <div class="row">
            <div class="col-8">
                @can('expenses_income_create')
                    <a class="btn btn-success" href="{{ route('admin.expenses-incomes.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.expensesIncome.title_singular') }}
                    </a>
                @endcan
            </div>
            <div class="col-4">
                <button class="float-right btn btn-primary" type="button" id="form-filter-submit">
                    {{trans('cruds.travel.fields.search') }}  <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>

</div>
