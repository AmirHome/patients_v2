<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_create');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'central_hospital_mail' => [
                'string',
                'required',
            ],
            'central_hospital_mail_cc' => [
                'string',
                'nullable',
            ],
            'central_hospital_mail_bcc' => [
                'string',
                'nullable',
            ],
        ];
    }
}
