<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelTreatmentStatusRequest;
use App\Http\Requests\StoreTravelTreatmentStatusRequest;
use App\Http\Requests\UpdateTravelTreatmentStatusRequest;
use App\Models\TravelTreatmentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TravelTreatmentStatusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_treatment_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TravelTreatmentStatus::query()->select(sprintf('%s.*', (new TravelTreatmentStatus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_treatment_status_show';
                $editGate      = 'travel_treatment_status_edit';
                $deleteGate    = 'travel_treatment_status_delete';
                $crudRoutePart = 'travel-treatment-statuses';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.travelTreatmentStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('travel_treatment_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelTreatmentStatuses.create');
    }

    public function store(StoreTravelTreatmentStatusRequest $request)
    {
        $travelTreatmentStatus = TravelTreatmentStatus::create($request->all());

        return redirect()->route('admin.travel-treatment-statuses.index');
    }

    public function edit(TravelTreatmentStatus $travelTreatmentStatus)
    {
        abort_if(Gate::denies('travel_treatment_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelTreatmentStatuses.edit', compact('travelTreatmentStatus'));
    }

    public function update(UpdateTravelTreatmentStatusRequest $request, TravelTreatmentStatus $travelTreatmentStatus)
    {
        $travelTreatmentStatus->update($request->all());

        return redirect()->route('admin.travel-treatment-statuses.index');
    }

    public function show(TravelTreatmentStatus $travelTreatmentStatus)
    {
        abort_if(Gate::denies('travel_treatment_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelTreatmentStatus->load('statusTravelTreatmentActivities');

        return view('admin.travelTreatmentStatuses.show', compact('travelTreatmentStatus'));
    }

    public function destroy(TravelTreatmentStatus $travelTreatmentStatus)
    {
        abort_if(Gate::denies('travel_treatment_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelTreatmentStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelTreatmentStatusRequest $request)
    {
        $travelTreatmentStatuses = TravelTreatmentStatus::find(request('ids'));

        foreach ($travelTreatmentStatuses as $travelTreatmentStatus) {
            $travelTreatmentStatus->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
