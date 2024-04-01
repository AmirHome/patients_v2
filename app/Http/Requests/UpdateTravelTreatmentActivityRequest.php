<?php

namespace App\Http\Requests;

use App\Models\TravelTreatmentActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTravelTreatmentActivityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_treatment_activity_edit');
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
            'description' => [
                'required',
            ],
            'files' => [
                'array',
            ],
        ];
    }
}
