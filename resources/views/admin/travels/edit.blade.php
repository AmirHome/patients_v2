@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.travel.title_singular') }}
    </div>

    <div class="card-body">
    <div class="card-header mt-0 pt-0">
        Hasta Biglileri
    </div>

        <form method="POST" action="{{ route("admin.travels.update", [$travel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
            <div class="col-md-3">
            <img class="card-img-top rounded-circle ml-4" src="https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/no-profile-picture-icon.png" alt="Card image" style="max-width:200px">
                    </div>
                    
                    <div class="col-md-3">

                    <div class="form-group">
                            <label for="">Hasta Kodu</label>
                             <input type="text" class="form-control" id="code"  readonly placeholder="Code (#125T61)" disabled>
                            </div>
                         
                            <div class="form-group">
                            <label for="">Sevk Yeri</label>
                        <select class="form-control filter" wire:model.live="gender">
                            <option value="" selected>Sevk Yeri</option>
                        
                        </select>
                        <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                    </div>
                        </div>
                         
                            
                        <div class="col-md-3">
                       
                            <div class="form-group">
                            <label for="">İsim</label>
                                <input type="text" class="form-control" placeholder="Enter first name"
                                    wire:model="name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                            <label for="">Cinsiyet</label>
                                <select class="form-control" wire:model.live="gender">
                                    <option value="" selected>Choose gender</option>
                                    <option >Man</option>
                                    <option >Women</option>
                                </select>
                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                            </div>
                          
                        </div>
                        <div class="col-md-3">
                       
                        <div class="form-group">
                            <label for="">Soyadı</label>
                                <input type="text" class="form-control" placeholder="Enter last name"
                                    wire:model="surname">
                                <span class="text-danger">@error('surname'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                            <label for="">Telefon No</label>
                                <input type="text" class="form-control" placeholder="Enter your phone"
                                    wire:model="phone">
                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                            </div>
                         
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-3">
                    <div class="form-group">
                            <label for="">Kan Grubu</label>
                                <select class="form-control" wire:model.live="blood_group">
                                <option value="" selected>Choose blood group</option>
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
                                <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                            
                            <label for="">Vaka Kategorisi</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                                           
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                            <label for="">Anne Adı</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                            </div>

                            <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Baba Adı</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                            <label for="">İkinci ismi</label>
                                <input type="text" class="form-control" placeholder="Enter middel name"
                                    wire:model="middle_name" name="name">
                                <span class="text-danger">@error('middle_name'){{ $message }}@enderror</span>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                <label class="required" for="citizenship">{{ trans('cruds.patient.fields.citizenship') }}</label>
                <input class="form-control {{ $errors->has('citizenship') ? 'is-invalid' : '' }}" type="text" name="citizenship" id="citizenship" value="{{ old('citizenship', $patient->citizenship??null) }}" required>
                @if($errors->has('citizenship'))
                    <div class="invalid-feedback">
                        {{ $errors->first('citizenship') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.citizenship_helper') }}</span>
            </div>
      
</div>            

<div class="col-md-3">

<div class="form-group">
<label for="">Doğum Yeri</label>
<input type="text" class="form-control" placeholder="Enter your birth place"
 wire:model="birth_place">
<span class="text-danger">@error('birth_place'){{ $message }}@enderror</span>
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


<div class="col-md-3">

<div class="form-group">
<label for="">Passport Numarası</label>
<input type="text" class="form-control" placeholder="Enter your passport no"
 wire:model="passport_no">
<span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
</div>
</div>
<div class="col-md-3">

<div class="form-group">
<label class="required" for="passport_origin">{{ trans('cruds.patient.fields.passport_origin') }}</label>
<input class="form-control" type="text" name="passport_origin" id="passport_origin"  required>

<span class="help-block">{{ trans('cruds.patient.fields.passport_origin_helper') }}</span>
</div>
</div>           
                            <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Bilgilendiren Hastaneler</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                            </div>

                            <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Kazanan Hastane</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                            </div>

                                                      <div class="col-md-3">
                                                      <div class="form-group">
                            <label for="">Yönlendirilen Kurum</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                                   </div>
                                   <div class="col-md-3">
                                   <div class="form-group">
                            <label for="">Kampanya</label>
                                <input type="text" class="form-control" placeholder=""
                                    wire:model="passport_no">
                                <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                            </div>
                                   </div>
                                   <div class="col-md-3">

                                   <div class="form-group">
                <label class="required" for="office_id">{{ trans('cruds.patient.fields.office') }}</label>
                <select class="form-control select2 {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id" required>
                    @foreach($offices??[] as $id => $entry)
                        <option value="{{ $id }}" {{ (old('office_id') ? old('office_id') : $patient->office->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('office'))
                    <div class="invalid-feedback">
                        {{ $errors->first('office') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.office_helper') }}</span>
            </div>
            </div>
            <div class="col-md-3">

            <div class="form-group">
                <label for="campaign_org_id">{{ trans('cruds.patient.fields.campaign_org') }}</label>
                <select class="form-control select2 {{ $errors->has('campaign_org') ? 'is-invalid' : '' }}" name="campaign_org_id" id="campaign_org_id">
                    @foreach($campaign_orgs??[] as $id => $entry)
                        <option value="{{ $id }}" {{ (old('campaign_org_id') ? old('campaign_org_id') : $patient->campaign_org->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('campaign_org'))
                    <div class="invalid-feedback">
                        {{ $errors->first('campaign_org') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.campaign_org_helper') }}</span>
            </div>
            </div>
  

 </div>
                        <div class="col-md-12 pt-3 pb-3">
                        <div class="dotted-border">
                       </div>
                </div>
                
                        
   <div class="card-header">
        Vaka Bilgileri ve Rapor Yükleme
    </div>
           <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="last_status_id">{{ trans('cruds.travel.fields.last_status') }}</label>
                <select class="form-control select2 {{ $errors->has('last_status') ? 'is-invalid' : '' }}" name="last_status_id" id="last_status_id" required>
                    @foreach($last_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('last_status_id') ? old('last_status_id') : $travel->last_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('last_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.last_status_helper') }}</span>
            </div>
            </div>
            <div class="col-md-6">

            <div class="form-group">
                <label for="department_id">{{ trans('cruds.travel.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $travel->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.department_helper') }}</span>
            </div>            </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="">Açıklama</label>
                                <textarea class="form-control" cols="2" rows="2" placeholder="Enter description"
                                    wire:model="description"></textarea>
                                <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-9">
                             <div class="form-group" wire:ignore>
                            <label class="required" for="treatment_file">Dosya Yükle (max:10mb pdf-excel-word-zip-img)</label>
                                <div class="needsclick dropzone {{ $errors->has('treatment_file') ? 'is-invalid' : '' }} treatment_file-dropzone" id="treatment_file-dropzone">
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
<div class="col-md-12 pt-3 pb-3">
                        <div class="dotted-border">
                       </div>
                                               
   <div class="card-header">
        Bilgilendirmeler
    </div>
                       <div class="form-group">
                <label for="attendant_name">{{ trans('cruds.travel.fields.attendant_name') }}</label>
                <input class="form-control {{ $errors->has('attendant_name') ? 'is-invalid' : '' }}" type="text" name="attendant_name" id="attendant_name" value="{{ old('attendant_name', $travel->attendant_name) }}">
                @if($errors->has('attendant_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendant_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.attendant_name_helper') }}</span>
            </div>
           
            <div class="form-group">
                <label for="attendant_phone">{{ trans('cruds.travel.fields.attendant_phone') }}</label>
                <input class="form-control {{ $errors->has('attendant_phone') ? 'is-invalid' : '' }}" type="text" name="attendant_phone" id="attendant_phone" value="{{ old('attendant_phone', $travel->attendant_phone) }}">
                @if($errors->has('attendant_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendant_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.attendant_phone_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="group_id">{{ trans('cruds.travel.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $travel->group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.group_helper') }}</span>
            </div>
           
            <div class="form-group">
                <label class="required" for="last_status_id">{{ trans('cruds.travel.fields.last_status') }}</label>
                <select class="form-control select2 {{ $errors->has('last_status') ? 'is-invalid' : '' }}" name="last_status_id" id="last_status_id" required>
                    @foreach($last_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('last_status_id') ? old('last_status_id') : $travel->last_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('last_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.last_status_helper') }}</span>
            </div>
         
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_pestilence') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_pestilence" value="0">
                    <input class="form-check-input" type="checkbox" name="has_pestilence" id="has_pestilence" value="1" {{ $travel->has_pestilence || old('has_pestilence', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_pestilence">{{ trans('cruds.travel.fields.has_pestilence') }}</label>
                </div>
                @if($errors->has('has_pestilence'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_pestilence') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.has_pestilence_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('hospital_mail_notify') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="hospital_mail_notify" value="0">
                    <input class="form-check-input" type="checkbox" name="hospital_mail_notify" id="hospital_mail_notify" value="1" {{ $travel->hospital_mail_notify || old('hospital_mail_notify', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="hospital_mail_notify">{{ trans('cruds.travel.fields.hospital_mail_notify') }}</label>
                </div>
                @if($errors->has('hospital_mail_notify'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_mail_notify') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.hospital_mail_notify_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notify_hospitals">{{ trans('cruds.travel.fields.notify_hospitals') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" >{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" >{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('notify_hospitals') ? 'is-invalid' : '' }}" name="notify_hospitals[]" id="notify_hospitals" multiple>
                    @foreach($notify_hospitals as $id => $notify_hospital)
                        <option value="{{ $id }}" {{ (in_array($id, old('notify_hospitals', [])) || $travel->notify_hospitals->contains($id)) ? 'selected' : '' }}>{{ $notify_hospital }}</option>
                    @endforeach
                </select>
                @if($errors->has('notify_hospitals'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notify_hospitals') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.notify_hospitals_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reffering">{{ trans('cruds.travel.fields.reffering') }}</label>
                <input class="form-control {{ $errors->has('reffering') ? 'is-invalid' : '' }}" type="text" name="reffering" id="reffering" value="{{ old('reffering', $travel->reffering) }}">
                @if($errors->has('reffering'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reffering') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.reffering_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.travel.fields.reffering_type') }}</label>
                <select class="form-control {{ $errors->has('reffering_type') ? 'is-invalid' : '' }}" name="reffering_type" id="reffering_type" required>
                    <option value disabled {{ old('reffering_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Travel::REFFERING_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('reffering_type', $travel->reffering_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('reffering_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reffering_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.reffering_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hospitalization_date">{{ trans('cruds.travel.fields.hospitalization_date') }}</label>
                <input class="form-control date {{ $errors->has('hospitalization_date') ? 'is-invalid' : '' }}" type="text" name="hospitalization_date" id="hospitalization_date" value="{{ old('hospitalization_date', $travel->hospitalization_date) }}">
                @if($errors->has('hospitalization_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospitalization_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.hospitalization_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="planning_discharge_date">{{ trans('cruds.travel.fields.planning_discharge_date') }}</label>
                <input class="form-control date {{ $errors->has('planning_discharge_date') ? 'is-invalid' : '' }}" type="text" name="planning_discharge_date" id="planning_discharge_date" value="{{ old('planning_discharge_date', $travel->planning_discharge_date) }}">
                @if($errors->has('planning_discharge_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('planning_discharge_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.planning_discharge_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="arrival_date">{{ trans('cruds.travel.fields.arrival_date') }}</label>
                <input class="form-control date {{ $errors->has('arrival_date') ? 'is-invalid' : '' }}" type="text" name="arrival_date" id="arrival_date" value="{{ old('arrival_date', $travel->arrival_date) }}">
                @if($errors->has('arrival_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arrival_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departure_date">{{ trans('cruds.travel.fields.departure_date') }}</label>
                <input class="form-control date {{ $errors->has('departure_date') ? 'is-invalid' : '' }}" type="text" name="departure_date" id="departure_date" value="{{ old('departure_date', $travel->departure_date) }}">
                @if($errors->has('departure_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('departure_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.departure_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('wants_shopping') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="wants_shopping" value="0">
                    <input class="form-check-input" type="checkbox" name="wants_shopping" id="wants_shopping" value="1" {{ $travel->wants_shopping || old('wants_shopping', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="wants_shopping">{{ trans('cruds.travel.fields.wants_shopping') }}</label>
                </div>
                @if($errors->has('wants_shopping'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wants_shopping') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.wants_shopping_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('visa_status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="visa_status" value="0">
                    <input class="form-check-input" type="checkbox" name="visa_status" id="visa_status" value="1" {{ $travel->visa_status || old('visa_status', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="visa_status">{{ trans('cruds.travel.fields.visa_status') }}</label>
                </div>
                @if($errors->has('visa_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.visa_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visa_start_date">{{ trans('cruds.travel.fields.visa_start_date') }}</label>
                <input class="form-control date {{ $errors->has('visa_start_date') ? 'is-invalid' : '' }}" type="text" name="visa_start_date" id="visa_start_date" value="{{ old('visa_start_date', $travel->visa_start_date) }}">
                @if($errors->has('visa_start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa_start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.visa_start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visa_end_date">{{ trans('cruds.travel.fields.visa_end_date') }}</label>
                <input class="form-control date {{ $errors->has('visa_end_date') ? 'is-invalid' : '' }}" type="text" name="visa_end_date" id="visa_end_date" value="{{ old('visa_end_date', $travel->visa_end_date) }}">
                @if($errors->has('visa_end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa_end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.travel.fields.visa_end_date_helper') }}</span>
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