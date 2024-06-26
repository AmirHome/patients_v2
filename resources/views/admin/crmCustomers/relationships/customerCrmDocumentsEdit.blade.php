<!-- GUIDE Modal Body -->
<div class="modal fade" id="crm_document_edit_modal" tabindex="-1" role="dialog"
    aria-labelledby="customerDocumentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ route("admin.crm-documents.update", [0]) }}" enctype="multipart/form-data" id="crm_document_edit_form">
            <div class="modal-header">
                <h5 class="modal-title" id="customerDocumentCreateModalLabel">
                    {{ trans('global.edit') }} {{ trans('cruds.crmDocument.title_singular') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="customer_id" value="{{ $crmCustomer->id }}">

                    <div class="form-group">
                        <label for="document_file">{{ trans('cruds.crmDocument.fields.document_file') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}"
                            id="document_file-dropzone">
                        </div>
                        @if($errors->has('document_file'))
                        <div class="invalid-feedback">
                            {{ $errors->first('document_file') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.crmDocument.fields.document_file_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.crmDocument.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            name="description"></textarea>
                        @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.crmDocument.fields.description_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="status_id">{{ trans('cruds.crmDocument.fields.status') }}</label>
                        <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                            name="status_id" required>
                            @foreach($statuses as $id => $entry)
                            <option value="{{ $id }}">{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.crmDocument.fields.status_helper') }}</span>
                    </div>
                   
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger submit" type="button">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>



@section('scripts')
<script>
    // $(document).ready(function() {

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
        success: function (file, response) {
        $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
        uploadedDocumentFileMap[file.name] = response.name
        },
        removedfile: function (file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentFileMap[file.name]
        }
        $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
        },
        init: function () {
        @if(isset($crmDocument) && $crmDocument->document_file)
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
        error: function (file, response) {
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

    var filesAddedWithEmit = [];
    
    $('#crm_document_edit_modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var documentId = button.data('crm_document_id') ?? 0;

        $.ajax({
            url: "{{ route('admin.ajax.crm-documents.show', ['crm_document' => ':param']) }}"
            .replace(':param', documentId),
            type: 'GET',
            success: function(data) {

                $("form#crm_document_edit_form").find("[name='description']").val(data.crmDocument.description);
                $("form#crm_document_edit_form").find(".select2").select2().select2('val', data.crmDocument.status_id.toString());
                
                var dropzoneElement = $("form#crm_document_edit_form").find(".dropzone");
                
                $('form#crm_document_edit_form').find('input[name="document_file[]"]').remove();
                
                filesAddedWithEmit.forEach(function(file) {
                    dropzoneElement[0].dropzone.removeFile(file);
                });

                dropzoneElement[0].dropzone.removeAllFiles(true);

                data.crmDocument.document_file.forEach(file => {
                    const mockFile = { name: file.file_name, size: file.size, dataURL: file.url };

                    dropzoneElement[0].dropzone.emit('addedfile', mockFile);
                    dropzoneElement[0].dropzone.emit('thumbnail', mockFile, file.preview_url);
                    dropzoneElement[0].dropzone.emit('complete', mockFile);
                    $('form#crm_document_edit_form').append('<input type="hidden" name="document_file[]" value="' + file.file_name + '">');

                    filesAddedWithEmit.push(mockFile);
                });

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        $('#crm_document_edit_modal').on('click', 'button.submit[type="button"]', function() {
            var form = $("form#crm_document_edit_form");
            form.attr('action', form.attr('action').replace('/0', '/' + documentId));
            form.submit();
        });
    });
    

// });



</script>
@endsection