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
    public $files = [];
    public $document_files = [];
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

            $rules = array_merge((new StoreTravelRequest())->rules(), (new StoreTravelTreatmentActivityRequest())->rules());

            // Fill later
            $rules['patient_id'] = ['nullable'];
            $rules['travel_id'] = ['nullable'];

            // For store dont need
            $rules['attendant_name'] = ['nullable'];
            $rules['attendant_phone'] = ['nullable'];
            $rules['has_pestilence'] = ['nullable'];
            $rules['group_id'] = ['nullable'];
            $rules['hospital_id'] = ['nullable'];
            $rules['wants_shopping'] = ['nullable'];

            dd( $rules, $this->all(), (new StoreTravelRequest())->rules(), (new StoreTravelTreatmentActivityRequest())->rules());
            $data = $this->validate($rules);

            $this->wizardData['Patient'] = array_diff_key($data, array_flip(['reffering_type', 'reffering']));
            $this->wizardData['Travel'] = array_intersect_key($data, array_flip(['reffering_type', 'reffering']));

            $this->wizardData['Travel'] = $this->validate($rules);
            $this->wizardData['TravelTreatmentActivity'] = $this->validate($rules);

        } elseif ($this->currentStep == 3) {
            // $this->validate([
            //     'frameworks' => 'required|array|min:2|max:3'
            // ]);

        } elseif ($this->currentStep == 4) {
            $this->validate([
                'cv' => 'required|mimes:doc,docx,pdf|max:1024',
                'terms' => 'accepted'
            ]);
        }

        if($this->currentStep == $this->totalSteps){
            $this->store();
        }
    }

    public function store()
    {
        
        $this->resetErrorBag();
        // if ($this->currentStep == 4) {
        //     $this->validate([
        //         'cv' => 'required|mimes:doc,docx,pdf|max:1024',
        //         'terms' => 'accepted'
        //     ]);
        // }

        // $cv_name = 'CV_' . $this->cv->getClientOriginalName();
        // $files_name = 'CV_' . $this->files[0]->getClientOriginalName();
        
        // dd('register', $cv_name, $files_name);
        // $upload_cv = $this->cv->storeAs('students_cvs', $cv_name);

        DB::beginTransaction();
        try {
            $patient = Patient::create($this->wizardData['Patient']);

            $travel = ModelsTravel::create($this->wizardData['Travel']);

            $travelTreatmentActivity = TravelTreatmentActivity::create($this->wizardData['TravelTreatmentActivity']);
            foreach ($this->document_files as $file) {
                $travelTreatmentActivity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }



            // $values = array(
            //     "first_name" => $this->first_name,
            //     "last_name" => $this->last_name,
            //     "gender" => $this->gender,
            //     "email" => $this->email,
            //     "phone" => $this->phone,
            //     "country" => $this->country,
            //     "city" => $this->city,
            //     "frameworks" => json_encode($this->frameworks),
            //     "description" => $this->description,
            //     "cv" => $cv_name,
            // );

            //Student::insert($values);
            $this->reset();
            $this->currentStep = 1;
            $data = ['name' => $this->first_name . ' ' . $this->last_name, 'email' => $this->email];
            return redirect()->route('travel.success', $data);
        
    }
}
