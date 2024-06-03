<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelGroupRequest;
use App\Http\Requests\UpdateTravelGroupRequest;
use App\Http\Resources\Admin\TravelGroupResource;
use App\Models\TravelGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('travel_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelGroupResource(TravelGroup::all());
    }

    public function store(StoreTravelGroupRequest $request)
    {
        $travelGroup = TravelGroup::create($request->all());

        return (new TravelGroupResource($travelGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelGroupResource($travelGroup);
    }

    public function update(UpdateTravelGroupRequest $request, TravelGroup $travelGroup)
    {
        $travelGroup->update($request->all());

        return (new TravelGroupResource($travelGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
