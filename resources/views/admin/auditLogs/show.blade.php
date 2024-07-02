@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ trans('global.show') }} {{ trans('cruds.auditLog.title') }}</span>
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
                            <div class="show-header ml-4">{{ trans('cruds.auditLog.fields.id') }}</div>
                            <span class="show-header-text ml-1">{{ $auditLog->id }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.auditLog.fields.subject_id') }}</div>
                            <span class="show-header-text ml-1">{{ $auditLog->subject_id }}</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.auditLog.fields.user_id') }}</div>
                            <span class="show-header-text ml-1">{{ $auditLog->user_id }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.auditLog.fields.subject_type') }}</div>
                            <span class="show-header-text ml-1">{{ $auditLog->subject_type }}</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.auditLog.fields.host') }}</div>
                            <span class="show-header-text ml-1">{{ $auditLog->host }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <div class="show-header ml-4">{{ trans('cruds.auditLog.fields.created_at') }}</div>
                            <span class="show-header-text ml-1">{{ $auditLog->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                    <div class="col-md-6">
                        <div class="text-left show-desc-header">{{ trans('cruds.auditLog.fields.description') }}</div>
                        <span class="show-header-desc-text">{{ $auditLog->description }}</span>
                    </div>
                    <div class="col-md-5 ml-4">
                        <div class="text-left show-desc-header">{{ trans('cruds.auditLog.fields.properties') }}</div>
                        <span class="show-header-desc-text">{{ $auditLog->properties }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
