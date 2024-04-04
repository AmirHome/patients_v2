@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ministry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ministries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.ministry.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.ministry.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code_inc">{{ trans('cruds.ministry.fields.code_inc') }}</label>
                <input class="form-control {{ $errors->has('code_inc') ? 'is-invalid' : '' }}" type="number" name="code_inc" id="code_inc" value="{{ old('code_inc', '0') }}" step="1" required>
                @if($errors->has('code_inc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code_inc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.code_inc_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection