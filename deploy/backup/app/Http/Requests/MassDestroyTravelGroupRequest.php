<?php

namespace App\Http\Requests;

use App\Models\TravelGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTravelGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('travel_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:travel_groups,id',
        ];
    }
}
