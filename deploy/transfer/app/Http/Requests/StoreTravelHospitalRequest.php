<?php

namespace App\Http\Requests;

use App\Models\TravelHospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTravelHospitalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_hospital_create');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'nullable',
            ],
        ];
    }
}
