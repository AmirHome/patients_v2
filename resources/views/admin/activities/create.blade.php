@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.activity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.activities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.activity.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="travel_id">{{ trans('cruds.activity.fields.travel') }}</label>
                <select class="form-control select2 {{ $errors->has('travel') ? 'is-invalid' : '' }}" name="travel_id" id="travel_id" required>
                    @foreach($travel as $id => $entry)
                        <option value="{{ $id }}" {{ old('travel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('travel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('travel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.travel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.activity.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.activity.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="document_file">{{ trans('cruds.activity.fields.document_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}" id="document_file-dropzone">
                </div>
                @if($errors->has('document_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.document_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="document_name">{{ trans('cruds.activity.fields.document_name') }}</label>
                <input class="form-control {{ $errors->has('document_name') ? 'is-invalid' : '' }}" type="text" name="document_name" id="document_name" value="{{ old('document_name', '') }}">
                @if($errors->has('document_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.document_name_helper') }}</span>
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
    var uploadedDocumentFileMap = {}
Dropzone.options.documentFileDropzone = {
    url: '{{ route('admin.activities.storeMedia') }}',
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
      console.log('success')
      console.log(file.name)
        console.log(response.name)
      console.log(uploadedDocumentFileMap)
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
@if(isset($activity) && $activity->document_file)
          var files =
            {!! json_encode($activity->document_file) !!}
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
</script>
@endsection