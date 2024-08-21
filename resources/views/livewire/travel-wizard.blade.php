<div>
<!-- {{ trans('cruds.travel.fields.back_to_homepage') }} -->
    <form wire:submit.prevent="store">
        <div class="container-fluid p-0 m-0">

            <div class="row">
                <div class="col-md-12">

                    {{-- STEP 1 --}}
                    <div class="step-one {{ $currentStep == 1 ? 'd-block' : 'd-none' }}">
                        <div class="card">
                            <div class="card-header">{{ trans('cruds.travel.fields.patient_information') }}</div>
                            <div class="card-body">
                                <div class="row justify-content-center pb-5 pt-2 flex-nowrap">
                                    <div class="d-flex justify-content-center">
                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9312;</span>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                                        <span class="w-100 rounded" style="height: 0.1rem;background-color: #D7DDE0;">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #D7DDE0 !important;'>&#9313;</span>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                                        <span class="w-100 rounded" style="height: 0.1rem;background-color: #D7DDE0;">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center">

                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #D7DDE0 !important;'>&#9314;</span>

                                    </div>
                                </div>
                                <div class="row px-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.patient_code') }}</label>
                                            <input type="text" class="form-control" id="code" value="{{ $code }}"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.patient_admission_date') }}</label>
                                            <input type="text" class="form-control" id="date" readonly placeholder="{{ getCurrentDate() }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-5">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.name') }}</label>
                                            <input type="text" class="form-control"  wire:model="name">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.middle_name') }}</label>
                                            <input type="text" class="form-control" wire:model="middle_name">
                                            <span class="text-danger">
                                                @error('middle_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.patient.fields.surname') }}</label>
                                            <input type="text" class="form-control"  wire:model="surname">
                                            <span class="text-danger">
                                                @error('surname')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.patient.fields.gender') }}</label>
                                            <select class="form-control" wire:model.live="gender">
                                                <option value="" selected>{{ trans('cruds.travel.fields.choose_gender') }}</option>
                                                @foreach ($genders as $key => $title)
                                                    <option value="{{ $key }}">{{ $title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('gender')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="birthday">{{ trans('cruds.patient.fields.birthday') }}</label>
                                            <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}"  type="text" name="birthday" id="birthday"
                                                value="{{ old('birthday', $patient->birthday ?? null) }}">
                                            @if ($errors->has('birthday'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('birthday') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.patient.fields.birthday_helper') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.patient.fields.birth_place') }}</label>
                                            <input type="text" class="form-control"  wire:model="birth_place">
                                            <span class="text-danger">
                                                @error('birth_place')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Physicall --}}
                                <div class="row px-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.patient.fields.blood_group') }}</label>
                                            <select class="form-control" wire:model.live="blood_group">
                                                <option value="" selected>{{ trans('cruds.travel.fields.choose_blood_group') }}</option>
                                                @foreach ($bloodGroups as $key => $title)
                                                    <option value="{{ $key }}">{{ $title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('blood_group')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.weight') }}</label>
                                            <input type="text" class="form-control"  wire:model="weight">
                                            <span class="text-danger">
                                                @error('weight')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.height') }}</label>
                                            <input type="text" class="form-control"  wire:model="height">
                                            <span class="text-danger">
                                                @error('height')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                {{-- Reffer, Campaign --}}
                                <div class="row px-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.passport_number') }}</label>
                                            <input type="text" class="form-control"  wire:model="passport_no">
                                            <span class="text-danger">
                                                @error('passport_no')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.email_address') }}</label>
                                            <input type="email" class="form-control"  wire:model="email">
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.phone_number') }}</label>
                                            <input type="text" class="form-control"  wire:model="phone">
                                            <span class="text-danger">
                                                @error('phone')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.countery') }}</label>
                                            <select class="form-control" wire:model.live="countryId">
                                                <option value=null>{{ trans('cruds.travel.fields.select_a_country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('country_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.city') }}</label>
                                            <select class="form-control" wire:model.live="city_id">
                                                <option>{{ trans('cruds.travel.fields.select_a_city') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('city_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.channel') }}</label>
                                            <select class="form-control" wire:model.live="compaignChannelId">
                                                <option value="" selected>{{ trans('cruds.travel.fields.choose_channels') }}</option>
                                                @foreach ($campaignChannels as $channel)
                                                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('compaignChannelId')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.organization') }}</label>
                                            <select class="form-control" wire:model.live="campaign_org_id">
                                                <option value="" selected>{{ trans('cruds.travel.fields.choose_organization') }}</option>
                                                @foreach ($campaignOrganizations as $org)
                                                    <option value="{{ $org->id }}">{{ $org->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('campaign_org_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.your_reference_type') }}</label>
                                            <select class="form-control" wire:model.live="reffering_type">
                                                <option value="" selected>{{ trans('cruds.travel.fields.choose_reference_type') }}</option>
                                                @foreach ($refferingTypes as $key => $title)
                                                    <option value="{{ $key }}">{{ $title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('reffering_type')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.your_reference') }}</label>
                                            @if ($reffering_type != 'Phone')
                                                @if ($reffering_type == 'Other')
                                                    <input type="text" class="form-control" wire:model.live="reffering">
                                                @else
                                                    <select class="form-control" wire:model.live="reffering">
                                                        <option value="" selected>{{ trans('cruds.travel.fields.choose_reffering') }}</option>
                                                        @foreach ($refferingIds as $key => $refferings)
                                                            <option value="{{ $key }}">{{ $refferings }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            @endif

                                            <span class="text-danger">
                                                @error('reffering')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- STEP 2 --}}
                    <div class="step-two {{ $currentStep == 2 ? 'd-block' : 'd-none' }}">
                        <div class="card">
                            <div class="card-header">{{ trans('cruds.travel.fields.case_information_and_report_upload') }}</div>
                            <div class="card-body">
                                <div class="row justify-content-center pb-5 pt-2 flex-nowrap">
                                    <div class="d-flex justify-content-center">
                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9312;</span>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                                        <span class="w-100 rounded" style="height: 0.1rem;background-color: #D7DDE0;">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9313;</span>

                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                                        <span class="w-100 rounded" style="height: 0.1rem;background-color: #D7DDE0;">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center">

                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #D7DDE0 !important;'>&#9314;</span>

                                    </div>
                                </div>
                                <div class="row px-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Durum</label>
                                            <select class="form-control" wire:model.live="status_id">
                                                <option value="" selected>{{ trans('cruds.travel.fields.choose_status') }}</option>
                                                @foreach ($statuses as $key => $status)
                                                    <option value="{{ $key }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('status_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <!-- GUIDE Select2 init -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.department') }}</label>
                                            <div wire:ignore>
                                                <select class="form-control select2" id="department_id">
                                                    <option value="" selected>{{ trans('cruds.travel.fields.select_department') }}</option>
                                                    @foreach ($departments as $id => $entry)
                                                        <option value="{{ $id }}">{{ $entry }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('department_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ trans('cruds.travel.fields.explanation') }}</label>
                                            <textarea class="form-control pt-3" cols="2" rows="2"  wire:model="description" style="min-height:145px !important"></textarea>
                                            <span class="text-danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- @json($treatment_files) boş [] geliyordu kapattım -->
                                        <div class="form-group" wire:ignore>
                                            <label class="required" for="treatment_file">{{ trans('cruds.travel.fields.upload_files') }} (max:10mb pdf-excel-word-zip-img-rar)</label>
                                            <div class="mt-2 needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }} d-flex flex-column align-items-center justify-content-center" id="photo-dropzone">
                                                <img src="{{ asset('img/upload.png') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid">
                                                <div class="dz-message" data-dz-message><p>{{ trans('cruds.travel.fields.upload_files') }}</p></div>
                                            </div>


                                            @if ($errors->has('treatment_file'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('treatment_file') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 3 --}}
                    <div class="step-three {{ $currentStep == 3 ? 'd-block' : 'd-none' }}">
                        <div class="card">
                            <div class="card-header">{{ trans('cruds.travel.fields.information') }}</div>
                            <div class="card-body">
                                <div class="row justify-content-center pb-5 pt-2 flex-nowrap">
                                    <div class="d-flex justify-content-center">
                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9312;</span>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                                        <span class="w-100 rounded" style="height: 0.1rem;background-color: #D7DDE0;">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9313;</span>

                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                                        <span class="w-100 rounded" style="height: 0.1rem;background-color: #D7DDE0;">
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center">

                                        <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9314;</span>

                                    </div>
                                </div>
                                <div class="row px-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notify_hospitals"   >{{ trans('cruds.travel.fields.notify_hospitals') }} </label>
                                            <div wire:ignore>
                                                <select class="form-control select2 {{ $errors->has('notify_hospitals') ? 'is-invalid' : '' }}" name="notify_hospitals[]" id="notifyHospitalIds" multiple>
                                                    @foreach ($notify_hospitals as $id => $notify_hospital)
                                                        <option value="{{ $id }}" {{ in_array($id, old('notify_hospitals', [])) ? 'selected' : '' }}>{{ $notify_hospital }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('notifyHospitalIds')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label for="traslators">{{ trans('cruds.travel.fields.translators') }}</label>
                                            <select class="form-control" wire:model.live="translatorId">
                                                <option value="" selected>{{ trans('cruds.travel.fields.select_translator') }}</option>
                                                @foreach ($translators as $id => $translator)
                                                    <option value="{{ $id }}">{{ $translator }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('translatorId')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{-- Buttons panel --}}
                    <div class="action-buttons d-flex justify-content-between bg-white pt-3 pb-3">
                        @if ($currentStep == 1)
                            <div></div>
                        @endif

                        @if ($currentStep == 2 || $currentStep == 3)
                            <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">{{ trans('cruds.travel.fields.back') }}</button>
                        @endif

                        @if ($currentStep == 1 || $currentStep == 2)
                            <button type="button" class="btn btn-md btn-light" wire:click="increaseStep()">{{ trans('cruds.travel.fields.next') }}</button>
                        @endif

                        @if ($currentStep == 3)
                            <button type="submit" class="btn btn-md btn-primary" wire:click="increaseStep()">{{ trans('cruds.travel.fields.final') }}</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </form>


</div>


@section('scripts')
    @parent
    <script>
        // GUIDE Select2 set livewire
        $('.select2').change(function(e) {
            // Exm: @this.set('department_id', e.target.value);
            // Exm: @this.set('department_id', e.target.value);
            @this.set($(this).attr('id'), $(this).val());
        });

        // Dropzone init
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
            success: function(file, response) {
                $('form').append('<input type="hidden" name="treatment_file[]" value="' + response.name + '">')
                uploadedTreatmentFileMap[file.name] = response.name
                // GUIDE Dropzone set livewire
                @this.set('treatment_files', uploadedTreatmentFileMap)

            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedTreatmentFileMap[file.name]
                    // GUIDE Dropzone remove livewire
                    delete uploadedTreatmentFileMap[file.name];
                    @this.set('treatment_files', uploadedTreatmentFileMap)
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
    </script>
@endsection
