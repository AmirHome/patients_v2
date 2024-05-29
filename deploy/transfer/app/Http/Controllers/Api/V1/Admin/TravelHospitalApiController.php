<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelHospitalRequest;
use App\Http\Requests\UpdateTravelHospitalRequest;
use App\Http\Resources\Admin\TravelHospitalResource;
use App\Models\TravelHospital;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelHospitalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('travel_hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelHospitalResource(TravelHospital::with(['team'])->get());
    }

    public function store(StoreTravelHospitalRequest $request)
    {
        $travelHospital = TravelHospital::create($request->all());

        return (new TravelHospitalResource($travelHospital))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TravelHospital $travelHospital)
    {
        abort_if(Gate::denies('travel_hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelHospitalResource($travelHospital->load(['team']));
    }

    public function update(UpdateTravelHospitalRequest $request, TravelHospital $travelHospital)
    {
        $travelHospital->update($request->all());

        return (new TravelHospitalResource($travelHospital))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TravelHospital $travelHospital)
    {
        abort_if(Gate::denies('travel_hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelHospital->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
