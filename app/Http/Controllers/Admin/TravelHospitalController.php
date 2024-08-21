<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelHospitalRequest;
use App\Http\Requests\StoreTravelHospitalRequest;
use App\Http\Requests\UpdateTravelHospitalRequest;
use App\Models\TravelHospital;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TravelHospitalController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TravelHospital::query()->select(sprintf('%s.*', (new TravelHospital)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_hospital_show';
                $editGate      = 'travel_hospital_edit';
                $deleteGate    = 'travel_hospital_delete';
                $crudRoutePart = 'travel-hospitals';

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
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.travelHospitals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('travel_hospital_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelHospitals.create');
    }

    public function store(StoreTravelHospitalRequest $request)
    {
        $travelHospital = TravelHospital::create($request->all());

        return redirect()->route('admin.travel-hospitals.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(TravelHospital $travelHospital)
    {
        abort_if(Gate::denies('travel_hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.travelHospitals.edit', compact('travelHospital'));
    }

    public function update(UpdateTravelHospitalRequest $request, TravelHospital $travelHospital)
    {
        $travelHospital->update($request->all());

        return redirect()->route('admin.travel-hospitals.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(TravelHospital $travelHospital)
    {
        abort_if(Gate::denies('travel_hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelHospital->load('notifyHospitalsTravels');

        return view('admin.travelHospitals.show', compact('travelHospital'));
    }

    public function destroy(TravelHospital $travelHospital)
    {
        abort_if(Gate::denies('travel_hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelHospital->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelHospitalRequest $request)
    {
        $travelHospitals = TravelHospital::find(request('ids'));

        foreach ($travelHospitals as $travelHospital) {
            $travelHospital->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
