@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.office') }}
                        </th>
                        <td>
                            {{ $user->office->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.job_type') }}
                        </th>
                        <td>
                            {{ App\Models\User::JOB_TYPE_SELECT[$user->job_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.can_see_prices') }}
                        </th>
                        <td>
                            {{ App\Models\User::CAN_SEE_PRICES_RADIO[$user->can_see_prices] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.can_set_prices') }}
                        </th>
                        <td>
                            {{ App\Models\User::CAN_SET_PRICES_RADIO[$user->can_set_prices] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.is_super') }}
                        </th>
                        <td>
                            {{ App\Models\User::IS_SUPER_RADIO[$user->is_super] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.picture') }}
                        </th>
                        <td>
                            @if($user->picture)
                                <a href="{{ $user->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_patients" role="tab" data-toggle="tab">
                {{ trans('cruds.patient.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_travel_treatment_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.travelTreatmentActivity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_crm_customers" role="tab" data-toggle="tab">
                {{ trans('cruds.crmCustomer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_crm_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.crmDocument.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_patients">
            @includeIf('admin.users.relationships.userPatients', ['patients' => $user->userPatients])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_travel_treatment_activities">
            @includeIf('admin.users.relationships.userTravelTreatmentActivities', ['travelTreatmentActivities' => $user->userTravelTreatmentActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_activities">
            @includeIf('admin.users.relationships.userActivities', ['activities' => $user->userActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_crm_customers">
            @includeIf('admin.users.relationships.userCrmCustomers', ['crmCustomers' => $user->userCrmCustomers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_crm_documents">
            @includeIf('admin.users.relationships.userCrmDocuments', ['crmDocuments' => $user->userCrmDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection