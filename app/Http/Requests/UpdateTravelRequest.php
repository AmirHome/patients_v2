<?php

namespace App\Http\Requests;

use App\Models\Travel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTravelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_edit');
    }

    public function rules()
    {
        return [
            'patient_id' => [
                'required',
                'integer',
            ],
            'group_id' => [
                'required',
                'integer',
            ],
            'hospital_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
            'attendant_name' => [
                'string',
                'required',
            ],
            'attendant_phone' => [
                'string',
                'required',
            ],
            'has_pestilence' => [
                'required',
            ],
            'hospital_mail_notify' => [
                'string',
                'nullable',
            ],
            'reffering' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'reffering_type' => [
                'string',
                'required',
            ],
            'reffering_other' => [
                'string',
                'nullable',
            ],
            'hospitalization_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'planning_discharge_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'arrival_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'departure_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'wants_shopping' => [
                'required',
            ],
            'visa_status' => [
                'required',
            ],
            'visa_start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'visa_end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
