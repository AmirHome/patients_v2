<div>

    <form wire:submit.prevent="store">

        {{-- STEP 1 --}}


  <div class="container-fluid p-0 m-0">

    <div class="row">
        <div class="col-md-11">
        <div class="step-one {{$currentStep == 1 ? 'd-block' : 'd-none'}}">
            <div class="card">
            <div class="card-header">Hasta Bilgileri</div>
                <div class="card-body">
                <div class="row justify-content-center pb-5 pt-2 flex-nowrap">
  <div class="d-flex justify-content-center">
  <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9312;</span>
  </div>
  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
    <span
      class="w-100 rounded"
      style="height: 0.1rem;background-color: #D7DDE0;"
    >
    </span>
  </div>
  <div class="d-flex justify-content-center">
  <span style='font-size:60px;border: 0px solid #00b8d9;color: #D7DDE0 !important;'>&#9313;</span>

  </div>
  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
    <span
      class="w-100 rounded"
      style="height: 0.1rem;background-color: #D7DDE0;"
    >
    </span>
  </div>
  <div class="d-flex justify-content-center">

    <span style='font-size:60px;border: 0px solid #00b8d9;color: #D7DDE0 !important;'>&#9314;</span>

  </div>
</div>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Hasta Kodu</label>
                             <input type="text" class="form-control" id="code" value="{{$code}}" readonly placeholder="Code" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Hasta Geliş Tarihi</label>
                             <input type="text" class="form-control" id="date"  readonly placeholder="{{getCurrentDate()}}" disabled>
                            </div>
                        </div>
                        </div>
                        <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="">İsim</label>
                                <input type="text" class="form-control" placeholder="Enter first name"
                                    wire:model="name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="">İkinci ismi</label>
                                <input type="text" class="form-control" placeholder="Enter middel name"
                                    wire:model="middle_name">
                                <span class="text-danger">@error('middle_name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Soyadı</label>
                                <input type="text" class="form-control" placeholder="Enter last name"
                                    wire:model="surname">
                                <span class="text-danger">@error('surname'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        </div>
                    <div class="row">
                    <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Cinsiyet</label>
                                <select class="form-control" wire:model.live="gender">
                                    <option value="" selected>Choose gender</option>
                                    @foreach ($genders as $key => $title)
                                    <option value="{{ $key }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                            <label for="">Doğum Tarihi</label>
                                <input type="date" class="form-control" placeholder="Enter your birthday"
                                    wire:model="birthday">
                                <span class="text-danger">@error('birthday'){{ $message }}@enderror</span>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Doğum Yeri</label>
                                <input type="text" class="form-control" placeholder="Enter your birth place"
                                    wire:model="birth_place">
                                <span class="text-danger">@error('birth_place'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    {{-- Physicall --}}
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Kan Grubu</label>
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
                            <label for="">Kilosu</label>
                                <input type="text" class="form-control" placeholder="Enter weight" wire:model="weight">
                                <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Boyu</label>
                                <input type="text" class="form-control" placeholder="Enter height" wire:model="height">
                                <span class="text-danger">@error('height'){{ $message }}@enderror</span>
                            </div>
                        </div>
            
                    </div>
                    {{-- Reffer, Campaign --}}
                    <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                            <label for="">Passport Numarası</label>
                                <input type="text" class="form-control" placeholder="Enter your passport no"
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="">Email Adresi</label>
                                <input type="email" class="form-control" placeholder="Enter email address"
                                    wire:model="email">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                        </div>
                             
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="">Telefon No</label>
                                <input type="text" class="form-control" placeholder="Enter your phone"
                                    wire:model="phone">
                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Ülke</label>
                                <select class="form-control" wire:model.live="countryId">
                                    <option value=null>Select a country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('country_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Şehir</label>
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
                           <div class="col-md-12 pt-3 pb-3">
            <div class="dotted-border">
            </div>
        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Kanal</label>
                                <select class="form-control" wire:model.live="compaignChannelId">
                                    <option value="" selected>Choose channels</option>
                                    @foreach ($campaignChannels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('compaignChannelId'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Organizasyon</label>
                                <select class="form-control" wire:model.live="campaign_org_id">
                                    <option value="" selected>Choose organization</option>
                                    @foreach ($campaignOrganizations as $org)
                                    <option value="{{ $org->id }}">{{ $org->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('campaign_org_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Referans Tipiniz</label>
                                <select class="form-control" wire:model.live="reffering_type">
                                    <option value="" selected>Choose reffering type</option>
                                    @foreach ($refferingTypes as $key => $title)
                                    <option value="{{ $key }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('reffering_type'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Referansınız</label>
                                @if ($reffering_type != 'Phone')
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
                   
                </div>
            </div>
        </div>

        {{-- STEP 2 --}}

        <div class="step-two {{$currentStep == 2 ? 'd-block' : 'd-none'}}">
            <div class="card">
                <div class="card-header">Vaka Bilgileri ve Rapor Yükleme</div>
                <div class="card-body">
                <div class="row justify-content-center pb-5 pt-2 flex-nowrap">
  <div class="d-flex justify-content-center">
  <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9312;</span>
  </div>
  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
    <span
      class="w-100 rounded"
      style="height: 0.1rem;background-color: #D7DDE0;"
    >
    </span>
  </div>
  <div class="d-flex justify-content-center">
  <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9313;</span>

  </div>
  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
    <span
      class="w-100 rounded"
      style="height: 0.1rem;background-color: #D7DDE0;"
    >
    </span>
  </div>
  <div class="d-flex justify-content-center">

    <span style='font-size:60px;border: 0px solid #00b8d9;color: #D7DDE0 !important;'>&#9314;</span>

  </div>
</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Durum</label>
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
                            <label for="">Departman</label>
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
                            <label for="">Açıklama</label>
                                <textarea class="form-control" cols="2" rows="2" placeholder="Enter description"
                                    wire:model="description"></textarea>
                                <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <!-- GUIDE Dropzone init -->
                    <div class="row">
                        <div class="col-md-9">
                            <!-- @json($treatment_files) boş [] geliyordu kapattım -->
                            <div class="form-group" wire:ignore>
                            <label class="required" for="treatment_file">Dosya Yükle (max:10mb pdf-excel-word-zip-img)</label>
                                <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }}" id="treatment_file-dropzone">
                                <div class="dz-message" data-dz-message><span>Drop or Select file</span> </div>
                                <div class="dz-message" data-dz-message><p>Drop files here or click <a>browse</a> thorough your machien</p></div>
                                </div>
                                

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
            <div class="card-header">Bilgilendirmeler</div>
                <div class="card-body">
                <div class="row justify-content-center pb-5 pt-2 flex-nowrap">
  <div class="d-flex justify-content-center">
  <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9312;</span>
  </div>
  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
    <span
      class="w-100 rounded"
      style="height: 0.1rem;background-color: #D7DDE0;"
    >
    </span>
  </div>
  <div class="d-flex justify-content-center">
  <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9313;</span>

  </div>
  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
    <span
      class="w-100 rounded"
      style="height: 0.1rem;background-color: #D7DDE0;"
    >
    </span>
  </div>
  <div class="d-flex justify-content-center">

    <span style='font-size:60px;border: 0px solid #00b8d9;color: #00b8d9 !important;'>&#9314;</span>

  </div>
</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notify_hospitals">{{ trans('cruds.travel.fields.notify_hospitals') }} </label>
                                <div wire:ignore>
                                    <div >
                                        <span class="btn btn-info btn-xs select-all mb-3">{{ trans('global.select_all') }}</span>
                                        <span class="btn btn-info btn-xs deselect-all mb-3">{{ trans('global.deselect_all') }}</span>
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
</div>
<div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="traslators">Translators</label>
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

        <div class="action-buttons d-flex justify-content-between bg-white pt-3 pb-3">
            @if ($currentStep == 1)
            <div></div>
            @endif

            @if ($currentStep == 2 || $currentStep == 3 )
            <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
            @endif

            @if ($currentStep == 1 || $currentStep == 2 )
            <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 3)
            <button type="submit" class="btn btn-md btn-primary">Final</button>
            @endif

            </div>
  </div>
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