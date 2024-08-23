@can('crm_document_create')
    {{-- route('admin.crm-documents.create') --}}
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crm-documents-store">
        Add Action
    </button>

    <!-- Modal -->
    <div class="modal fade" id="crm-documents-store" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form method="POST" action="{{ route('admin.crm-documents.store') }}" enctype="multipart/form-data">
                              <h5 class="modal-title card-header" id="modalLabel">{{ trans('global.create') }} {{ trans('cruds.crmDocument.title_singular') }}</h5>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">{{ trans('cruds.crmDocument.fields.description') }}</label>
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.crmDocument.fields.description_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="status_id">{{ trans('cruds.crmDocument.fields.status') }}</label>
                                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                                        @foreach ($statuses as $id => $entry)
                                            <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.crmDocument.fields.status_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="document_file">{{ trans('cruds.crmDocument.fields.document_file') }}</label>
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
                                    <span class="help-block">{{ trans('cruds.crmDocument.fields.document_file_helper') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="customer_id" value="{{ $crmCustomer->id }}">
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
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        @parent
        <script>
            
            var uploadedDocumentFileMap = {}
            Dropzone.options.documentFileDropzone = {
                url: '{{ route('admin.crm-documents.storeMedia') }}',
                maxFilesize: 50, // MB
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                params: {
                    size: 50
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
                    uploadedDocumentFileMap[file.name] = response.name
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentFileMap[file.name]
                    }
                    $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
                },
                init: function() {
                    @if (isset($crmDocument) && $crmDocument->document_file)
                        var files =
                            {!! json_encode($crmDocument->document_file) !!}
                        for (var i in files) {
                            var file = files[i]
                            this.options.addedfile.call(this, file)
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="document_file[]" value="' + file.file_name + '">')
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
        </script>
    @endsection
@endcan
