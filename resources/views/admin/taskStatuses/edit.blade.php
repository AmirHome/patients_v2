@extends('layouts.admin')
@section('content')
<div class="container">

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taskStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task-statuses.update", [$taskStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taskStatus.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter Name.." type="text" name="name" id="name" value="{{ old('name', $taskStatus->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                         {{ str_replace('name', trans('global.name'), $errors->first('name')) }}

                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.taskStatus.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">

            <div class="form-group">
                <label for="color">{{ trans('cruds.taskStatus.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" placeholder="Enter Color.." type="text" name="color" id="color" value="{{ old('color', $taskStatus->color) }}">
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.taskStatus.fields.color_helper') }}</span>
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