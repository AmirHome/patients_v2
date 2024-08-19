@extends('layouts.admin')
@section('content')
    <!--Modal Dosyalar-->
    @includeIf('admin.travels.relationships.modalAddTreatmentActivities')

    <!--Modal Reports-->
    @includeIf('admin.travels.relationships.modalAddActivities')

    <div class="card">
        <div class="card-header">{{ trans('cruds.travel.travel_edit') }}</div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#travel_patient" role="tab" data-toggle="tab">
                    <span> {{ trans('cruds.travel.fields.patient_information') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#travel_activities" role="tab" data-toggle="tab">
                    {{ trans('cruds.travel.fields.current_status') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#reports" role="tab" data-toggle="tab">
                    {{ trans('cruds.travel.fields.files') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#information" role="tab" data-toggle="tab">
                    {{ trans('cruds.travel.fields.information') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#dates" role="tab" data-toggle="tab">
                    {{ trans('cruds.travel.fields.dates') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#additional_Information" role="tab" data-toggle="tab">
                    {{ trans('cruds.travel.fields.additional_information') }}
                </a>
            </li>
        </ul>

        <form method="POST" action="{{ route('admin.travels.update', [$travel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="tab-content">
                <!--Tab Hasta Bilgileri-->
                <div class="tab-pane show active" role="tabpanel" id="travel_patient">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                                            <img class="card-img-top rounded-circle" src="https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/no-profile-picture-icon.png" alt="Card image" style="max-width:150px">
                                            <button type="button" class="btn btn-update mt-2" data-toggle="modal" data-target="#modal-profile-photo">{{ trans('cruds.travel.fields.update') }}</button>
                                        </div>
                                        <div class="col-md-6 d-flex flex-column justify-content-center">
                                            <div class="form-group" style="padding: 0px 10px 0px 10px !important">
                                                <label class="required" for="code" style="position: relative; top: 8px; margin-top: -1px !important;margin-left:-23px !important">{{ trans('cruds.travel.fields.patient_code') }}</label>
                                                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" disabled type="text" name="code" id="code" value="{{ old('code', $patient->code ?? null) }}" required>
                                                @if ($errors->has('code'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('code') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.code_helper') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label class="required" for="last_status_id"
                                                    style="position: relative; top: 8px; margin-top: -1px !important;margin-left:-23px !important">{{ trans('cruds.travelTreatmentActivity.fields.status') }}</label>
                                                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="last_status_id" id="last_status_id" required disabled>
                                                    @foreach ($last_statuses as $id => $entry)
                                                        <option value="{{ $id }}" {{ old('last_status_id', $travel->last_status_id ?? null) == $id ? 'selected' : '' }}>
                                                            {{ $entry }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('status'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('status') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.status_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $patient->name ?? null) }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="required" for="surname">{{ trans('cruds.patient.fields.surname') }}</label>
                                                <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', $patient->surname ?? null) }}" required>
                                                @if ($errors->has('surname'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('surname') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.surname_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birth_place">{{ trans('cruds.patient.fields.birth_place') }}</label>
                                                <input class="form-control {{ $errors->has('birth_place') ? 'is-invalid' : '' }}" type="text" name="birth_place" id="birth_place" value="{{ old('birth_place', $patient->birth_place ?? null) }}">
                                                @if ($errors->has('birth_place'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('birth_place') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.birth_place_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birthday" class="required">{{ trans('cruds.patient.fields.birthday') }}</label>
                                                <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}" type="text" name="birthday" id="birthday" required value="{{ old('birthday', $patient->birthday ?? null) }}">
                                                @if ($errors->has('birthday'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('birthday') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.birthday_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required">{{ trans('cruds.patient.fields.gender') }}</label>
                                                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                                                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>
                                                        {{ trans('global.pleaseSelect') }}</option>
                                                    @foreach (App\Models\Patient::GENDER_SELECT as $key => $label)
                                                        <option value="{{ $key }}" {{ old('gender', $patient->gender ?? null) === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('gender') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.gender_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.patient.fields.blood_group') }}</label>
                                                <select class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" name="blood_group" id="blood_group">
                                                    <option value disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>
                                                        {{ trans('global.pleaseSelect') }}</option>
                                                    @foreach (App\Models\Patient::BLOOD_GROUP_SELECT as $key => $label)
                                                        <option value="{{ $key }}" {{ old('blood_group', $patient->blood_group ?? null) === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('blood_group'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('blood_group') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.blood_group_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="height">{{ trans('cruds.patient.fields.height') }}</label>
                                                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', $patient->height ?? null) }}" step="1">
                                                @if ($errors->has('height'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('height') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.height_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weight">{{ trans('cruds.patient.fields.weight') }}</label>
                                                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', $patient->weight ?? null) }}" step="1">
                                                @if ($errors->has('weight'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('weight') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.weight_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone ?? null) }}" required>
                                                @if ($errors->has('phone'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.phone_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $patient->email ?? null) }}">
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.email_helper') }}</span>
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_image">{{ trans('cruds.patient.fields.passport_image') }}</label>
                                                <div class="d-flex flex-column align-items-center justify-content-center mt-2 needsclick dropzone {{ $errors->has('passport_image') ? 'is-invalid' : '' }}" id="passport_image-dropzone">
                                                    <img src="{{ asset('img/upload.png') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid">
                                                    <div class="dz-message" data-dz-message>
                                                        <p>{{ trans('cruds.travel.fields.upload_files') }}</p>
                                                    </div>
                                                </div>
                                                @if ($errors->has('passport_image'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('passport_image') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.passport_image_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger float-right ml-4" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                        <a class="btn float-right for-more" href=""> <!--Patient edite atacak her vakayı kendi editine-->
                                            {{ trans('global.for_more') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <x-reffering-type-component class="col-md-6" :data="['reffering'=>$travel->reffering, 'reffering_type'=>$travel->reffering_type]" />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hospital_id">{{ trans('cruds.travel.fields.winning_hospital') }}</label>
                                                <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id">
                                                    @foreach ($hospitals ?? null as $id => $entry)
                                                        <option value="{{ $id }}" {{ (old('hospital_id') ? old('hospital_id') : $travel->hospital->id ?? '') == $id ? 'selected' : '' }}>
                                                            {{ $entry }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('hospital'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('hospital') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.hospital_helper') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="office_id">{{ trans('cruds.patient.fields.office') }}</label>
                                                <select class="form-control select2 {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id">
                                                    @foreach ($offices ?? [] as $id => $entry)
                                                        <option value="{{ $id }}" {{ (old('office_id') ? old('office_id') : $patient->office->id ?? '') == $id ? 'selected' : '' }}>
                                                            {{ $entry }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('office'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('office') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.office_helper') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department_id">{{ trans('cruds.travel.fields.department') }}</label>
                                                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                                                    @foreach ($departments as $id => $entry)
                                                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $travel->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('department'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('department') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.department_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="group_id">{{ trans('cruds.travel.fields.group') }}</label>
                                                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                                                    @foreach ($groups ?? null as $id => $entry)
                                                        <option value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $travel->group->id ?? '') == $id ? 'selected' : '' }}>
                                                            {{ $entry }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('group'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('group') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.group_helper') }}</span>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-danger float-right" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Tab Dosyalar-->
                <div class="tab-pane" role="tabpanel" id="travel_activities">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div></div>
                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-travel-treatment-activities">
                            {{ trans('global.add') }}
                        </button>
                    </div>
                    @includeIf('admin.travels.relationships.travelTravelTreatmentActivities', [
                        'travelTreatmentActivities' => $travel->travelTravelTreatmentActivities,
                    ])

                </div>
                <!--Tab Bilgilendirmeler-->
                <div class="tab-pane" role="tabpanel" id="information">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attendant_name">{{ trans('cruds.travel.fields.attendant_name') }}</label>
                                        <input class="form-control {{ $errors->has('attendant_name') ? 'is-invalid' : '' }}" type="text" name="attendant_name" id="attendant_name" value="{{ old('attendant_name', $travel->attendant_name) }}">
                                        @if ($errors->has('attendant_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('attendant_name') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.travel.fields.attendant_name_helper') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attendant_phone">{{ trans('cruds.travel.fields.attendant_phone') }}</label>
                                        <input class="form-control {{ $errors->has('attendant_phone') ? 'is-invalid' : '' }}" type="text" name="attendant_phone" id="attendant_phone"
                                            value="{{ old('attendant_phone', $travel->attendant_phone) }}">
                                        @if ($errors->has('attendant_phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('attendant_phone') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.travel.fields.attendant_phone_helper') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="notify_hospitals">{{ trans('cruds.travel.fields.notify_hospitals') }}</label>
                                        <select class="form-control select2 {{ $errors->has('notify_hospitals') ? 'is-invalid' : '' }}" name="notify_hospitals[]" id="notify_hospitals" multiple>
                                            @foreach ($notify_hospitals as $id => $notify_hospital)
                                                <option value="{{ $id }}" {{ in_array($id, old('notify_hospitals', [])) || $travel->notify_hospitals->contains($id) ? 'selected' : '' }}>
                                                    {{ $notify_hospital }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('notify_hospitals'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('notify_hospitals') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.travel.fields.notify_hospitals_helper') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="traslators">{{ trans('cruds.travel.fields.translators') }}</label>
                                        <select class="form-control" name="translatorId">
                                            @foreach ($translators ?? [] as $id => $translator)
                                                <option value="{{ $id }}">{{ $translator }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('translatorId')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <button class="btn btn-danger float-right" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </div>
                <!--Tab Tarihler-->
                <div class="tab-pane" role="tabpanel" id="dates">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hospitalization_date">{{ trans('cruds.travel.fields.hospitalization_date') }}</label>
                                                <input class="form-control date {{ $errors->has('hospitalization_date') ? 'is-invalid' : '' }}" type="text" name="hospitalization_date" id="hospitalization_date"
                                                    value="{{ old('hospitalization_date', $travel->hospitalization_date) }}">
                                                @if ($errors->has('hospitalization_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('hospitalization_date') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.hospitalization_date_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="planning_discharge_date">{{ trans('cruds.travel.fields.planning_discharge_date') }}</label>
                                                <input class="form-control date {{ $errors->has('planning_discharge_date') ? 'is-invalid' : '' }}" type="text" name="planning_discharge_date" id="planning_discharge_date"
                                                    value="{{ old('planning_discharge_date', $travel->planning_discharge_date) }}">
                                                @if ($errors->has('planning_discharge_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('planning_discharge_date') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.planning_discharge_date_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="arrival_date">{{ trans('cruds.travel.fields.arrival_date') }}</label>
                                                <input class="form-control date {{ $errors->has('arrival_date') ? 'is-invalid' : '' }}" type="text" name="arrival_date" id="arrival_date"
                                                    value="{{ old('arrival_date', $travel->arrival_date) }}">
                                                @if ($errors->has('arrival_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('arrival_date') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="departure_date">{{ trans('cruds.travel.fields.departure_date') }}</label>
                                                <input class="form-control date {{ $errors->has('departure_date') ? 'is-invalid' : '' }}" type="text" name="departure_date" id="departure_date"
                                                    value="{{ old('departure_date', $travel->departure_date) }}">
                                                @if ($errors->has('departure_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('departure_date') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.departure_date_helper') }}</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-danger float-right" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_no">{{ trans('cruds.patient.fields.passport_no') }}</label>
                                                <input class="form-control {{ $errors->has('passport_no') ? 'is-invalid' : '' }}" type="text" name="passport_no" id="passport_no" value="{{ old('passport_no', $patient->passport_no ?? null) }}">
                                                @if ($errors->has('passport_no'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('passport_no') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.passport_no_helper') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_origin">{{ trans('cruds.patient.fields.passport_origin') }}</label>
                                                <input class="form-control {{ $errors->has('passport_origin') ? 'is-invalid' : '' }}" type="text" name="passport_origin" id="passport_origin"
                                                    value="{{ old('passport_origin', $patient->passport_origin ?? null) }}">
                                                @if ($errors->has('passport_origin'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('passport_origin') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.passport_origin_helper') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="visa_start_date">{{ trans('cruds.travel.fields.visa_start_date') }}</label>
                                                <input class="form-control date {{ $errors->has('visa_start_date') ? 'is-invalid' : '' }}" type="text" name="visa_start_date" id="visa_start_date"
                                                    value="{{ old('visa_start_date', $travel->visa_start_date) }}">
                                                @if ($errors->has('visa_start_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('visa_start_date') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.visa_start_date_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="visa_end_date">{{ trans('cruds.travel.fields.visa_end_date') }}</label>
                                                <input class="form-control date {{ $errors->has('visa_end_date') ? 'is-invalid' : '' }}" type="text" name="visa_end_date" id="visa_end_date"
                                                    value="{{ old('visa_end_date', $travel->visa_end_date) }}">
                                                @if ($errors->has('visa_end_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('visa_end_date') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.travel.fields.visa_end_date_helper') }}</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-danger float-right" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Tab Rapor-->
                <div class="tab-pane" role="tabpanel" id="reports">
                    <div class="card-body">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div></div>
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-activities">
                                {{ trans('global.add') }}
                            </button>
                        </div>
                        @includeIf('admin.travels.relationships.travelActivities', [
                            'activities' => $travel->travelActivities,
                        ])
                    </div>

                </div>

                <!--Ek Bilgiler-->
                <div class="tab-pane" role="tabpanel" id="additional_Information">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_name">{{ trans('cruds.patient.fields.mother_name') }}</label>
                                                <input class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}" type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $patient->mother_name ?? null) }}">
                                                @if ($errors->has('mother_name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('mother_name') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.mother_name_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_name">{{ trans('cruds.patient.fields.father_name') }}</label>
                                                <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', $patient->father_name ?? null) }}">
                                                @if ($errors->has('father_name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('father_name') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.father_name_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="middle_name">{{ trans('cruds.patient.fields.middle_name') }}</label>
                                                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $patient->middle_name ?? null) }}">
                                                @if ($errors->has('middle_name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('middle_name') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.middle_name_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="citizenship">{{ trans('cruds.patient.fields.citizenship') }}</label>
                                                <input class="form-control {{ $errors->has('citizenship') ? 'is-invalid' : '' }}" type="text" name="citizenship" id="citizenship" value="{{ old('citizenship', $patient->citizenship ?? null) }}">
                                                @if ($errors->has('citizenship'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('citizenship') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.citizenship_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="foriegn_phone">{{ trans('cruds.patient.fields.foriegn_phone') }}</label>
                                                <input class="form-control {{ $errors->has('foriegn_phone') ? 'is-invalid' : '' }}" type="text" name="foriegn_phone" id="foriegn_phone"
                                                    value="{{ old('foriegn_phone', $patient->foriegn_phone ?? null) }}">
                                                @if ($errors->has('foriegn_phone'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('foriegn_phone') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.foriegn_phone_helper') }}</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-danger float-right" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <x-province-component class="col-md-6" :data="['province_id'=>$patient->city_id]" />
                                        <x-campaign-channel-org-component class="col-md-6" :data="[ 'campaign_org_id'=>$patient->campaign_org_id]" />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="treating_doctor">{{ trans('cruds.patient.fields.treating_doctor') }}</label>
                                                <input class="form-control {{ $errors->has('treating_doctor') ? 'is-invalid' : '' }}" type="text" name="treating_doctor" id="treating_doctor"
                                                    value="{{ old('treating_doctor', $patient->treating_doctor ?? null) }}">
                                                @if ($errors->has('treating_doctor'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('treating_doctor') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.patient.fields.treating_doctor_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-danger float-right" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modal-profile-photo" tabindex="-1" role="dialog" aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="card-header text-left mx-3 mt-2">{{ trans('cruds.travel.fields.update_profile_photo') }}</div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.patient.fields.photo') }}</label>
                            <div class="mt-2 needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}  d-flex flex-column align-items-center justify-content-center" id="photo-dropzone">
                                <img src="{{ asset('img/upload.png') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid">
                                <div class="dz-message" data-dz-message>
                                    <p>{{ trans('cruds.travel.fields.upload_files') }}</p>
                                </div>
                            </div>
                            @if ($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.photo_helper') }}</span>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="form-group">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                                {{ trans('global.cancel') }}
                            </button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Photo 
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
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($patient) && $patient->photo)
                    var file = {!! json_encode($patient->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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

        // Passport Image
        Dropzone.options.passportImageDropzone = {
            url: '{{ route('admin.patients.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="passport_image"]').remove()
                $('form').append('<input type="hidden" name="passport_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="passport_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($patient) && $patient->passport_image)
                    var file = {!! json_encode($patient->passport_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="passport_image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
