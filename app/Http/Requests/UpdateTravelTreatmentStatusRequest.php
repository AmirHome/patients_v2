<?php

namespace App\Http\Requests;

use App\Models\TravelTreatmentStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTravelTreatmentStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_treatment_status_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:travel_treatment_statuses,title,' . request()->route('travel_treatment_status')->id,
            ],
        ];
    }
}
