<div class="modal fade" id="create-doctors" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:18vh;">
        <form method="POST" action="{{ route("admin.doctors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Doctor</div>

            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"   type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.doctor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"  type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.email_helper') }}</span>
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.doctor.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"  name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.city_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="hospital_id">{{ trans('cruds.doctor.fields.hospital') }}</label>
                <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id" required>
                    @foreach($hospitals as $id => $entry)
                        <option value="{{ $id }}" {{ old('hospital_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospital'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.hospital_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.doctor.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.department_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"  name="address" id="address" required>{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.address_helper') }}</span>
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