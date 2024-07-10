@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hotel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hotels.update", [$hotel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
         
                <div class="col-md-8  offset-2 text-align-center">
                <div class="login-info-div">
                <svg class="info-icon" focusable="false" aria-hidden="true" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"></path></svg>
                <span class="login-info">Entered as location link <strong> Example:https://maps.app.goo.gl/AbR3D7knLcMae8b99 </strong> , and The price is entered in TL <strong> 126,12  </strong>               </span> </div>
</div>
</div>
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.hotel.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  type="text" name="name" id="name" value="{{ old('name', $hotel->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.hotel.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"  type="text" name="location" id="location" value="{{ old('location', $hotel->location) }}" required>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="price">{{ trans('cruds.hotel.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"  name="price" id="price" value="{{ old('price', $hotel->price) }}" step="1">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="country_id">{{ trans('cruds.hotel.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $hotel->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hotel.fields.country_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.hotel.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $hotel->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hotel.fields.city_helper') }}</span>
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