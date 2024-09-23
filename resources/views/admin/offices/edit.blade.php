@extends('layouts.admin')
@section('content')
<div class="container">

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.office.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.offices.update", [$office->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.office.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $office->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                         {{ str_replace('name', trans('global.name'), $errors->first('name')) }}

                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.office.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.office.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"  name="phone" id="phone" value="{{ old('phone', $office->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ str_replace('phone', trans('global.phone'), $errors->first('phone')) }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.office.fields.phone_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="fax">{{ trans('cruds.office.fields.fax') }}</label>
                <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax', $office->fax) }}" required>
                @if($errors->has('fax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.office.fields.fax_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
   
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.office.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $office->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.office.fields.city_helper') }}</span>
            </div>
            </div>
</div>
                <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.office.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"  name="address" id="address" required>{{ old('address', $office->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.office.fields.address_helper') }}</span>
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