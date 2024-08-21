@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        {{ trans('global.show') }} {{ trans('cruds.expensesIncome.title') }}
            <div class="form-group mb-0">
                <a class="btn btn-default" href="{{ route('admin.expenses-incomes.patient.index', $expensesIncome->patient->id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                           <div class="text-left">
                            <div class="show-header ml-4">
                            {{ trans('cruds.expensesIncome.fields.user') }}
                            </div>
                            <span class="show-header-text ml-1">
                            {{ $expensesIncome->user->name ?? '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                              {{ trans('cruds.expensesIncome.fields.category') }}
                            </div>
                            <span class="show-header-text ml-1">
                            {{ App\Models\ExpensesIncome::CATEGORY_SELECT[$expensesIncome->category] ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                            {{ trans('cruds.expensesIncome.fields.patient') }}
                            </div>
                            <span class="show-header-text ml-1">
                            {{ $expensesIncome->patient->name ?? '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                            {{ trans('cruds.expensesIncome.fields.department') }}
                            </div>
                            <span class="show-header-text ml-1">
                            {{ $expensesIncome->department->name ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                            {{ trans('cruds.expensesIncome.fields.amount') }}
                            </div>
                            <span class="show-header-text ml-1">
                           € {{ $expensesIncome->amount }}
                            </span>
                        </div>
                    </div>
                  
                </div>
                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                    <div class="col-md-12">
                        <div class="text-left show-desc-header">
                            {{ trans('cruds.expensesIncome.fields.description') }}
                        </div>
                        <span class="show-header-desc-text">
                            {{ $expensesIncome->description }}
                        </span>
                    </div>
              
                </div>
            </div>
        </div>
    </div>
</div>

 
  
        


@endsection