<?php

namespace App\Livewire;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\StoreTravelRequest;
use App\Models\CampaignChannel;
use App\Models\CampaignOrg;
use App\Models\Country;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Province;
use App\Models\Travel as ModelsTravel;
use App\Models\TravelStatus;
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
    public $reffering_other;
    public $treating_doctor;
    public $code;


    public $age;
    public $description;
    public $frameworks = [];
    public $cv;
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
        $this->office_id = auth()->user()->office_id??2;
        $this->code = 'TRV-' . date('Y') . '-' . rand(1000, 9999);
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
    public $refferingIds=[];

    public $statuses;
    public $status_id;

    public $departments;
    public $department_id;

    public function mount()
    {
        $this->countries = Country::get(['id', 'name']);
        $this->cities    = collect();
        $this->countryId = null;
        $this->city_id    = null;

        $this->genders = Patient::GENDER_SELECT;
        $this->bloodGroups = Patient::BLOOD_GROUP_SELECT;
        $this->refferingTypes = ModelsTravel::REFFERING_TYPE_SELECT;

        $this->campaignChannels = CampaignChannel::get(['id', 'title']);//->pluck('title', 'id');
        $this->campaignOrganizations = collect();
        $this->compaignChannelId = null;
        $this->campaign_org_id = null;

        $this->statuses = TravelStatus::orderBy('ordering','desc')->get(['id', 'title'])->pluck('title', 'id');

        $this->departments = Department::get(['id', 'name'])->pluck('name', 'id');
        $this->department_id = null;

        $this->status_id = null;

    }

    public function updatedCountryId($value)
    {
        $this->cities = Province::where('country_id', $value)->get(['id', 'name']);
        $this->city_id = null;
    }

    public function updatedCompaignChannelId($value)
    {
        $this->campaignOrganizations = CampaignOrg::where('channel_id', $value)->where('status',1)->get(['id', 'title']);
        $this->campaign_org_id = null;
    }

    public function updatedRefferingType($value)
    {
        if(in_array($value, ['Doctor','Ministry','Office']))
            $this->refferingIds = resolve("App\\Models\\$value")::get(['id','name'])->pluck('name','id');  

        $this->reffering = null;
        $this->reffering_other = null;
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

        if ($this->currentStep == 2) {

            $rules = (new StorePatientRequest())->rules();
            $wizardData['Patient'] = $this->validate($rules);
            $this->validate(array_merge($rules, ['reffering' => 'required',
                'reffering' => in_array($this->refferingTypes, ['Doctor','Ministry','Office']) ? 'required' : 'nullable',
            ]));
            //Patient::create($this->validate($rules));
            
        } elseif ($this->currentStep == 1) {
            $rules = (new StoreTravelRequest())->rules();
            $this->validate($rules);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'frameworks' => 'required|array|min:2|max:3'
            ]);
        }
    }

    public function register()
    {
        dd('register');
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validate([
                'cv' => 'required|mimes:doc,docx,pdf|max:1024',
                'terms' => 'accepted'
            ]);
        }

        $cv_name = 'CV_' . $this->cv->getClientOriginalName();
        $upload_cv = $this->cv->storeAs('students_cvs', $cv_name);

        if ($upload_cv) {
            $values = array(
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "gender" => $this->gender,
                "email" => $this->email,
                "phone" => $this->phone,
                "country" => $this->country,
                "city" => $this->city,
                "frameworks" => json_encode($this->frameworks),
                "description" => $this->description,
                "cv" => $cv_name,
            );

            //Student::insert($values);
            $this->reset();
            $this->currentStep = 1;
            $data = ['name' => $this->first_name . ' ' . $this->last_name, 'email' => $this->email];
            return redirect()->route('travel.success', $data);
        }
    }
}
