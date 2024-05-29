<?php

namespace App\Http\Requests;

use App\Models\TravelStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTravelStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_status_edit');
    }

    
protected function prepareForValidation(){
            $this->merge([
                'user_id' => auth()->id(),
            ]);
        }

    
public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'ordering' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
