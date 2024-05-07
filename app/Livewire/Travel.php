<?php

namespace App\Livewire;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\StoreTravelTreatmentActivityRequest;

use App\Models\CampaignChannel;
use App\Models\CampaignOrg;
use App\Models\Country;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Province;
use App\Models\Travel as ModelsTravel;
use App\Models\TravelStatus;
use App\Models\TravelTreatmentActivity;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\Attributes\Title;
use Livewire\WithFileUploads;


class Travel extends Component
{

    use WithFileUploads;

    #[Title('Wizard - Travel')]
    // Patient

    public $user_id;
    public $office_id;
    public $patient_id;
    public $travel_id;
    public $group_id;
    public $hospital_id;
    public $last_status_id;
    public $attendant_name;
    public $attendant_phone;
    public $has_pestilence;
    public $wants_shopping;
    public $hospital_mail_notify;
    public $notify_hospitals;
    public $hospitalization_date;
    public $planning_discharge_date;
    public $arrival_date;
    public $departure_date;
    public $visa_status;
    public $visa_start_date;
    public $visa_end_date;





    public $wizardData = [];

    public $photo;
    public $name;
    public $surname;
    public $middle_name;
    public $birthday;
    public $birth_place;
    public $mother_name;
    public $father_name;
    public $weight;
    public $height;
    public $blood_group;
    public $citizenship;
    public $passport_no;
    public $passport_image;
    public $passport_origin;
    public $phone;
    public $foriegn_phone;
    public $email;
    public $gender;
    public $address;
    public $city_id;
    public $campaign_org_id;
    public $reffering_type;
    public $reffering;
    public $treating_doctor;
    public $code;


    public $age;
    public $description;
    public $frameworks = [];
    public $cv;
    public $treatment_files = [];
    public $terms;

    public $totalSteps = 4;
    public $currentStep = 1;

    public function render()
    {
        return view('livewire.travel-wizard')->layout('components.layouts.app');
    }


    public function __construct()
    {
        $this->user_id = auth()->id();
        $this->office_id = auth()->user()->office_id ?? 2;
    }

    public $countryId;
    public $countries;
    public $cities;
    public $genders;
    public $bloodGroups;
    public $campaignChannels;
    public $compaignChannelId;
    public $campaignOrganizations;
    public $refferingTypes;
    public $refferingIds = [];

    public $statuses;
    public $status_id;

    public $departments;
    public $department_id;

    public function mount()
    {
        $this->countries = Country::get(['id', 'name']);
        $this->cities    = collect();
        $this->countryId = 1;

        // Set default country and Generate Code
        $this->updatedCountryId($this->countryId);

        $this->city_id = null;

        $this->genders = Patient::GENDER_SELECT;
        $this->bloodGroups = Patient::BLOOD_GROUP_SELECT;
        $this->refferingTypes = ModelsTravel::REFFERING_TYPE_SELECT;

        $this->campaignChannels = CampaignChannel::get(['id', 'title']); //->pluck('title', 'id');
        $this->campaignOrganizations = collect();
        $this->compaignChannelId = null;
        $this->campaign_org_id = null;

        $this->statuses = TravelStatus::orderBy('ordering', 'desc')->get(['id', 'title'])->pluck('title', 'id');

        $this->departments = Department::get(['id', 'name'])->pluck('name', 'id');
        $this->department_id = null;

        $this->status_id = $this->last_status_id = null;
    }

    public function updatedCountryId($value)
    {
        $this->cities = Province::where('country_id', $value)->get(['id', 'name']);

        $this->code = generateCode($value);
        $this->city_id = null;
    }

    public function updatedCompaignChannelId($value)
    {
        $this->campaignOrganizations = CampaignOrg::where('channel_id', $value)->where('status', 1)->get(['id', 'title']);
        $this->campaign_org_id = null;
    }

    public function updatedRefferingType($value)
    {
        if (in_array($value, ['Doctor', 'Ministry', 'Office']))
            $this->refferingIds = resolve("App\\Models\\$value")::get(['id', 'name'])->pluck('name', 'id');

        $this->reffering = null;
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {

        if ($this->currentStep == 1) {
            
            $rules = (new StorePatientRequest())->rules();
            $rules = array_merge($rules, [
                'reffering_type' => 'required',
                'reffering' => in_array($this->reffering_type, ['Phone', 'Other']) ? 'nullable' : 'required',
            ]);
            $data = $this->validate($rules);
            $this->wizardData['Patient'] = array_diff_key($data, array_flip(['reffering_type', 'reffering']));
            $this->wizardData['Travel'] = array_intersect_key($data, array_flip(['reffering_type', 'reffering']));
        } elseif ($this->currentStep == 2) {

            $rulesTravel =  ['last_status_id' => 'nullable|integer',
                             'department_id' => 'required', 
                            ];
            $rulesTravelTreatmentActivity = [
                'status_id'                 => 'integer',
                'description'               => 'required',
            ];
            $rules = array_merge($rulesTravel, $rulesTravelTreatmentActivity);
            $this->validate($rules);

            $this->wizardData['Travel'] = array_merge($this->wizardData['Travel'], $this->validate($rulesTravel));
            $this->wizardData['TravelTreatmentActivity'] = $this->validate($rulesTravelTreatmentActivity);

        } elseif ($this->currentStep == 3) {
        } elseif ($this->currentStep == 4) {

        }

        if ($this->currentStep == $this->totalSteps) {
            $this->store();
        }
    }

    public function store()
    {

        $this->resetErrorBag();
        DB::beginTransaction();
        try {
            $this->patient_id = Patient::create($this->wizardData['Patient'])->id;

            $this->wizardData['Travel']['patient_id'] = $this->patient_id;
            $this->wizardData['Travel']['last_status_id'] = $this->status_id;
            $this->travel_id = ModelsTravel::create($this->wizardData['Travel'])->id;


            $this->wizardData['TravelTreatmentActivity']['user_id'] = $this->user_id;
            $this->wizardData['TravelTreatmentActivity']['travel_id'] = $this->travel_id;
            $travelTreatmentActivity = TravelTreatmentActivity::create($this->wizardData['TravelTreatmentActivity']);

            foreach ($this->treatment_files as $file) {
                $travelTreatmentActivity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('treatment_file');
            }
            
            Country::where('id', $this->countryId)->increment('code_inc');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }


        $data = ['code' => $this->wizardData['Patient']['code']];
        $this->reset();
        $this->currentStep = 1;

        return redirect('travel')->with('success', 'Travel created successfully');

        // return redirect()->route('travel', $data);
        // return redirect()->route('admin.travels.index', compact('data'));

    }
}
