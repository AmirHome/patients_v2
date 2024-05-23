<?php

namespace App\Http\Requests;

use App\Models\Translator;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTranslatorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('translator_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
