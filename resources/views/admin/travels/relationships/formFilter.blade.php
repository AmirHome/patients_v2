<div class="card">

    <div class="card-body">
        <form action="{{ route('admin.travel-statuses.index') }}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Patient Code</label>
                        <input type="text" class="form-control filter" placeholder="Enter patient code"
                            name="patient_code">
                        <span class="text-danger">@error('patient_code'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Patient name</label>
                        <input type="text" class="form-control filter" placeholder="Enter patient name"
                            name="patient_name">

                        <span class="text-danger">@error('patient_name'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Last name</label>
                        <input type="text" class="form-control filter" placeholder="Enter last name" name="surname">
                        <span class="text-danger">@error('surname'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select class="form-control filter" wire:model.live="gender">
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
                        <input type="date" class="form-control filter" placeholder="Enter your birthday"
                            name="birthday">
                        <span class="text-danger">@error('birthday'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Birth place</label>
                        <input type="text" class="form-control filter" placeholder="Enter your birth place"
                            name="birth_place">
                        <span class="text-danger">@error('birth_place'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Mother Name</label>
                        <input type="text" class="form-control filter" placeholder="Enter your mother name"
                            name="mother_name">
                        <span class="text-danger">@error('mother_name'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Father Name</label>
                        <input type="text" class="form-control filter" placeholder="Enter your father name"
                            name="father_name">
                        <span class="text-danger">@error('father_name'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
            {{-- Physicall --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Weight</label>
                        <input type="text" class="form-control filter" placeholder="Enter weight" name="weight">
                        <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Height</label>
                        <input type="text" class="form-control filter" placeholder="Enter height" name="height">
                        <span class="text-danger">@error('height'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Blood group</label>
                        <select class="form-control filter" wire:model.live="blood_group">
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
                        <label for="">Treating doctor</label>
                        <input type="text" class="form-control filter" name="treating_doctor">
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
                        <select class="form-control filter" wire:model.live="compaignChannelId">
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
                        <label for="">Campaign organization</label>
                        <select class="form-control filter" wire:model.live="campaign_org_id">
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
                        <label for="">Reffering type</label>
                        <select class="form-control filter" wire:model.live="reffering_type">
                            <option value="" selected>Choose reffering type</option>
                            @foreach ($refferingTypes as $key => $title)
                            <option value="{{ $key }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('reffering_type'){{ $message }}@enderror</span>
                    </div>
                </div>

            </div>
            {{-- Passport --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Citizenship</label>
                        <input type="text" class="form-control filter" placeholder="Enter citizenship"
                            name="citizenship">
                        <span class="text-danger">@error('citizenship'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Passport No</label>
                        <input type="text" class="form-control filter" placeholder="Enter your passport no"
                            name="passport_no">
                        <span class="text-danger">@error('passport_no'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Passport Origin</label>
                        <input type="text" class="form-control filter" placeholder="Enter your passport origin"
                            name="passport_origin">
                        <span class="text-danger">@error('passport_origin'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Passport Image</label>
                        <input type="file" class="form-control filter" placeholder="Enter your birth place"
                            name="passport_image">
                        <span class="text-danger">@error('passport_image'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
            {{-- Address --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control filter" placeholder="Enter email address" name="email">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control filter" placeholder="Enter your phone" name="phone">
                        <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Foriegn phone</label>
                        <input type="text" class="form-control filter" placeholder="Enter your foriegn phone"
                            name="foriegn_phone">
                        <span class="text-danger">@error('foriegn_phone'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Countery</label>
                        <select class="form-control filter" wire:model.live="countryId">
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
                        <label for="">City</label>
                        <select class="form-control filter" wire:model.live="city_id">
                            <option>Select city</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('city_id'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
            <div class="">
               
                <div class="row">
                    <div class="col-8">
                        @can('travel_create')
                        <a class="btn btn-success" href="{{ route('admin.travels.create') }}">
                            <i class="fas fa-plus"></i> {{ trans('global.add') }} {{
                            trans('cruds.travel.title_singular') }}
                        </a>
                        @endcan
                    </div>
                    <div class="col-4">
                        <button class="float-right btn btn-primary" type="button" id="form-filter-submit">
                            Search <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                

            </div>
        </form>
    </div>
</div>