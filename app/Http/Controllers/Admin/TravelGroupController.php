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
use Yajra\DataTables\Facades\DataTables;

class TravelGroupController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TravelGroup::query()->select(sprintf('%s.*', (new TravelGroup)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_group_show';
                $editGate      = 'travel_group_edit';
                $deleteGate    = 'travel_group_delete';
                $crudRoutePart = 'travel-groups';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.travelGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('travel_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelGroups.create');
    }

    public function store(StoreTravelGroupRequest $request)
    {
        $travelGroup = TravelGroup::create($request->all());

        return redirect()->route('admin.travel-groups.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelGroups.edit', compact('travelGroup'));
    }

    public function update(UpdateTravelGroupRequest $request, TravelGroup $travelGroup)
    {
        $travelGroup->update($request->all());

        return redirect()->route('admin.travel-groups.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(TravelGroup $travelGroup)
    {
        abort_if(Gate::denies('travel_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelGroup->load('groupTravels');

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
