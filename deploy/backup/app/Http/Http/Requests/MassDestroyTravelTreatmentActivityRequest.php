<?php

namespace App\Http\Requests;

use App\Models\TravelTreatmentActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTravelTreatmentActivityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('travel_treatment_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:travel_treatment_activities,id',
        ];
    }
}
