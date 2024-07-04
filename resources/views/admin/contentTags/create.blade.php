<div class="modal fade" id="create-content-tags" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.content-tags.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create Content Tags</div>
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.contentTag.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Please Enter Name.." type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentTag.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="slug">{{ trans('cruds.contentTag.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" placeholder="Please Enter Slug.." type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contentTag.fields.slug_helper') }}</span>
            </div>
            </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger float-right mb-4" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>
