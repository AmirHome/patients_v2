<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Http\Resources\Admin\TravelResource;
use App\Models\Travel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('travel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelResource(Travel::with(['patient', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals'])->get());
    }

    public function store(StoreTravelRequest $request)
    {
        $travel = Travel::create($request->all());
        $travel->notify_hospitals()->sync($request->input('notify_hospitals', []));

        return (new TravelResource($travel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Travel $travel)
    {
        abort_if(Gate::denies('travel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelResource($travel->load(['patient', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals']));
    }

    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        $travel->update($request->all());
        $travel->notify_hospitals()->sync($request->input('notify_hospitals', []));

        return (new TravelResource($travel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Travel $travel)
    {
        abort_if(Gate::denies('travel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
