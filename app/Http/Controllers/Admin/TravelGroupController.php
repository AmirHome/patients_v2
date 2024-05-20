<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelGroupRequest;
use App\Http\Requests\StoreTravelGroupRequest;
use App\Http\Requests\UpdateTravelGroupRequest;
use App\Models\TravelGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('travel_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelGroups = TravelGroup::all();

        return view('admin.travelGroups.index', compact('travelGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('travel_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelGroups.create');
    }

    public function store(StoreTravelGroupRequest $request)
    {
        $travelGroup = TravelGroup::create($request->all());

        return redirect()->route('admin.travel-groups.index');
    }

    public function edit(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelGroups.edit', compact('travelGroup'));
    }

    public function update(UpdateTravelGroupRequest $request, TravelGroup $travelGroup)
    {
        $travelGroup->update($request->all());

        return redirect()->route('admin.travel-groups.index');
    }

    public function show(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelGroup->load('groupTravels.patient', 'groupTravels.group', 'groupTravels.hospital',
            'groupTravels.department',
            'groupTravels.last_status', 
            'groupTravels.notify_hospitals'
        );

        return view('admin.travelGroups.show', compact('travelGroup'));
    }

    public function destroy(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelGroupRequest $request)
    {
        $travelGroups = TravelGroup::find(request('ids'));

        foreach ($travelGroups as $travelGroup) {
            $travelGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
