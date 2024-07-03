<container>
<div class="card-header pl-4">
Vaka Listesi
    </div>
    <div class="row pl-3">
        <div class="col-md-12 pl-0">
<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.travel-statuses.index') }}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="">Hasta Kodu</label>
                        <input type="text" class="form-control filter" 
                            name="patient_code" placeholder="Hasta kodu">
                        <span class="text-danger">@error('patient_code'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="">Hasta Adı</label> 
                        <input type="text" class="form-control filter" placeholder="Hasta Adı"
                            name="patient_name">
                        <span class="text-danger">@error('patient_name'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="">Cinsiyet</label>
                        <select class="form-control filter" wire:model.live="gender">
                            <option value="" selected>Cinsiyet</option>
                            @foreach ($genders as $key => $title)
                            <option value="{{ $key }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                    </div>
                </div>   
 
            </div>
            <div class="row">
         
               
                <div class="col-md-4">
                <div class="form-group">
                                    <label class="required" for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="Telefon no" type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone ?? null) }}" required>
                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.patient.fields.phone_helper') }}</span>
                                </div>
               
                </div>  
                <div class="col-md-4">
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
            </div>
                
                </div>   
                       
                <div class="col-md-4">
                <div class="form-group">
                            <label for="">Vaka Durumu</label>
                                <select class="form-control" wire:model.live="status_id">
                                    <option value="" selected>Select status</option>
                                    @foreach ($statuses as $key=>$status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('status_id'){{ $message }}@enderror</span>
                            </div>
            
            </div>

             </div>
           
             <div class="row more-filters">
    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="office_id">{{ trans('cruds.patient.fields.office') }}</label>
            <select class="form-control select2 {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office_id" id="office_id" required>
             
            </select>
            @if($errors->has('office'))
                <div class="invalid-feedback">
                    {{ $errors->first('office') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.patient.fields.office_helper') }}</span>
        </div>
    </div>

    <x-province-component class="col-md-4" :data="[]" />
    <br>
    <div class="col-md-12 pt-3 pb-3">
        <div class="dotted-border">
         
        </div>
    </div>
    <x-reffering-type-component class="col-md-4" :data="[]" />

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Rapor Geliş</label>
            <select class="form-control filter" wire:model.live="compaignChannelId">
                <option value="" selected>Rapor Geliş</option>
                @foreach ($campaignChannels as $channel)
                <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                @endforeach
            </select>
            <span class="text-danger">@error('compaignChannelId'){{ $message }}@enderror</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="arrival_date">{{ trans('cruds.travel.fields.arrival_date') }}</label>
            <input class="form-control date {{ $errors->has('arrival_date') ? 'is-invalid' : '' }}" type="text" name="arrival_date" id="arrival_date">
            @if($errors->has('arrival_date'))
            <div class="invalid-feedback">
                {{ $errors->first('arrival_date') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.travel.fields.arrival_date_helper') }}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Kategori</label>
            <select class="form-control filter" wire:model.live="compaignChannelId">
                <option value="" selected>Kategori</option>
                @foreach ($campaignChannels as $channel)
                <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                @endforeach
            </select>
            <span class="text-danger">@error('compaignChannelId'){{ $message }}@enderror</span>
        </div>
    </div>

    <x-campaign-channel-org-component class="col-md-4" :data="[]" />
    <div class="col-md-4">
    <div class="form-group">
                    
                    <label for="hospital_id">Sevk Yeri</label>
                    <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id">
                        
                    </select>
                    @if ($errors->has('hospital'))
                        <div class="invalid-feedback">
                            {{ $errors->first('hospital') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.travel.fields.hospital_helper') }}</span>
                </div>                                </div>

    <div class="col-lg-2 col-md-4">
        <div class="form-group">
            <label for="">Kampanya Baş.</label>
            <input type="text" class="form-control filter date" placeholder="Kampanya Başlangıç Tarihi" name="birth_place1">
            <span class="text-danger">@error('birth_place1'){{ $message }}@enderror</span>
        </div>
    </div>

    <div class="col-lg-2 col-md-4">
        <div class="form-group">
            <label for="">Kampanya Bit.</label>
            <input type="text" class="form-control filter date" placeholder="Kampanya Bitiş Tarihi" name="birth_place">
            <span class="text-danger">@error('birth_place'){{ $message }}@enderror</span>
        </div>
    </div>
</div>
    
        
               
                <div class="row ">
                     <div class="col-8">
                        @can('travel_create')
                        @if (Auth::user()->roles->first()->id == 100)
                        <a class="btn btn-success " href="{{ route('admin.travels.create') }}">
                            <i class="far fa-plus-square"></i> {{ trans('global.add') }} {{
                            trans('cruds.travel.title_singular') }}
                        </a>
                        @endif
                        <a class="btn btn-success" href="{{ url('admin/travel') }}">
                            {{ trans('global.add') }} {{
                            trans('cruds.travel.title_singular') }}
                        </a>
                        @endcan
                    </div>
                    <div class="col-4 ">
                    <button class="float-right btn btn-primary ml-3 mt-3 p-2" type="button" id="form-filter-submit">
                            Search <i class="fas fa-search"></i>
                        </button>
    <button class="btn btn-info float-right mt-3 p-2" type="button" id="show-filters">
        Daha Fazla Filtre <i class="fas fa-filter"></i>
    </button>
              
                </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>
</container>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showFiltersButton = document.getElementById('show-filters');
        const moreFilters = document.querySelector('.more-filters');

        moreFilters.style.display = 'none';

        showFiltersButton.addEventListener('click', function() {
            if (moreFilters.style.display === 'none') {
                moreFilters.style.display = 'flex';
                showFiltersButton.innerHTML = 'Filtreyi Gizle  <i class="fas fa-filter"></i>';
            } else {
                moreFilters.style.display = 'none';
                showFiltersButton.innerHTML = 'Daha Fazla Filtre <i class="fas fa-filter"></i>';
            }
        });
    });
</script>