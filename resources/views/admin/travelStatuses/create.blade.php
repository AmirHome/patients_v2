<div class="modal fade" id="create-travel-status" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.travel-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Travel Status</div>
            <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.travelStatus.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Enter Status Name.." type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelStatus.fields.title_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="ordering">{{ trans('cruds.travelStatus.fields.ordering') }}</label>
                <input class="form-control {{ $errors->has('ordering') ? 'is-invalid' : '' }}" type="number" name="ordering" id="ordering" placeholder="Please Enter Ordering..." step="1">
                @if($errors->has('ordering'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ordering') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelStatus.fields.ordering_helper') }}</span>
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



