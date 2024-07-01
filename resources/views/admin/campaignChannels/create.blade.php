@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.campaignChannel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.campaign-channels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.campaignChannel.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Channel Name.." type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignChannel.fields.title_helper') }}</span>
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