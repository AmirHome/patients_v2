@extends('layouts.admin')
@section('content')
<div class="container">

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.travelGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.travel-groups.update", [$travelGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-4 text-align-center">
                <div class="login-info-div">
                <svg class="info-icon" focusable="false" aria-hidden="true" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"></path></svg>
                <span class="login-info">{{ trans('cruds.Other.sample_color_entry') }} <strong> #AA0000 </strong></span> </div>
</div>
</div>
            <div class="row">
                <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.travelGroup.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $travelGroup->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                         {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelGroup.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="color">{{ trans('cruds.travelGroup.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', $travelGroup->color) }}" required>
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
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