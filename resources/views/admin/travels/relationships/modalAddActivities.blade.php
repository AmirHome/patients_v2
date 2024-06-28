<div class="modal fade" id="modalAddActivities" tabindex="-1" role="dialog"
aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form method="POST" action="{{ route('admin.activities.store') }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="travel_id" value="{{ $travel->id }}">
            <div class="card-header text-left mx-3 mt-2">Add Files</div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required"
                        for="status_id">{{ trans('cruds.travelTreatmentActivity.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                        name="status_id" id="status_id" required>
                        @foreach ($last_statuses as $id => $entry)
                            <option value="{{ $id }}"
                                {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.status_helper') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label
                        for="description">{{ trans('cruds.travelTreatmentActivity.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                        id="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.description_helper') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group" wire:ignore>
                    <label class="required" for="treatment_file">Dosya Yükle (max:10mb
                        pdf-excel-word-zip-img)</label>
                    <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }} treatment_file-dropzone"
                        id="treatment_file-dropzone">
                        <div class="dz-message" data-dz-message><span>Drop or Select file</span></div>
                        <div class="dz-message" data-dz-message>
                            <p>Drop files here or click <a>browse</a> through your machine</p>
                        </div>
                    </div>
                    @if ($errors->has('treatment_file'))
                        <div class="invalid-feedback">
                            {{ $errors->first('treatment_file') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file_helper') }}</span>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary"
                        id="cancelButton4">{{ trans('global.cancel') }}</button>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger mx-3"
                        type="submit">{{ trans('global.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>