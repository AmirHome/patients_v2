<?php

namespace App\Http\Requests;

use App\Models\TravelGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTravelGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('travel_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'color' => [
                'string',
                'required',
            ],
        ];
    }
}
