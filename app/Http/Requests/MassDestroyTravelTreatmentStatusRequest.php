<?php

namespace App\Http\Requests;

use App\Models\TravelTreatmentStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTravelTreatmentStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('travel_treatment_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:travel_treatment_statuses,id',
        ];
    }
}
