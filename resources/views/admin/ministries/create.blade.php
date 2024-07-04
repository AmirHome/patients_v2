<div class="modal fade" id="create-ministries" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.ministries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Ministries </div>
            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.ministry.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  placeholder="Please Enter Name.." type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.name_helper') }}</span>
            </div>
            </div>

            <div class="col-md-6"> 

            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.ministry.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"  placeholder="Please Enter Code.." type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.code_helper') }}</span>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="code_inc">{{ trans('cruds.ministry.fields.code_inc') }}</label>
                <input class="form-control {{ $errors->has('code_inc') ? 'is-invalid' : '' }}" placeholder="Enter Code Inc.." type="number" name="code_inc" id="code_inc" value="{{ old('code_inc', '0') }}" step="1" required>
                @if($errors->has('code_inc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code_inc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ministry.fields.code_inc_helper') }}</span>
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



