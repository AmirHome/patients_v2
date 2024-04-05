@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.patients.update", [$patient->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.patient.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $patient->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="office_id">{{ trans('cruds.patient.fields.office') }}</label>
                <select class="form-control select2 {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id" required>
                    @foreach($offices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('office_id') ? old('office_id') : $patient->office->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('office'))
                    <div class="invalid-feedback">
                        {{ $errors->first('office') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.office_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="campaign_org_id">{{ trans('cruds.patient.fields.campaign_org') }}</label>
                <select class="form-control select2 {{ $errors->has('campaign_org') ? 'is-invalid' : '' }}" name="campaign_org_id" id="campaign_org_id" required>
                    @foreach($campaign_orgs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('campaign_org_id') ? old('campaign_org_id') : $patient->campaign_org->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('campaign_org'))
                    <div class="invalid-feedback">
                        {{ $errors->first('campaign_org') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.campaign_org_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.patient.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $patient->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="middle_name">{{ trans('cruds.patient.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $patient->middle_name) }}" required>
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="surname">{{ trans('cruds.patient.fields.surname') }}</label>
                <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', $patient->surname) }}" required>
                @if($errors->has('surname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('surname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.surname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mother_name">{{ trans('cruds.patient.fields.mother_name') }}</label>
                <input class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}" type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $patient->mother_name) }}" required>
                @if($errors->has('mother_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mother_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.mother_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="father_name">{{ trans('cruds.patient.fields.father_name') }}</label>
                <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', $patient->father_name) }}" required>
                @if($errors->has('father_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('father_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.father_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="citizenship">{{ trans('cruds.patient.fields.citizenship') }}</label>
                <input class="form-control {{ $errors->has('citizenship') ? 'is-invalid' : '' }}" type="text" name="citizenship" id="citizenship" value="{{ old('citizenship', $patient->citizenship) }}" required>
                @if($errors->has('citizenship'))
                    <div class="invalid-feedback">
                        {{ $errors->first('citizenship') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.citizenship_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="passport_no">{{ trans('cruds.patient.fields.passport_no') }}</label>
                <input class="form-control {{ $errors->has('passport_no') ? 'is-invalid' : '' }}" type="text" name="passport_no" id="passport_no" value="{{ old('passport_no', $patient->passport_no) }}" required>
                @if($errors->has('passport_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passport_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.passport_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="passport_origin">{{ trans('cruds.patient.fields.passport_origin') }}</label>
                <input class="form-control {{ $errors->has('passport_origin') ? 'is-invalid' : '' }}" type="text" name="passport_origin" id="passport_origin" value="{{ old('passport_origin', $patient->passport_origin) }}" required>
                @if($errors->has('passport_origin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passport_origin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.passport_origin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="foriegn_phone">{{ trans('cruds.patient.fields.foriegn_phone') }}</label>
                <input class="form-control {{ $errors->has('foriegn_phone') ? 'is-invalid' : '' }}" type="text" name="foriegn_phone" id="foriegn_phone" value="{{ old('foriegn_phone', $patient->foriegn_phone) }}" required>
                @if($errors->has('foriegn_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foriegn_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.foriegn_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.patient.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.patient.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Patient::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $patient->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birthday">{{ trans('cruds.patient.fields.birthday') }}</label>
                <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}" type="text" name="birthday" id="birthday" value="{{ old('birthday', $patient->birthday) }}">
                @if($errors->has('birthday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birthday') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.birthday_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birth_place">{{ trans('cruds.patient.fields.birth_place') }}</label>
                <input class="form-control {{ $errors->has('birth_place') ? 'is-invalid' : '' }}" type="text" name="birth_place" id="birth_place" value="{{ old('birth_place', $patient->birth_place) }}" required>
                @if($errors->has('birth_place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth_place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.birth_place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.patient.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address', $patient->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weight">{{ trans('cruds.patient.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', $patient->weight) }}" step="0.01" required>
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="height">{{ trans('cruds.patient.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', $patient->height) }}" step="0.01" required>
                @if($errors->has('height'))
                    <div class="invalid-feedback">
                        {{ $errors->first('height') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.patient.fields.blood_group') }}</label>
                <select class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" name="blood_group" id="blood_group">
                    <option value disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Patient::BLOOD_GROUP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('blood_group', $patient->blood_group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('blood_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('blood_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.blood_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="treating_doctor">{{ trans('cruds.patient.fields.treating_doctor') }}</label>
                <input class="form-control {{ $errors->has('treating_doctor') ? 'is-invalid' : '' }}" type="text" name="treating_doctor" id="treating_doctor" value="{{ old('treating_doctor', $patient->treating_doctor) }}">
                @if($errors->has('treating_doctor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('treating_doctor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.treating_doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.patient.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $patient->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.patient.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.patients.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($patient) && $patient->photo)
      var file = {!! json_encode($patient->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection