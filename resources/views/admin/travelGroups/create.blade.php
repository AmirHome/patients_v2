@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.travelGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.travel-groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.travelGroup.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelGroup.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="color">{{ trans('cruds.travelGroup.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', '') }}" required>
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelGroup.fields.color_helper') }}</span>
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