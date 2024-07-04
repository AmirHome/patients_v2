<div class="modal fade" id="create-departments" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.departments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Department</div>

            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                
                <label class="required" for="name">{{ trans('cruds.department.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Please Enter Department Name.." type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
            </div>
            </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger float-right mb-5" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>



