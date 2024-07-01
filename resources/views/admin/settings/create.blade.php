@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5 offset-4 text-align-center">
                <div class="login-info-div">
                <svg class="info-icon" focusable="false" aria-hidden="true" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"></path></svg>
                <span class="login-info">comma separator <strong> Example: info@gmail.com, info@hotmail.com </strong></span> </div>
</div>
</div>
            <div class="row">
                <div class="col-md-4">
            <div class="form-group">
                <label class="required" for="central_hospital_mail">{{ trans('cruds.setting.fields.central_hospital_mail') }}</label>
                <input class="form-control {{ $errors->has('central_hospital_mail') ? 'is-invalid' : '' }}" type="text" name="central_hospital_mail" id="central_hospital_mail" value="{{ old('central_hospital_mail', '') }}" required>
                @if($errors->has('central_hospital_mail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('central_hospital_mail') }}
                    </div>
                @endif
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="central_hospital_mail_cc">{{ trans('cruds.setting.fields.central_hospital_mail_cc') }}</label>
                <input class="form-control {{ $errors->has('central_hospital_mail_cc') ? 'is-invalid' : '' }}" type="text" name="central_hospital_mail_cc" id="central_hospital_mail_cc" value="{{ old('central_hospital_mail_cc', '') }}">
                @if($errors->has('central_hospital_mail_cc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('central_hospital_mail_cc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.central_hospital_mail_cc_helper') }}</span>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="central_hospital_mail_bcc">{{ trans('cruds.setting.fields.central_hospital_mail_bcc') }}</label>
                <input class="form-control {{ $errors->has('central_hospital_mail_bcc') ? 'is-invalid' : '' }}" type="text" name="central_hospital_mail_bcc" id="central_hospital_mail_bcc" value="{{ old('central_hospital_mail_bcc', '') }}">
                @if($errors->has('central_hospital_mail_bcc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('central_hospital_mail_bcc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.central_hospital_mail_bcc_helper') }}</span>
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