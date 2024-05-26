<?php

namespace App\Http\Requests;

use App\Models\TravelTreatmentActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTravelTreatmentActivityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_treatment_activity_create');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'travel_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'treatment_file' => [
                'array',
            ],
        ];
    }
}
