<div class="modal fade" id="create-campaign-channels" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.campaign-channels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Campaign Channel</div>
            <div class="row">
                <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.campaignChannel.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Please Enter Channel Name.." type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.campaignChannel.fields.title_helper') }}</span>
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



