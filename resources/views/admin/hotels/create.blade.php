<div class="modal fade" id="create-hotels" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:15vh;">
            <form method="POST" action="{{ route("admin.hotels.store") }}" enctype="multipart/form-data">
                @csrf
               <div class="card-header">{{ trans('cruds.hotel.fields.create') }}</div>
                        <div class="row">
                <div class="col-md-12  text-align-center">
                <div class="login-info-div">
                <svg class="info-icon" focusable="false" aria-hidden="true" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"></path></svg>
                <span class="login-info">{{ trans('cruds.Other.entered_location') }}<strong>  https://maps.app.goo.gl/AbR3D7knLcMae8b99  </strong> {{ trans('cruds.Other.price_in_tl') }}</span>
            <strong>  126,12  </strong>
            </div>
                </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.hotel.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                             {{ str_replace('name', trans('global.name'), $errors>first('name')) }}

                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.hotel.fields.name_helper') }}</span>
                </div>
            </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="price">{{ trans('cruds.hotel.fields.price') }}</label>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="1">
                    @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                </div>
                </div>
                 </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="country_id">{{ trans('cruds.hotel.fields.country') }}</label>
                    <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                        @foreach($countries as $id => $entry)
                            <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.hotel.fields.country_helper') }}</span>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="city_id">{{ trans('cruds.hotel.fields.city') }}</label>
                    <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                        @foreach($cities as $id => $entry)
                            <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.hotel.fields.city_helper') }}</span>
                </div>
                </div>
                            </div>

                <div class="row">
                 <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="location">{{ trans('cruds.hotel.fields.location') }}</label>
                    <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}" required>
                    @if($errors->has('location'))
                        <div class="invalid-feedback">
                            {{ $errors->first('location') }}
                        </div>
                    @endif
                </div>
               </div>
                </div>
                                <div class="row">

           <div class="col-md-12">
                <div class="form-group">
                    <label for="photos">{{ trans('cruds.hotel.fields.photos') }}</label>
                    <div class="mt-2 needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}  d-flex flex-column align-items-center justify-content-center" id="photos-dropzone">
                        <div class="dz-message" data-dz-message> <img src="{{ asset('img/upload.png') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid"></div>
                <div class="dz-message" data-dz-message><p>{{ trans('cruds.travel.fields.upload_files') }}</p></div>
                    </div>
                    @if($errors->has('photos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photos') }}
                        </div>
                    @endif
                </div>
             </div>             </div>


                <div class="form-group">
                    <button class="btn btn-danger float-right ml-4" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('scripts')
@parent
    <script>
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
            url: '{{ route('admin.hotels.storeMedia') }}',
            maxFilesize: 20, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 20,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
                uploadedPhotosMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPhotosMap[file.name]
                }
                $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($hotel) && $hotel->photos)
                    var files = {!! json_encode($hotel->photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
