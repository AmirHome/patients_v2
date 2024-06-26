@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.travel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.travels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.travel.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="group_id">{{ trans('cruds.travel.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hospital_id">{{ trans('cruds.travel.fields.hospital') }}</label>
                <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id">
                    @foreach($hospitals as $id => $entry)
                        <option value="{{ $id }}" {{ old('hospital_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospital'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="department_id">{{ trans('cruds.travel.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_status_id">{{ trans('cruds.travel.fields.last_status') }}</label>
                <select class="form-control select2 {{ $errors->has('last_status') ? 'is-invalid' : '' }}" name="last_status_id" id="last_status_id" required>
                    @foreach($last_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('last_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('last_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.last_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attendant_name">{{ trans('cruds.travel.fields.attendant_name') }}</label>
                <input class="form-control {{ $errors->has('attendant_name') ? 'is-invalid' : '' }}" type="text" name="attendant_name" id="attendant_name" value="{{ old('attendant_name', '') }}">
                @if($errors->has('attendant_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendant_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.attendant_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attendant_address">{{ trans('cruds.travel.fields.attendant_address') }}</label>
                <textarea class="form-control {{ $errors->has('attendant_address') ? 'is-invalid' : '' }}" name="attendant_address" id="attendant_address">{{ old('attendant_address') }}</textarea>
                @if($errors->has('attendant_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendant_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.attendant_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attendant_phone">{{ trans('cruds.travel.fields.attendant_phone') }}</label>
                <input class="form-control {{ $errors->has('attendant_phone') ? 'is-invalid' : '' }}" type="text" name="attendant_phone" id="attendant_phone" value="{{ old('attendant_phone', '') }}">
                @if($errors->has('attendant_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendant_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.attendant_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_pestilence') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_pestilence" value="0">
                    <input class="form-check-input" type="checkbox" name="has_pestilence" id="has_pestilence" value="1" {{ old('has_pestilence', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_pestilence">{{ trans('cruds.travel.fields.has_pestilence') }}</label>
                </div>
                @if($errors->has('has_pestilence'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_pestilence') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.has_pestilence_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('hospital_mail_notify') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="hospital_mail_notify" value="0">
                    <input class="form-check-input" type="checkbox" name="hospital_mail_notify" id="hospital_mail_notify" value="1" {{ old('hospital_mail_notify', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="hospital_mail_notify">{{ trans('cruds.travel.fields.hospital_mail_notify') }}</label>
                </div>
                @if($errors->has('hospital_mail_notify'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_mail_notify') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.hospital_mail_notify_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notify_hospitals">{{ trans('cruds.travel.fields.notify_hospitals') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('notify_hospitals') ? 'is-invalid' : '' }}" name="notify_hospitals[]" id="notify_hospitals" multiple>
                    @foreach($notify_hospitals as $id => $notify_hospital)
                        <option value="{{ $id }}" {{ in_array($id, old('notify_hospitals', [])) ? 'selected' : '' }}>{{ $notify_hospital }}</option>
                    @endforeach
                </select>
                @if($errors->has('notify_hospitals'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notify_hospitals') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.notify_hospitals_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reffering">{{ trans('cruds.travel.fields.reffering') }}</label>
                <input class="form-control {{ $errors->has('reffering') ? 'is-invalid' : '' }}" type="text" name="reffering" id="reffering" value="{{ old('reffering', '') }}">
                @if($errors->has('reffering'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reffering') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.reffering_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.travel.fields.reffering_type') }}</label>
                <select class="form-control {{ $errors->has('reffering_type') ? 'is-invalid' : '' }}" name="reffering_type" id="reffering_type" required>
                    <option value disabled {{ old('reffering_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Travel::REFFERING_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('reffering_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('reffering_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reffering_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.reffering_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hospitalization_date">{{ trans('cruds.travel.fields.hospitalization_date') }}</label>
                <input class="form-control date {{ $errors->has('hospitalization_date') ? 'is-invalid' : '' }}" type="text" name="hospitalization_date" id="hospitalization_date" value="{{ old('hospitalization_date') }}">
                @if($errors->has('hospitalization_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospitalization_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.hospitalization_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="planning_discharge_date">{{ trans('cruds.travel.fields.planning_discharge_date') }}</label>
                <input class="form-control date {{ $errors->has('planning_discharge_date') ? 'is-invalid' : '' }}" type="text" name="planning_discharge_date" id="planning_discharge_date" value="{{ old('planning_discharge_date') }}">
                @if($errors->has('planning_discharge_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('planning_discharge_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.planning_discharge_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="arrival_date">{{ trans('cruds.travel.fields.arrival_date') }}</label>
                <input class="form-control date {{ $errors->has('arrival_date') ? 'is-invalid' : '' }}" type="text" name="arrival_date" id="arrival_date" value="{{ old('arrival_date') }}">
                @if($errors->has('arrival_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arrival_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departure_date">{{ trans('cruds.travel.fields.departure_date') }}</label>
                <input class="form-control date {{ $errors->has('departure_date') ? 'is-invalid' : '' }}" type="text" name="departure_date" id="departure_date" value="{{ old('departure_date') }}">
                @if($errors->has('departure_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('departure_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.departure_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('wants_shopping') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="wants_shopping" value="0">
                    <input class="form-check-input" type="checkbox" name="wants_shopping" id="wants_shopping" value="1" {{ old('wants_shopping', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="wants_shopping">{{ trans('cruds.travel.fields.wants_shopping') }}</label>
                </div>
                @if($errors->has('wants_shopping'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wants_shopping') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.wants_shopping_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('visa_status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="visa_status" value="0">
                    <input class="form-check-input" type="checkbox" name="visa_status" id="visa_status" value="1" {{ old('visa_status', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="visa_status">{{ trans('cruds.travel.fields.visa_status') }}</label>
                </div>
                @if($errors->has('visa_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.visa_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visa_start_date">{{ trans('cruds.travel.fields.visa_start_date') }}</label>
                <input class="form-control date {{ $errors->has('visa_start_date') ? 'is-invalid' : '' }}" type="text" name="visa_start_date" id="visa_start_date" value="{{ old('visa_start_date') }}">
                @if($errors->has('visa_start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa_start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.visa_start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visa_end_date">{{ trans('cruds.travel.fields.visa_end_date') }}</label>
                <input class="form-control date {{ $errors->has('visa_end_date') ? 'is-invalid' : '' }}" type="text" name="visa_end_date" id="visa_end_date" value="{{ old('visa_end_date') }}">
                @if($errors->has('visa_end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa_end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.visa_end_date_helper') }}</span>
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