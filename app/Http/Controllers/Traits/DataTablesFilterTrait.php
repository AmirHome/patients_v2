<?php

namespace App\Http\Controllers\Traits;

use App\Models\Travel;
use App\Models\CampaignChannel;
use App\Models\Country;
use App\Models\CrmStatus;
use App\Models\Department;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\TaskStatus;
use App\Models\Translator;
use App\Models\TravelStatus;
use App\Models\User;
use Illuminate\Http\Request;


trait DataTablesFilterTrait
{
    public function travelFilterMount(){
                // Form filters
                $countries = Country::get(['id', 'name']);
                $cities    = collect();
                $genders = Patient::GENDER_SELECT;
                $bloodGroups = Patient::BLOOD_GROUP_SELECT;
                $refferingTypes = Travel::REFFERING_TYPE_SELECT;
                $campaignChannels = CampaignChannel::get(['id', 'title']); //->pluck('title', 'id');
                $campaignOrganizations = collect();
                $statuses = TravelStatus::orderBy('ordering', 'desc')->get(['id', 'title'])->pluck('title', 'id');
                $departments = Department::get(['id', 'name'])->pluck('name', 'id');
                $notify_hospitals = Hospital::get(['id', 'name'])->pluck('name', 'id');
                $translators = Translator::get(['id', 'title'])->pluck('title', 'id');

                return compact('countries', 'cities','genders', 'bloodGroups', 'refferingTypes', 'campaignChannels', 'campaignOrganizations', 'statuses', 'departments', 'notify_hospitals', 'translators');
    }

    public function travelFilter(Request $request, $query){
            // Add custom filter for search_index
            if ($request->has('ff_patient_name')) {
                $value = $request->input('ff_patient_name');
                $query->whereHas('patient', function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('surname', 'like', '%' . $value . '%')
                        ->orWhere('middle_name', 'like', '%' . $value . '%');
                });
            }
            if ($request->has('ff_patient_code')) {
                $value = $request->input('ff_patient_code');
                $query->whereHas('patient', function ($query) use ($value) {
                    $query->where('code', 'like', '%' . $value . '%');
                });
            }
        return $query;
    }

    public function crmFilter(Request $request, $query){
        // Add custom filter for search_index
        if ($request->has('ff_name')) {
            $value = $request->input('ff_name');
            if(!empty($value)){
                $query->where(function ($q) use($value){
                    $q->where('first_name', 'like', '%' . $value . '%')
                        ->orWhere('last_name', 'like', '%' . $value . '%');
                });
            }
        }
        if ($request->has('ff_status_id')) {
            $value = $request->input('ff_status_id');
            if(!empty($value)){
                $query->where('status_id', $value);
            }
        }


        return $query;
    }

    public function crmMountFilter(){
        // Mount Data for Form filters
        $countries = Country::get(['id', 'name']);
        $cities    = collect();
        $campaignChannels = CampaignChannel::get(['id', 'title']); //->pluck('title', 'id');
        $campaignOrganizations = collect();
        $statuses = CrmStatus::get(['id', 'name'])->pluck('name', 'id');

        return compact('countries', 'cities', 'campaignChannels', 'campaignOrganizations', 'statuses');
    }

    public function taskMountFilter(){
        // Mount Data for Form filters

        $statuses = TaskStatus::pluck('name', 'id');//->prepend(trans('global.select_all'), '');
        $assigned_tos = User::pluck('name', 'id');//->prepend(trans('global.select_all'), '');

        return compact('statuses', 'assigned_tos');
    }
    public function taskFilter(Request $request, $query){
        // Add custom filter for search_index
        if ($request->has('ff_content')) {
            $value = $request->input('ff_content');
            if(!empty($value)){
                $query->where(function ($q) use($value){
                    $q->where('name', 'like', '%' . $value . '%')
                        ->orWhere('description', 'like', '%' . $value . '%');
                });            
            }
        }
        if ($request->has('ff_status_id')) {
            $value = $request->input('ff_status_id');
            if(!empty($value)){
                $query->whereIn('status_id', $value);
            }
        }

        if ($request->has('ff_assignee')) {
            $value = $request->input('ff_assignee');
            if(!empty($value)){
                $query->where('assigned_to_id', auth()->id());
            }else{
                if(auth()->user()->roles->first()->title == 'User'){
                    $query->where('user_id', auth()->id());
                }
            }
        }else{
            if(auth()->user()->roles->first()->title == 'User'){
                $query->where('user_id', auth()->id());
            }
        }

        return $query;
    }

    //financeFilter financeMountFilter
    public function financeMountFilter(){
        // Mount Data for Form filters
        // $departments = Department::get(['id', 'name']);
        // $users = User::get(['id', 'name']);
        $patients = Patient::get(['id', 'name']);
        // $statuses = CrmStatus::get(['id', 'name']);

        return compact('patients');
    }
    public function financeFilter (Request $request, $query){
        // Add custom filter for search_index
        if ($request->has('ff_patient_name')) {
            $value = $request->input('ff_patient_name');
            $query->whereHas('patient', function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%')
                    ->orWhere('surname', 'like', '%' . $value . '%')
                    ->orWhere('middle_name', 'like', '%' . $value . '%');
            });
        }
        if ($request->has('ff_patient_code')) {
            $value = $request->input('ff_patient_code');
            $query->whereHas('patient', function ($query) use ($value) {
                $query->where('code', 'like', '%' . $value . '%');
            });
        }
        return $query;
        
    }

}

/*
GUIDE DataTables Filter Trait

-- Controller
    use DataTablesFilterTrait;

    $data = $this->__MountFilter();

    $query = $this->__Filter($request, $query);

    return view('', $data);

-- Index blade

    @includeIf('admin.__.relationships.formFilter')

    <!-- scripts -->

    ajax: {
        url: "{{ route('admin.__.index') }}",
        data: function(d) {
            d.ff__name = $('.filter[name="__name"]').val();
            d.ff__code = $('.filter[name="__code"]').val();
        }
    },


    $('#form-filter-submit').click(function () {
        table.ajax.reload();
    })

-- formFilter.blade.php

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.__.index') }}" method="get">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Customer Code</label>
                            <input type="text" class="form-control filter" placeholder="Enter customer code"
                                name="customer_code">
                            <span class="text-danger">@error('customer_code'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">customer name</label>
                            <input type="text" class="form-control filter" placeholder="Enter customer name"
                                name="customer_name">

                            <span class="text-danger">@error('customer_name'){{ $message }}@enderror</span>
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

                <div class="bar">
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


*/