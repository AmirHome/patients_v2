<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelStatusRequest;
use App\Http\Requests\UpdateTravelStatusRequest;
use App\Http\Resources\Admin\TravelStatusResource;
use App\Models\TravelStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('travel_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelStatusResource(TravelStatus::all());
    }

    public function store(StoreTravelStatusRequest $request)
    {
        $travelStatus = TravelStatus::create($request->all());

        return (new TravelStatusResource($travelStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TravelStatus $travelStatus)
    {
        abort_if(Gate::denies('travel_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelStatusResource($travelStatus);
    }

    public function update(UpdateTravelStatusRequest $request, TravelStatus $travelStatus)
    {
        $travelStatus->update($request->all());

        return (new TravelStatusResource($travelStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TravelStatus $travelStatus)
    {
        abort_if(Gate::denies('travel_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
