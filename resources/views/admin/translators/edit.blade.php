@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.translator.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.translators.update", [$translator->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.translator.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"  placeholder="Enter Translators..." id="title" value="{{ old('title', $translator->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.translator.fields.title_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.translator.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text"  placeholder="Enter Email..." name="email" id="email" value="{{ old('email', $translator->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.translator.fields.email_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.translator.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"  placeholder="Enter Phone..." type="text" name="phone" id="phone" value="{{ old('phone', $translator->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.translator.fields.phone_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.translator.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $translator->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.translator.fields.city_helper') }}</span>
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