<div class="modal fade" id="modal-profile-photo" tabindex="-1" role="dialog" aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.travels.update', [$travel->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-header text-left mx-3 mt-2">{{ trans('cruds.travel.fields.update_profile_photo') }}</div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="photo">{{ trans('cruds.patient.fields.photo') }}</label>
                        <div class="mt-2 needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}  d-flex flex-column align-items-center justify-content-center" id="photo-dropzone">
                           <div class="dz-message" data-dz-message> <img src="{{ asset('img/upload.png') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid"> </div>
                            <div class="dz-message" data-dz-message>
                                <p>{{ trans('cruds.travel.fields.upload_files') }}</p>
                            </div>
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.patient.fields.photo_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.cancel') }}
                        </button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>