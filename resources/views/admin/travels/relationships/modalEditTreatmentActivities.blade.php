<div class="modal fade" id="modal-edit-travel-treatment-activities" tabindex="-1" role="dialog" aria-labelledby="modalEditTreatmentActivitiesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.travel-treatment-activities.update', [0]) }}" enctype="multipart/form-data" id="travel-treatment-activities">
                @method('PUT')
                @csrf
                <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                <div class="card-header text-left mx-3 mt-2">Add Files</div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="status_id">{{ trans('cruds.travelTreatmentActivity.fields.status') }}</label>
                        <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                            @foreach ($last_statuses as $id => $entry)
                                <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.status_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.travelTreatmentActivity.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.description_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="treatment_file">Dosya Yükle (max:10mb pdf-excel-word-zip-img-rar)</label>
                        <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }}" id="treatment_file-dropzone">
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
                        <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.cancel') }}
                        </button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger submit" type="button">{{ trans('global.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        // init Dropzone on modal add Treatment Activities

        // GUIDE Modal AJAX Script
        var filesAddedWithEmit = [];

        $('#modal-edit-travel-treatment-activities').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var documentId = button.data('travel-treatment-activities_id') ?? 0;

            $.ajax({
                url: "{{ route('admin.ajax.travel-treatment-activities.show', ['travel_treatment_activity' => ':param']) }}".replace(
                    ':param', documentId),
                type: 'GET',
                success: function(data) {

                    $("form#travel-treatment-activities").find("[name='description']").val(data.travelTreatmentActivity
                        .description);

                    $("form#travel-treatment-activities").find(".select2").val(data.travelTreatmentActivity.status_id).trigger('change');

                    var dropzoneElement = $("form#travel-treatment-activities").find(".dropzone");

                    $('form#travel-treatment-activities').find('input[name="treatment_file[]"]').remove();

                    filesAddedWithEmit.forEach(function(file) {
                        dropzoneElement[0].dropzone.removeFile(file);
                    });

                    dropzoneElement[0].dropzone.removeAllFiles(true);

                    data.travelTreatmentActivity.treatment_file.forEach(file => {
                        const mockFile = {
                            name: file.file_name,
                            size: file.size,
                            dataURL: file.url
                        };

                        dropzoneElement[0].dropzone.emit('addedfile', mockFile);
                        dropzoneElement[0].dropzone.emit('thumbnail', mockFile, file
                            .preview_url);
                        dropzoneElement[0].dropzone.emit('complete', mockFile);
                        $('form#travel-treatment-activities').append(
                            '<input type="hidden" name="treatment_file[]" value="' + file
                            .file_name + '">');

                        filesAddedWithEmit.push(mockFile);
                    });

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#modal-edit-travel-treatment-activities').on('click', 'button.submit[type="button"]', function() {
                var form = $("form#travel-treatment-activities");
                form.attr('action', form.attr('action').replace('/0', '/' + documentId));

                form.submit();
            });
        });
    </script>
@endsection
