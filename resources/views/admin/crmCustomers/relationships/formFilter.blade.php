{{-- @includeIf('admin.crmCustomers.relationships.formFilter') --}}
<div class="card">

    <div class="card-body">
        <form action="{{ route('admin.crm-customers.index') }}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">customer name</label>
                        <input type="text" class="form-control filter" placeholder="Enter customer name" name="name">
                        <span class="text-danger">@error('customer_name'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control filter" wire:model.live="status" name="status_id">
                            <option value="" selected>Choose status</option>
                            @foreach ($statuses as $id => $status)
                            <option value="{{ $id }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('Status'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>

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

            </div>

            <div class="row">
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
                        @can('crm_customer_create')
                        <a class="btn btn-success" href="{{ route('admin.crm-customers.create') }}">
                            <i class="fas fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.crmCustomer.title_singular') }}

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