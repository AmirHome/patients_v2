{{-- @includeIf('admin.crmCustomers.relationships.formFilter') --}}

<div class="card">

    <div class="card-body">
        <form action="{{ route('admin.tasks.index') }}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Content</label>
                        <input type="text" class="form-control filter" placeholder="Enter content" name="content">
                        <span class="text-danger">@error('content'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control filter" wire:model.live="status" name="status_id">
                            @foreach ($statuses as $id => $status)
                            <option value="{{ $id }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('Status'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Assignee</label>
                        <select class="form-control filter" wire:model.live="assignee" name="assignee">
                            <option value="1">Assigned to me</option>
                            <option value="0">Owner</option>
                        </select>
                        <span class="text-danger">@error('Assignee'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-8">
                        @can('task_create')
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.task.title_singular') }}
                                </a>
                            </div>
                        </div>
                    @endcan
                    </div>
                    <div class="col-4">
                        <button class="float-right btn btn-primary" type="button" id="form-filter-submit">
                            Search <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>