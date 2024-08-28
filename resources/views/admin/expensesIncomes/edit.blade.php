@extends('layouts.admin')
@section('content')
<div class="container">

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.expensesIncome.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expenses-incomes.update", [$expensesIncome->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.expensesIncome.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required disabled>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $expensesIncome->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expensesIncome.fields.user_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="required">{{ trans('cruds.expensesIncome.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category" required>
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ExpensesIncome::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $expensesIncome->category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expensesIncome.fields.category_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="patient_id">{{ trans('cruds.expensesIncome.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id">
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $expensesIncome->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expensesIncome.fields.patient_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label for="department_id">{{ trans('cruds.expensesIncome.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $expensesIncome->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expensesIncome.fields.department_helper') }}</span>
            </div>
            </div>
              <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.expensesIncome.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="Enter Amaount..." type="number" name="amount" id="amount" value="{{ old('amount', $expensesIncome->amount) }}" step="10" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expensesIncome.fields.amount_helper') }}</span>
            </div>
            </div>
                          <div class="col-md-4">

            <div class="form-group">
                <label class="required" for="created_at">{{ trans('cruds.campaignOrg.fields.created_at') }}</label>
                <input class="form-control date {{ $errors->has('created_at') ? 'is-invalid' : '' }}" type="text" name="created_at" id="created_at" value="{{ old('created_at', $expensesIncome->created_at) }}" required>
                @if($errors->has('created_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('created_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignOrg.fields.created_at_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('cruds.expensesIncome.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $expensesIncome->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expensesIncome.fields.description_helper') }}</span>
            </div>
            </div>
     
            </div>

            <div class="form-group">
                <button class="btn btn-danger float-right" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>



@endsection