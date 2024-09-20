<div class="modal fade" id="create-task-status" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.task-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">{{ trans('cruds.Other.create_status') }}</div>

            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taskStatus.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter Name.." type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                         {{ str_replace('name', trans('global.name'), $errors>first('name')) }}

                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.taskStatus.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="color">{{ trans('cruds.taskStatus.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}"  placeholder="Enter Color.." type="text" name="color" id="color" value="{{ old('color', '') }}">
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.taskStatus.fields.color_helper') }}</span>
            </div>
            </div>
            </div>

            <div class="row justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.cancel') }}
                        </button>
                    </div>
                    <div class="form-group ">
                        <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>



