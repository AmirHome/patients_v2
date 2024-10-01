{{-- @includeIf('admin.crmCustomers.relationships.formFilter') --}}

<div class="card">

    <div class="card-body">
        <form action="{{ route('admin.tasks.index') }}" method="get">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{trans('global.assignee')}}</label>
                        <select class="form-control filter" wire:model.live="assignee" name="assignee">
                            <option value="1" selected>{{trans('global.assigneeToMe')}}</option>
                            <option value="0">{{trans('global.owner')}}</option>
                        </select>
                        <span class="text-danger">@error('Assignee'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{trans('global.content')}}</label>
                        <input type="text" class="form-control filter" name="content">
                        <span class="text-danger">@error('content'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{trans('global.status')}}</label>
                        <select class="form-control filter select2" multiple name="status_id">
                            @foreach ($statuses as $id => $status)
                            <option value="{{ $id }}" {{($id != 30 ? 'selected' : '')}}>{{ $status }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('Status'){{ $message }}@enderror</span>
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
                            {{trans('global.searchBtn')}} <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formInputs = document.querySelectorAll('.filter');
        const searchButton = document.getElementById('form-filter-submit');

        formInputs.forEach(function(input) {
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    searchButton.click();
                }
            });
        });
    });
</script>