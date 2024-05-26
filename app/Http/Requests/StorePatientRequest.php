<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_create');
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
            'office_id' => [
                'required',
                'integer',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'required',
            ],
            'surname' => [
                'string',
                'required',
            ],
            'mother_name' => [
                'string',
                'required',
            ],
            'father_name' => [
                'string',
                'required',
            ],
            'citizenship' => [
                'string',
                'required',
            ],
            'passport_no' => [
                'string',
                'required',
            ],
            'passport_origin' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'foriegn_phone' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'gender' => [
                'required',
            ],
            'birthday' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'birth_place' => [
                'string',
                'required',
            ],
            'address' => [
                'required',
            ],
            'weight' => [
                'numeric',
                'required',
            ],
            'height' => [
                'numeric',
                'required',
            ],
            'treating_doctor' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
