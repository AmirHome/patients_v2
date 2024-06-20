<form class="" action="{{ route('admin.expenses-incomes.index',$type) }}" method="GET">

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="">patient Code</label>
                <input type="text" class="form-control filter" placeholder="Enter patient code"
                    name="patient_code">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">patient name</label>
                <input type="text" class="form-control filter" placeholder="Enter patient name"
                    name="patient_name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ trans('cruds.province.fields.country') }}</label>
                <select class="form-control select2 filter" name="country_id">
                    <option value="">All</option>
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>campaign org</label>
                <select class="form-control select2 filter" name="campaign_org_id">
                    <option value="">All</option>
                    @foreach($campaign_orgs as $id => $entry)
                        <option value="{{ $id }}" {{ old('campaign_org_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                    Search <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>

