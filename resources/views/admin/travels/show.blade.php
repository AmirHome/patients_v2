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
                            {{ trans('cruds.travel.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Travel::STATUS_SELECT[$travel->status] ?? '' }}
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
                            {{ $travel->hospital_mail_notify }}
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
                            {{ $travel->reffering_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travel.fields.reffering_other') }}
                        </th>
                        <td>
                            {{ $travel->reffering_other }}
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



@endsection