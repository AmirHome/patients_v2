<?php

namespace App\Http\Requests;

use App\Models\Travel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTravelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_create');
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
            'notify_hospitals' => [
                'string',
                'nullable',
            ],
            'hospitalization_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'planning_discharge_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'arrival_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'departure_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'wants_shopping' => [
                'required',
            ],
            'visa_status' => [
                'required',
            ],
            'visa_start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'visa_end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
