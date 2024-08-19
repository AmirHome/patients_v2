@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="office_id">{{ trans('cruds.user.fields.office') }}</label>
                            <select class="form-control select2 {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id" required>
                                @foreach ($offices as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('office_id') ? old('office_id') : $user->office->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('office'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('office') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.office_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ trans('cruds.user.fields.job_type') }}</label>
                            <select class="form-control {{ $errors->has('job_type') ? 'is-invalid' : '' }}" name="job_type" id="job_type">
                                <option value disabled {{ old('job_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\User::JOB_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_type', $user->job_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('job_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.job_type_helper') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="roles" style="margin-top:35px;top:-35px">{{ trans('cruds.user.fields.roles') }}</label>

                            <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                                @foreach ($roles as $id => $role)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) || $user->roles->contains($id) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="picture" style="top:-5px">{{ trans('cruds.user.fields.picture') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('picture') ? 'is-invalid' : '' }}" id="picture-dropzone">
                                <div class="dz-message" data-dz-message><span>Drop or Select file</span> </div>
                                <div class="dz-message" data-dz-message>
                                    <p>Drop files here or click <a>browse</a> thorough your machien</p>
                                </div>
                            </div>
                            @if ($errors->has('picture'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('picture') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.picture_helper') }}</span>
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
        Dropzone.options.pictureDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="picture"]').remove()
                $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="picture"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($user) && $user->picture)
                    var file = {!! json_encode($user->picture) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
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
