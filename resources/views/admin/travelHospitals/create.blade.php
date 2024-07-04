<div class="modal fade" id="create-travel-hospital" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.travel-hospitals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Travel Hospital</div>

            <div class="row">
                <div class="col-md-8 offset-2 text-align-center">
                <div class="login-info-div">
                <svg class="info-icon" focusable="false" aria-hidden="true" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"></path></svg>
                <span class="login-info">comma separator <strong> Example: info@gmail.com, info@hotmail.com </strong></span> </div>
</div>
</div>
            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.travelHospital.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Hospital Name.." type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelHospital.fields.title_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="email">{{ trans('cruds.travelHospital.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email.."  type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger float-right mb-5" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>



