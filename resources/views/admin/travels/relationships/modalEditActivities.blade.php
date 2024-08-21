<div class="modal fade" id="modal-edit-activities" tabindex="-1" role="dialog" aria-labelledby="modalEditActivitiesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.activities.update', [0]) }}" enctype="multipart/form-data" id="activities">
                @method('PUT')
                @csrf
                <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                <div class="card-header text-left mx-3 mt-2">{{ trans('cruds.travel.fields.add_reports') }}</div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="status_id">{{ trans('cruds.activity.fields.status') }}</label>
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
                        <span class="help-block">{{ trans('cruds.activity.fields.status_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.activity.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.activity.fields.description_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="document_file">Dosya Yükle (max:10mb pdf-excel-word-zip-img-rar)</label>
                        <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}" id="document_file-dropzone">
                            <div class="dz-message" data-dz-message><span>{{ trans('cruds.travel.fields.drop_or_select_file') }}</span></div>
                            <div class="dz-message" data-dz-message>
                                <p>Drop files here or click <a>browse</a> through your machine</p>
                            </div>
                        </div>
                        @if ($errors->has('document_file'))
                            <div class="invalid-feedback">
                                {{ $errors->first('document_file') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.activity.fields.document_file_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.cancel') }}
                        </button>
                    </div>
                    <div class="form-group mx-3">
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
        // Activity File
        var uploadedActivityFileMap = {}
        Dropzone.options.documentFileDropzone = {
            url: '{{ route('admin.activities.storeMedia') }}',
            maxFilesize: 100, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
                uploadedActivityFileMap[file.name] = response.name

            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedActivityFileMap[file.name]

                    delete uploadedActivityFileMap[file.name];
                }
                $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($activity) && $activity->document_file)
                    var files =
                        {!! json_encode($activity->document_file) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document_file[]" value="' + file.file_name +
                            '">')
                    }
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }
                return _results
            }
        }

        // GUIDE Modal AJAX Script
        var filesAddedWithEmit = [];

        $('#modal-edit-activities').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var documentId = button.data('activity_id') ?? 0;

            $.ajax({
                url: "{{ route('admin.ajax.activities.show', ['activity' => ':param']) }}".replace(
                    ':param', documentId),
                type: 'GET',
                success: function(data) {

                    $("form#activities").find("[name='description']").val(data.activity
                        .description);

                    $("form#activities").find(".select2").val(data.activity.status_id).trigger('change');

                    var dropzoneElement = $("form#activities").find(".dropzone");

                    $('form#activities').find('input[name="document_file[]"]').remove();

                    filesAddedWithEmit.forEach(function(file) {
                        dropzoneElement[0].dropzone.removeFile(file);
                    });

                    dropzoneElement[0].dropzone.removeAllFiles(true);

                    data.activity.document_file.forEach(file => {
                        const mockFile = {
                            name: file.file_name,
                            size: file.size,
                            dataURL: file.url
                        };

                        dropzoneElement[0].dropzone.emit('addedfile', mockFile);
                        dropzoneElement[0].dropzone.emit('thumbnail', mockFile, file
                            .preview_url);
                        dropzoneElement[0].dropzone.emit('complete', mockFile);
                        $('form#activities').append(
                            '<input type="hidden" name="document_file[]" value="' + file
                            .file_name + '">');

                        filesAddedWithEmit.push(mockFile);
                    });

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#modal-edit-activities').on('click', 'button.submit[type="button"]', function() {
                var form = $("form#activities");
                form.attr('action', form.attr('action').replace('/0', '/' + documentId));

                form.submit();
            });
        });
    </script>
@endsection
