@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.travelTreatmentStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travel-treatment-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $travelTreatmentStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelTreatmentStatus.fields.title') }}
                        </th>
                        <td>
                            {{ $travelTreatmentStatus->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travel-treatment-statuses.index') }}">
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
            <a class="nav-link" href="#status_travel_treatment_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.travelTreatmentActivity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#status_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="status_travel_treatment_activities">
            @includeIf('admin.travelTreatmentStatuses.relationships.statusTravelTreatmentActivities', ['travelTreatmentActivities' => $travelTreatmentStatus->statusTravelTreatmentActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="status_activities">
            @includeIf('admin.travelTreatmentStatuses.relationships.statusActivities', ['activities' => $travelTreatmentStatus->statusActivities])
        </div>
    </div>
</div>

@endsection