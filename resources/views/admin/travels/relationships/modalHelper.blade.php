<div class="modal fade" id="modal-{{$action}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.'.$action.".$actionMood") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                <div class="card-header text-left mx-3 mt-2">Add Files</div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="status_id">{{ trans('cruds.travelTreatmentActivity.fields.status') }}</label>
                        <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                            @foreach ($last_statuses as $id => $entry)
                                <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }} </option>
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
                        <label class="required" for="treatment_file">Dosya Yükle (max:10mb
                            pdf-excel-word-zip-img)</label>
                        <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }} treatment_file-dropzone" id="treatment_file-dropzone">
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
                    <div class="form-group mx-3">
                        <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        // Dropzone Input File
        @if($dropzoneInputFileName)
            var uploadedTreatmentFileMap = {}
            Dropzone.options.treatmentFileDropzone = {
                url: '{{ route('admin.'.$action.'.storeMedia') }}',
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                params: {
                    size: 2
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="treatment_file[]" value="' + response.name + '">')
                    uploadedTreatmentFileMap[file.name] = response.name

                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedTreatmentFileMap[file.name]

                        delete uploadedTreatmentFileMap[file.name];
                    }
                    $('form').find('input[name="treatment_file[]"][value="' + name + '"]').remove()
                },
                init: function() {
                    @if (isset($travelTreatmentActivity) && $travelTreatmentActivity->treatment_file)
                        var files =
                            {!! json_encode($travelTreatmentActivity->treatment_file) !!}
                        for (var i in files) {
                            var file = files[i]
                            this.options.addedfile.call(this, file)
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="treatment_file[]" value="' + file.file_name + '">')
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
        @endif
    </script>
@endsection
