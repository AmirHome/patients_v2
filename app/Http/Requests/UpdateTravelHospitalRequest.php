<?php

namespace App\Http\Requests;

use App\Models\TravelHospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTravelHospitalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_hospital_edit');
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
