<?php

namespace App\Livewire;

use App\Http\Requests\StorePatientRequest;
use App\Models\Country;
use App\Models\Province;
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

    // public $size;
    public $countryId;
    public $countries;
    public $cities;

    public function mount()
    {
        $this->countries = Country::get(['id', 'name']);
        $this->cities    = collect();
        $this->countryId = null;
        $this->city_id    = null;

    }

    public function updatedCountryId($value)
    {
        $this->cities = Province::where('country_id', $value)->get(['id', 'name']);
        $this->city_id = null;
    }

    public function __construct()
    {
        $this->user_id = auth()->id();
        $this->office_id = auth()->user()->office_id;
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
            $this->validate($rules);

        } elseif ($this->currentStep == 2) {
            $this->validate([
                'email' => 'required|email|unique:patients',
                'phone' => 'required',
                'country' => 'required',
                'city' => 'required'
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'frameworks' => 'required|array|min:2|max:3'
            ]);
        }
    }

    public function register()
    {
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
            //   $this->reset();
            //   $this->currentStep = 1;
            $data = ['name' => $this->first_name . ' ' . $this->last_name, 'email' => $this->email];
            return redirect()->route('travel.success', $data);
        }
    }
}
