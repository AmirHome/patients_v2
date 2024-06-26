@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.travelTreatmentActivity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.travel-treatment-activities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.travelTreatmentActivity.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="travel_id">{{ trans('cruds.travelTreatmentActivity.fields.travel') }}</label>
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
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.travel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.travelTreatmentActivity.fields.status') }}</label>
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
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.travelTreatmentActivity.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="treatment_file">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }}" id="treatment_file-dropzone">
                </div>
                @if($errors->has('treatment_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('treatment_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file_helper') }}</span>
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
    var uploadedTreatmentFileMap = {}
Dropzone.options.treatmentFileDropzone = {
    url: '{{ route('admin.travel-treatment-activities.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="treatment_file[]" value="' + response.name + '">')
      uploadedTreatmentFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTreatmentFileMap[file.name]
      }
      $('form').find('input[name="treatment_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($travelTreatmentActivity) && $travelTreatmentActivity->treatment_file)
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