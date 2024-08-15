@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.expensesIncome.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.expenses-incomes.patient.index', $expensesIncome->patient->id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.id') }}
                        </th>
                        <td>
                            {{ $expensesIncome->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.user') }}
                        </th>
                        <td>
                            {{ $expensesIncome->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\ExpensesIncome::CATEGORY_SELECT[$expensesIncome->category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.patient') }}
                        </th>
                        <td>
                            {{ $expensesIncome->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.department') }}
                        </th>
                        <td>
                            {{ $expensesIncome->department->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.amount') }}
                        </th>
                        <td>
                            {{ $expensesIncome->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expensesIncome.fields.description') }}
                        </th>
                        <td>
                            {{ $expensesIncome->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        
        </div>
    </div>
</div>



@endsection