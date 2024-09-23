<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_edit');
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
                'nullable',
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
                'nullable',
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
                'nullable',
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
            ],
        ];
    }
}
