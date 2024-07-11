<div class="modal fade" id="create-roles" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Roles</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"  type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
            <div class="form-group">
                <label class="required" for="permissions"  style="margin-top:55px;">{{ trans('cruds.role.fields.permissions') }}</label>
                <div >
                    <span class="btn btn-info btn-xs select-all  pt-2 pb-2" style="padding:1px 1%;font-size:14px;background-color: #006c9c !important;margin-bottom:15px">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all pt-2 pb-2" style="padding:1px 1%;font-size:14px; background-color: rgb(99, 99, 99) !important;margin-bottom:15px">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions"  multiple required>
                    @foreach($permissions as $id => $permission)
                        <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }} >{{ $permission }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
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



