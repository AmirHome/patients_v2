<div>

    <h1>STEP {{$currentStep}}</h1>
    <form wire:submit.prevent="store">

        {{-- STEP 1 --}}

        <div class="step-one {{$currentStep == 1 ? 'd-block' : 'd-none'}}">
            <div class="card">
                <div class="card-header bg-secondary text-white">1/4 - Personal Details</div>
                <div class="card-body">
                    <span class="row mx-1 pb-3">Code: {{$code}}</span>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">First name</label>
                                <input type="text" class="form-control" placeholder="Enter first name"
                                    wire:model="name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Middel name</label>
                                <input type="text" class="form-control" placeholder="Enter middel name"
                                    wire:model="middle_name">
                                <span class="text-danger">@error('middle_name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Last name</label>
                                <input type="text" class="form-control" placeholder="Enter last name"
                                    wire:model="surname">
                                <span class="text-danger">@error('surname'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Gender @json($gender)</label>
                                <select class="form-control" wire:model.live="gender">
                                    <option value="" selected>Choose gender</option>
                                    @foreach ($genders as $key => $title)
                                    <option value="{{ $key }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Birthday</label>
                                <input type="date" class="form-control" placeholder="Enter your birthday"
                                    wire:model="birthday">
                                <span class="text-danger">@error('birthday'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Birth place</label>
                                <input type="text" class="form-control" placeholder="Enter your birth place"
                                    wire:model="birth_place">
                                <span class="text-danger">@error('birth_place'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mother Name</label>
                                <input type="text" class="form-control" placeholder="Enter your mother name"
                                    wire:model="mother_name">
                                <span class="text-danger">@error('mother_name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Father Name</label>
                                <input type="text" class="form-control" placeholder="Enter your father name"
                                    wire:model="father_name">
                                <span class="text-danger">@error('father_name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    {{-- Physicall --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Weight</label>
                                <input type="text" class="form-control" placeholder="Enter weight" wire:model="weight">
                                <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Height</label>
                                <input type="text" class="form-control" placeholder="Enter height" wire:model="height">
                                <span class="text-danger">@error('height'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Blood group @json($blood_group)</label>
                                <select class="form-control" wire:model.live="blood_group">
                                    <option value="" selected>Choose blood group</option>
                                    @foreach ($bloodGroups as $key => $title)
                                    <option value="{{ $key }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Treating doctor @json($treating_doctor)</label>
                                <input type="text" class="form-control" wire:model="treating_doctor">
                                </select>
                                <span class="text-danger">@error('treating_doctor'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    {{-- Reffer, Campaign --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Campaign channels</label>
                                <select class="form-control" wire:model.live="compaignChannelId">
                                    <option value="" selected>Choose channels</option>
                                    @foreach ($campaignChannels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('compaignChannelId'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Campaign organization @json($campaign_org_id)</label>
                                <select class="form-control" wire:model.live="campaign_org_id">
                                    <option value="" selected>Choose organization</option>
                                    @foreach ($campaignOrganizations as $org)
                                    <option value="{{ $org->id }}">{{ $org->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('campaign_org_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Reffering type @json($reffering_type)</label>
                                <select class="form-control" wire:model.live="reffering_type">
                                    <option value="" selected>Choose reffering type</option>
                                    @foreach ($refferingTypes as $key => $title)
                                    <option value="{{ $key }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('reffering_type'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                @if ($reffering_type != 'Phone')
                                    <label for="">Reffering @json($reffering)</label>
                                    @if ($reffering_type == 'Other')
                                    <input type="text" class="form-control" placeholder="Enter reffering" wire:model.live="reffering">
                                    @else
                                    <select class="form-control" wire:model.live="reffering">
                                        <option value="" selected>Choose Reffering</option>
                                        @foreach ($refferingIds as $key => $refferings)
                                        <option value="{{ $key }}">{{ $refferings }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                @endif

                                <span class="text-danger">@error('reffering'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    {{-- Passport --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Citizenship</label>
                                <input type="text" class="form-control" placeholder="Enter citizenship"
                                    wire:model="citizenship">
                                <span class="text-danger">@error('citizenship'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Passport No</label>
                                <input type="text" class="form-control" placeholder="Enter your passport no"
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Passport Origin</label>
                                <input type="text" class="form-control" placeholder="Enter your passport origin"
                                    wire:model="passport_origin">
                                <span class="text-danger">@error('passport_origin'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Passport Image</label>
                                <input type="file" class="form-control" placeholder="Enter your birth place"
                                    wire:model="passport_image">
                                <span class="text-danger">@error('passport_image'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    {{-- Address --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control" placeholder="Enter email address"
                                    wire:model="email">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" class="form-control" placeholder="Enter your phone"
                                    wire:model="phone">
                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Foriegn phone</label>
                                <input type="text" class="form-control" placeholder="Enter your foriegn phone"
                                    wire:model="foriegn_phone">
                                <span class="text-danger">@error('foriegn_phone'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Countery</label>
                                <select class="form-control" wire:model.live="countryId">
                                    <option value=null>Select a country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('country_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">City @json($city_id)</label>
                                <select class="form-control" wire:model.live="city_id">
                                    <option>Select city</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('city_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea class="form-control" cols="2" rows="2" wire:model="address"></textarea>
                        <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 2 --}}

        <div class="step-two {{$currentStep == 2 ? 'd-block' : 'd-none'}}">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 2/4 - Address & Contacts</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="travel_treatment_activities_status">Status @json($status_id)</label>
                                <select class="form-control" wire:model.live="status_id">
                                    <option value="" selected>Select status</option>
                                    @foreach ($statuses as $key=>$status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('status_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!-- GUIDE Select2 init -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">department @json($department_id)</label>
                                <div wire:ignore>
                                    <select class="form-control select2" id="department_id">
                                        <option value="" selected>Select departmant</option>
                                        @foreach ($departments as $id => $entry)
                                        <option value="{{ $id }}">{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="travel_treatment_activities_description">description</label>
                                <textarea class="form-control" cols="2" rows="2" placeholder="Enter description"
                                    wire:model="description"></textarea>
                                <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <!-- GUIDE Dropzone init -->
                    <div class="row">
                        <div class="col-md-12">@json($treatment_files)
                            <div class="form-group" wire:ignore>
                                <label class="required" for="treatment_file">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }}" id="treatment_file-dropzone"></div>
                                @if($errors->has('treatment_file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('treatment_file') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.travelTreatmentActivity.fields.treatment_file_helper')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 3 --}}

        <div class="step-three {{$currentStep == 3 ? 'd-block' : 'd-none'}}">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 3/4 - Frameworks experience</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="notify_hospitals">{{ trans('cruds.travel.fields.notify_hospitals') }} @json($notifyHospitalIds)</label>
                                <div wire:ignore>
                                    <div style="padding-bottom: 4px">
                                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                    </div>
                                    <select class="form-control select2 {{ $errors->has('notify_hospitals') ? 'is-invalid' : '' }}" name="notify_hospitals[]" id="notifyHospitalIds" multiple>
                                        @foreach($notify_hospitals as $id => $notify_hospital)
                                            <option value="{{ $id }}" {{ in_array($id, old('notify_hospitals', [])) ? 'selected' : '' }}>{{ $notify_hospital }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('notifyHospitalIds'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="traslators">Translators @json($translatorId)</label>
                                <select class="form-control" wire:model.live="translatorId">
                                    <option value="" selected>Select translator</option>
                                    @foreach ($translators as $id => $translator)
                                    <option value="{{ $id }}">{{ $translator }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('translatorId'){{ $message }}@enderror</span>

                            </div>
                        </div>
                    </div>
                    



                </div>
            </div>
        </div>
    
        {{-- Buttons panel --}}

        <div class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">
            @if ($currentStep == 1)
            <div></div>
            @endif

            @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
            <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
            @endif

            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
            <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 4)
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
            @endif


        </div>

    </form>


</div>


@section('scripts')
@parent
<script>
    // GUIDE Select2 set livewire
    $('.select2').change(function (e) {
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
        success: function (file, response) {
        $('form').append('<input type="hidden" name="treatment_file[]" value="' + response.name + '">')
        uploadedTreatmentFileMap[file.name] = response.name
        // GUIDE Dropzone set livewire
        @this.set('treatment_files', uploadedTreatmentFileMap)

        },
        removedfile: function (file) {
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