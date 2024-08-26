@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.task.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tasks.update', [$task->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.task.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                            <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}">
                            @if ($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.task.fields.status') }}</label>
                            <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                                @foreach ($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $task->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.status_helper') }}</span>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="description" style="top:-3px">{{ trans('cruds.task.fields.description') }}</label>
                            <span>
                                <textarea class="form-control ckeditor task-rich-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $task->description) }}</textarea>
                            </span>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                            <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                                @foreach ($assigned_tos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('assigned_to_id') ? old('assigned_to_id') : $task->assigned_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('assigned_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
                        </div>
                        <div class="form-group ">
                            <label class="required radio-btn-header mb-1" style="margin-top: 60px">{{ trans('cruds.task.fields.emergency') }}</label>
                            <div class="d-flex flex-wrap">
                                @foreach (App\Models\Task::EMERGENCY_RADIO as $key => $label)
                                    <div class="form-check {{ $errors->has('emergency') ? 'is-invalid' : '' }}" style="padding-left:43px;margin-right:50px">
                                        <input class="form-check-input radio-btn"type="radio" id="emergency_{{ $key }}" name="emergency" value="{{ $key }}" {{ old('emergency', $task->emergency) === (string) $key ? 'checked' : '' }}
                                            required>
                                        <label class="form-check-label mt-3 radio-btn-text" for="emergency_{{ $key }}" style="margin-left:9px !important">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @if ($errors->has('emergency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('emergency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.emergency_helper') }}</span>
                        </div>

                        <div class="form-group mt-4">
                            <label for="attachment"></label>
                            <div class="d-flex flex-column align-items-center justify-content-center mt-2 needsclick dropzone attachment-dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                                <div class="dz-message" data-dz-message> <img src="{{ asset('img/upload.png') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid mt-4"></div>
                                <div class="dz-message" data-dz-message>
                                    <p>{{ trans('cruds.travel.fields.upload_files') }}</p>
                                </div>
                            </div>
                            @if ($errors->has('attachment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('attachment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.attachment_helper') }}</span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <button class="btn btn-danger float-right" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '{{ route('admin.tasks.storeCKEditorImages') }}', true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                            }

                                            $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $task->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });

        Dropzone.options.attachmentDropzone = {
            url: '{{ route('admin.tasks.storeMedia') }}',
            maxFilesize: 20, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="attachment"]').remove()
                $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="attachment"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($task) && $task->attachment)
                    var file = {!! json_encode($task->attachment) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
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
