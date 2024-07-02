@extends('layouts.admin')
@section('content')


<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ trans('global.show') }} {{ trans('cruds.user.title') }}</span>
            <div class="form-group mb-0">
                <a class="btn btn-default" href="{{ route('admin.faq-questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.user.fields.id') }}</div>
                            <span class="show-header-text ml-1">{{ $user->id }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.user.fields.job_type') }}                            </div>
                            <span class="show-header-text ml-1">                            {{ App\Models\User::JOB_TYPE_SELECT[$user->job_type] ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.user.fields.name') }}
                            </div>
                            <span class="show-header-text ml-1">                            {{ $user->name }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4"> 
                            {{ trans('cruds.user.fields.phone') }}

                            </div>
                            <span class="show-header-text ml-1">{{ $user->phone }}   </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.user.fields.email') }}                            </div>
                            <span class="show-header-text ml-1">                            {{ $user->email }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                            {{ trans('cruds.user.fields.email_verified_at') }}
                            </div>
                            <span class="show-header-text ml-1"> {{ $user->email_verified_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">                             {{ trans('cruds.user.fields.office') }}
                            </div>
                            <span class="show-header-text ml-1">                                                    {{ $user->office->name ?? '' }}

                            </span>
                        </div>
                    </div>
              
                </div>
                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                    <div class="col-md-6">
                        <div class="text-left show-desc-header">                            {{ trans('cruds.user.fields.roles') }}
                        </div>
                        <span class="show-header-desc-text"> @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach</span>
                    </div>
                    <div class="col-md-5 ml-4">
                        <div class="text-left show-desc-header">                            {{ trans('cruds.user.fields.picture') }}
                        </div>
                        <span class="show-header-desc-text"> @if($user->picture)
                                <a href="{{ $user->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->picture->getUrl('thumb') }}">
                                </a>
                            @endif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- 
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
            <a class="nav-link" href="#user_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
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
        <div class="tab-pane" role="tabpanel" id="user_tasks">
            @includeIf('admin.users.relationships.userTasks', ['tasks' => $user->userTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div> -->

