<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelStatusRequest;
use App\Http\Requests\StoreTravelStatusRequest;
use App\Http\Requests\UpdateTravelStatusRequest;
use App\Models\TravelStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TravelStatusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TravelStatus::query()->select(sprintf('%s.*', (new TravelStatus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_status_show';
                $editGate      = 'travel_status_edit';
                $deleteGate    = 'travel_status_delete';
                $crudRoutePart = 'travel-statuses';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('ordering', function ($row) {
                return $row->ordering ? $row->ordering : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.travelStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('travel_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelStatuses.create');
    }

    public function store(StoreTravelStatusRequest $request)
    {
        $travelStatus = TravelStatus::create($request->all());

        return redirect()->route('admin.travel-statuses.index');
    }

    public function edit(TravelStatus $travelStatus)
    {
        abort_if(Gate::denies('travel_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelStatuses.edit', compact('travelStatus'));
    }

    public function update(UpdateTravelStatusRequest $request, TravelStatus $travelStatus)
    {
        $travelStatus->update($request->all());

        return redirect()->route('admin.travel-statuses.index');
    }

    public function show(TravelStatus $travelStatus)
    {
        abort_if(Gate::denies('travel_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelStatus->load('statusActivities', 'statusTravelTreatmentActivities', 'lastStatusTravels');

        return view('admin.travelStatuses.show', compact('travelStatus'));
    }

    public function destroy(TravelStatus $travelStatus)
    {
        abort_if(Gate::denies('travel_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelStatusRequest $request)
    {
        $travelStatuses = TravelStatus::find(request('ids'));

        foreach ($travelStatuses as $travelStatus) {
            $travelStatus->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
