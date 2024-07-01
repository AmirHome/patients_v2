@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.travelStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.travel-statuses.update", [$travelStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.travelStatus.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $travelStatus->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelStatus.fields.title_helper') }}</span>
            </div>            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="ordering">{{ trans('cruds.travelStatus.fields.ordering') }}</label>
                <input class="form-control {{ $errors->has('ordering') ? 'is-invalid' : '' }}" type="number" name="ordering" id="ordering" value="{{ old('ordering', $travelStatus->ordering) }}" step="1">
                @if($errors->has('ordering'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ordering') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelStatus.fields.ordering_helper') }}</span>
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



@endsection