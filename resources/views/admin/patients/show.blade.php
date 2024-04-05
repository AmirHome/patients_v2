@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.user') }}
                        </th>
                        <td>
                            {{ $patient->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.office') }}
                        </th>
                        <td>
                            {{ $patient->office->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.campaign_org') }}
                        </th>
                        <td>
                            {{ $patient->campaign_org->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.city') }}
                        </th>
                        <td>
                            {{ $patient->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.name') }}
                        </th>
                        <td>
                            {{ $patient->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $patient->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.surname') }}
                        </th>
                        <td>
                            {{ $patient->surname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.mother_name') }}
                        </th>
                        <td>
                            {{ $patient->mother_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.father_name') }}
                        </th>
                        <td>
                            {{ $patient->father_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.citizenship') }}
                        </th>
                        <td>
                            {{ $patient->citizenship }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.passport_no') }}
                        </th>
                        <td>
                            {{ $patient->passport_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.passport_origin') }}
                        </th>
                        <td>
                            {{ $patient->passport_origin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.phone') }}
                        </th>
                        <td>
                            {{ $patient->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.foriegn_phone') }}
                        </th>
                        <td>
                            {{ $patient->foriegn_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.email') }}
                        </th>
                        <td>
                            {{ $patient->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Patient::GENDER_SELECT[$patient->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.birthday') }}
                        </th>
                        <td>
                            {{ $patient->birthday }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.birth_place') }}
                        </th>
                        <td>
                            {{ $patient->birth_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.address') }}
                        </th>
                        <td>
                            {{ $patient->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.weight') }}
                        </th>
                        <td>
                            {{ $patient->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.height') }}
                        </th>
                        <td>
                            {{ $patient->height }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.blood_group') }}
                        </th>
                        <td>
                            {{ App\Models\Patient::BLOOD_GROUP_SELECT[$patient->blood_group] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.treating_doctor') }}
                        </th>
                        <td>
                            {{ $patient->treating_doctor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.code') }}
                        </th>
                        <td>
                            {{ $patient->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.photo') }}
                        </th>
                        <td>
                            @if($patient->photo)
                                <a href="{{ $patient->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $patient->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#patient_travels" role="tab" data-toggle="tab">
                {{ trans('cruds.travel.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="patient_travels">
            @includeIf('admin.patients.relationships.patientTravels', ['travels' => $patient->patientTravels])
        </div>
    </div>
</div>

@endsection