@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="office_id">{{ trans('cruds.user.fields.office') }}</label>
                <select class="form-control select2 {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id" required>
                    @foreach($offices as $id => $entry)
                        <option value="{{ $id }}" {{ old('office_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('office'))
                    <div class="invalid-feedback">
                        {{ $errors->first('office') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.office_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.job_type') }}</label>
                <select class="form-control {{ $errors->has('job_type') ? 'is-invalid' : '' }}" name="job_type" id="job_type">
                    <option value disabled {{ old('job_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::JOB_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('job_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.job_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.can_see_prices') }}</label>
                @foreach(App\Models\User::CAN_SEE_PRICES_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('can_see_prices') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="can_see_prices_{{ $key }}" name="can_see_prices" value="{{ $key }}" {{ old('can_see_prices', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="can_see_prices_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('can_see_prices'))
                    <div class="invalid-feedback">
                        {{ $errors->first('can_see_prices') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.can_see_prices_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.can_set_prices') }}</label>
                @foreach(App\Models\User::CAN_SET_PRICES_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('can_set_prices') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="can_set_prices_{{ $key }}" name="can_set_prices" value="{{ $key }}" {{ old('can_set_prices', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="can_set_prices_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('can_set_prices'))
                    <div class="invalid-feedback">
                        {{ $errors->first('can_set_prices') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.can_set_prices_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.is_super') }}</label>
                @foreach(App\Models\User::IS_SUPER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_super') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_super_{{ $key }}" name="is_super" value="{{ $key }}" {{ old('is_super', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_super_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_super'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_super') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.is_super_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="picture">{{ trans('cruds.user.fields.picture') }}</label>
                <div class="needsclick dropzone {{ $errors->has('picture') ? 'is-invalid' : '' }}" id="picture-dropzone">
                </div>
                @if($errors->has('picture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('picture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.picture_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
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
    success: function (file, response) {
      $('form').find('input[name="picture"]').remove()
      $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->picture)
      var file = {!! json_encode($user->picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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

</script>
@endsection