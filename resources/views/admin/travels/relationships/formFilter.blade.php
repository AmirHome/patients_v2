<container>
<div class="card-header">
Vaka Listesi
    </div>
    <div class="row pl-0">
        <div class="col-md-12 pl-0">
<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.travel-statuses.index') }}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="">Hasta Kodu</label>
                        <input type="text" class="form-control filter" placeholder="Hasta Kodu"
                            name="patient_code">
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
                    <label for="">Vaka Durumu</label>
                        <select class="form-control filter" wire:model.live="gender">
                            <option value="" selected>Vaka Durumu</option>
                            @foreach ($genders as $key => $title)
                            <option value="{{ $key }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="">Sevk Yeri</label>
                        <select class="form-control filter" wire:model.live="gender">
                            <option value="" selected>Sevk Yeri</option>
                            @foreach ($genders as $key => $title)
                            <option value="{{ $key }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
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

             </div>
           
            <div class="row">
              
            <div class="col-md-4">
                    <div class="form-group">
                    <label for="">Ofis</label>
                        <input type="text" class="form-control filter" placeholder="Ofis" name="phone">
                        <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                    </div>
                </div>
             
                <x-province-component class="col-md-4" :data="[]"/>
                <x-reffering-type-component class="col-md-4" :data="[]"/>


            </div>
            <div class="row justify-content-center">
        <div class="col-md-12 pt-3 pb-3">
            <div class="dotted-border">
            </div>
        </div>
    </div>
    <div class="row">
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
               <input class="form-control date {{ $errors->has('arrival_date') ? 'is-invalid' : '' }}" type="text" name="arrival_date" id="arrival_date" >
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
            </div>
             <div class="row">
                
                <x-campaign-channel-org-component class="col-md-4" :data="[]"/>
                
                <div class="col-lg-2 colm-md-4 ">
        <div class="form-group">
        <label for="">Kampanya Baş.</label>
            <input type="text" class="form-control filter date" placeholder="Kampanya Başlangıç Tarihi"
                name="birth_place1">
            <span class="text-danger">@error('birth_place1'){{ $message }}@enderror</span>
        </div>
           </div>
                <div class="col-lg-2 colm-md-4">
                    <div class="form-group">
                    <label for="">Kampanya Bit.</label>
                        <input type="text" class="form-control filter date" placeholder="Kampanya Bitiş Tarihi"
                            name="birth_place">
                        <span class="text-danger">@error('birth_place'){{ $message }}@enderror</span>
                    </div>
                </div>

            </div>
    
        
               
                <div class="row">
                    <div class="col-8">
                        @can('travel_create')
                        @if (Auth::user()->roles->first()->id == 100)
                        <a class="btn btn-success " href="{{ route('admin.travels.create') }}">
                            <i class="far fa-plus-square"></i> {{ trans('global.add') }} {{
                            trans('cruds.travel.title_singular') }}
                        </a>
                        @endif
                        <a class="btn btn-success pt-2 mt-2" href="{{ url('admin/travel') }}">
                            {{ trans('global.add') }} {{
                            trans('cruds.travel.title_singular') }}
                        </a>
                        @endcan
                    </div>
                    <div class="col-4">
                        <button class="float-right btn btn-primary pt-2 mt-2" type="button" id="form-filter-submit">
                            Search <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>
</container>