@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.travelHospital.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travel-hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.travelHospital.fields.id') }}
                        </th>
                        <td>
                            {{ $travelHospital->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelHospital.fields.title') }}
                        </th>
                        <td>
                            {{ $travelHospital->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelHospital.fields.email') }}
                        </th>
                        <td>
                            {{ $travelHospital->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#notify_hospitals_travels" role="tab" data-toggle="tab">
                {{ trans('cruds.travel.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="notify_hospitals_travels">
            @includeIf('admin.travelHospitals.relationships.notifyHospitalsTravels', ['travels' => $travelHospital->notifyHospitalsTravels])
        </div>
    </div>
</div>

@endsection