@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.travel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.id') }}
                        </th>
                        <td>
                            {{ $travel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.patient') }}
                        </th>
                        <td>
                            {{ $travel->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.group') }}
                        </th>
                        <td>
                            {{ $travel->group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.hospital') }}
                        </th>
                        <td>
                            {{ $travel->hospital->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.department') }}
                        </th>
                        <td>
                            {{ $travel->department->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.last_status') }}
                        </th>
                        <td>
                            {{ $travel->last_status->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.attendant_name') }}
                        </th>
                        <td>
                            {{ $travel->attendant_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.attendant_address') }}
                        </th>
                        <td>
                            {{ $travel->attendant_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.attendant_phone') }}
                        </th>
                        <td>
                            {{ $travel->attendant_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.has_pestilence') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $travel->has_pestilence ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.hospital_mail_notify') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $travel->hospital_mail_notify ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.notify_hospitals') }}
                        </th>
                        <td>
                            @foreach($travel->notify_hospitals as $key => $notify_hospitals)
                                <span class="label label-info">{{ $notify_hospitals->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.reffering') }}
                        </th>
                        <td>
                            {{ $travel->reffering }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.reffering_type') }}
                        </th>
                        <td>
                            {{ App\Models\Travel::REFFERING_TYPE_SELECT[$travel->reffering_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.hospitalization_date') }}
                        </th>
                        <td>
                            {{ $travel->hospitalization_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.planning_discharge_date') }}
                        </th>
                        <td>
                            {{ $travel->planning_discharge_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.arrival_date') }}
                        </th>
                        <td>
                            {{ $travel->arrival_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.departure_date') }}
                        </th>
                        <td>
                            {{ $travel->departure_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.wants_shopping') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $travel->wants_shopping ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.visa_status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $travel->visa_status ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.visa_start_date') }}
                        </th>
                        <td>
                            {{ $travel->visa_start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.visa_end_date') }}
                        </th>
                        <td>
                            {{ $travel->visa_end_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travels.index') }}">
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
            <a class="nav-link active" href="#travel_travel_treatment_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.travelTreatmentActivity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#travel_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane show active" role="tabpanel" id="travel_travel_treatment_activities">
            @includeIf('admin.travels.relationships.travelTravelTreatmentActivities', ['travelTreatmentActivities' => $travel->travelTravelTreatmentActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="travel_activities">
            @includeIf('admin.travels.relationships.travelActivities', ['activities' => $travel->travelActivities])
        </div>
    </div>
</div>

@endsection