<?php

namespace App\Http\Requests;

use App\Models\Activity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateActivityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('activity_edit');
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
            'description' => [
                'required',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'document_file' => [
                'array',
                'required',
            ],
            'document_file.*' => [
                'required',
            ],
            'document_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
