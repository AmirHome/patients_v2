@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ trans('global.show') }} {{ trans('cruds.task.title') }}</span>
            <div class="form-group mb-0">
                <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                           <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.name') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ $task->name }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.emergency') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ App\Models\Task::EMERGENCY_RADIO[$task->emergency] ?? '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.due_date') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ $task->due_date }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
     
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.status') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ $task->status->name ?? '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.created_at') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ $task->created_at }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.user') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ $task->user->name ?? '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-left">
                            <div class="show-header ml-4">
                                {{ trans('cruds.task.fields.assigned_to') }}
                            </div>
                            <span class="show-header-text ml-1">
                                {{ $task->assigned_to->name ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-5">
                    <div class="dotted-border"></div>
                </div>
                <div class="row ml-4">
                    <div class="col-md-6">
                        <div class="text-left show-desc-header">
                            {{ trans('cruds.task.fields.description') }}
                        </div>
                        <span class="show-header-desc-text">
                            {{ $task->description }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left show-desc-header">
                            {{ trans('cruds.task.fields.attachment') }}
                        </div>
                        <span class="show-header-desc-text">
                            @if($task->attachment)
                                {{ trans('global.view_file') }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
