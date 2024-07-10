<div class="modal fade" id="create-hospitals" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.hospitals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Hospital</div>
            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.hospital.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.hospital.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"  type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.email_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.hospital.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.phone_helper') }}</span>
            </div>
            </div>
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="fax">{{ trans('cruds.hospital.fields.fax') }}</label>
                <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax', '') }}" required>
                @if($errors->has('fax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.fax_helper') }}</span>
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.hospital.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"  type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.address_helper') }}</span>
            </div>
            </div>
</div>
<div class="row justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.cancel') }}
                        </button>
                    </div>
                    <div class="form-group ">
                        <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>



