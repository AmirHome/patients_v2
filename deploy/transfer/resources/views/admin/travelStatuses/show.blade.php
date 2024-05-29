@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.travelStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travel-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.travelStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $travelStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelStatus.fields.title') }}
                        </th>
                        <td>
                            {{ $travelStatus->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.travelStatus.fields.ordering') }}
                        </th>
                        <td>
                            {{ $travelStatus->ordering }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.travel-statuses.index') }}">
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
            <a class="nav-link" href="#status_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#status_travel_treatment_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.travelTreatmentActivity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#last_status_travels" role="tab" data-toggle="tab">
                {{ trans('cruds.travel.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="status_activities">
            @includeIf('admin.travelStatuses.relationships.statusActivities', ['activities' => $travelStatus->statusActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="status_travel_treatment_activities">
            @includeIf('admin.travelStatuses.relationships.statusTravelTreatmentActivities', ['travelTreatmentActivities' => $travelStatus->statusTravelTreatmentActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="last_status_travels">
            @includeIf('admin.travelStatuses.relationships.lastStatusTravels', ['travels' => $travelStatus->lastStatusTravels])
        </div>
    </div>
</div>

@endsection