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
                'nullable',
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
                'nullable',
            ],
            'surname' => [
                'string',
                'required',
            ],
            'mother_name' => [
                'string',
                'nullable',
            ],
            'father_name' => [
                'string',
                'nullable',
            ],
            'citizenship' => [
                'string',
                'nullable',
            ],
            'passport_no' => [
                'string',
                'required',
            ],
            'passport_origin' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'foriegn_phone' => [
                'string',
                'nullable',
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
                'nullable',
            ],
            'address' => [
                'nullable',
            ],
            'weight' => [
                'numeric',
                'nullable',
            ],
            'height' => [
                'numeric',
                'nullable',
            ],
            'treating_doctor' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                // 'required',
            ],
        ];
    }
}
