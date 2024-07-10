<div class="modal fade" id="create-faq-categories" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:25vh;">
        <form method="POST" action="{{ route("admin.faq-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">Create FAQ Categories</div>
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="category">{{ trans('cruds.faqCategory.fields.category') }}</label>
                <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text"  name="category" id="category" value="{{ old('category', '') }}" required>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqCategory.fields.category_helper') }}</span>
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



