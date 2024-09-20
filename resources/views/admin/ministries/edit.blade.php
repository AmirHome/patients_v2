@extends('layouts.admin')
@section('content')
<div class="container">
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ministry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ministries.update", [$ministry->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.ministry.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  type="text" name="name" id="name" value="{{ old('name', $ministry->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                         {{ str_replace('name', trans('global.name'), $errors>first('name')) }}

                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">

            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.ministry.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"   type="text" name="code" id="code" value="{{ old('code', $ministry->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.code_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">

            <div class="form-group">
                <label class="required" for="code_inc">{{ trans('cruds.ministry.fields.code_inc') }}</label>
                <input class="form-control {{ $errors->has('code_inc') ? 'is-invalid' : '' }}"  type="number" name="code_inc" id="code_inc" value="{{ old('code_inc', $ministry->code_inc) }}" step="1" required>
                @if($errors->has('code_inc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code_inc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.code_inc_helper') }}</span>
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