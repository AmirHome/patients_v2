<div class="modal fade" id="create-user-alerts" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:15vh;">
        <form method="POST" action="{{ route("admin.user-alerts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">{{ trans('cruds.Other.create_user_alerts') }}</div>

            <div class="row">
                <div class="col-md-6">
                    
            <div class="form-group">
                <label class="required" for="alert_text">{{ trans('cruds.userAlert.fields.alert_text') }}</label>
                <input class="form-control {{ $errors->has('alert_text') ? 'is-invalid' : '' }}" type="text" name="alert_text" id="alert_text" value="{{ old('alert_text', '') }}" required>
                @if($errors->has('alert_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alert_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.alert_text_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">  
            <div class="form-group">
                <label for="alert_link">{{ trans('cruds.userAlert.fields.alert_link') }}</label>
                <input class="form-control {{ $errors->has('alert_link') ? 'is-invalid' : '' }}" type="text"  name="alert_link" id="alert_link" value="{{ old('alert_link', '') }}">
                @if($errors->has('alert_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alert_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.alert_link_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
            <div class="form-group">
                <label for="users" style="margin-top:55px;">{{ trans('cruds.userAlert.fields.user') }}</label>
                <div >
                    <span class="btn btn-info btn-xs select-all  pt-2 pb-2" style="padding:1px 1%;font-size:14px;background-color: #006c9c !important;margin-bottom:15px">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all pt-2 pb-2" style="padding:1px 1%;font-size:14px; background-color: rgb(99, 99, 99) !important;margin-bottom:15px">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.user_helper') }}</span>
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



