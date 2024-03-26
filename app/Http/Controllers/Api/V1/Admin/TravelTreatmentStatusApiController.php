<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelTreatmentStatusRequest;
use App\Http\Requests\UpdateTravelTreatmentStatusRequest;
use App\Http\Resources\Admin\TravelTreatmentStatusResource;
use App\Models\TravelTreatmentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelTreatmentStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('travel_treatment_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelTreatmentStatusResource(TravelTreatmentStatus::all());
    }

    public function store(StoreTravelTreatmentStatusRequest $request)
    {
        $travelTreatmentStatus = TravelTreatmentStatus::create($request->all());

        return (new TravelTreatmentStatusResource($travelTreatmentStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TravelTreatmentStatus $travelTreatmentStatus)
    {
        abort_if(Gate::denies('travel_treatment_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelTreatmentStatusResource($travelTreatmentStatus);
    }

    public function update(UpdateTravelTreatmentStatusRequest $request, TravelTreatmentStatus $travelTreatmentStatus)
    {
        $travelTreatmentStatus->update($request->all());

        return (new TravelTreatmentStatusResource($travelTreatmentStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TravelTreatmentStatus $travelTreatmentStatus)
    {
        abort_if(Gate::denies('travel_treatment_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelTreatmentStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
