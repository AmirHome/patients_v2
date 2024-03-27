<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'office_id' => [
                'required',
                'integer',
            ],
            'can_see_prices' => [
                'required',
            ],
            'can_set_prices' => [
                'required',
            ],
            'is_super' => [
                'required',
            ],
        ];
    }
}
