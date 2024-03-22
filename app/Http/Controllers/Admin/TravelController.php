<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelRequest;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Models\Department;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Travel;
use App\Models\TravelGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TravelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Travel::with(['patient', 'group', 'hospital', 'department'])->select(sprintf('%s.*', (new Travel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_show';
                $editGate      = 'travel_edit';
                $deleteGate    = 'travel_delete';
                $crudRoutePart = 'travels';

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
            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? $row->patient->name : '';
            });

            $table->editColumn('patient.middle_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->middle_name) : '';
            });
            $table->editColumn('patient.surname', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->surname) : '';
            });
            $table->editColumn('patient.code', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->code) : '';
            });
            $table->addColumn('group_name', function ($row) {
                return $row->group ? $row->group->name : '';
            });

            $table->addColumn('hospital_name', function ($row) {
                return $row->hospital ? $row->hospital->name : '';
            });

            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Travel::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('attendant_name', function ($row) {
                return $row->attendant_name ? $row->attendant_name : '';
            });
            $table->editColumn('attendant_address', function ($row) {
                return $row->attendant_address ? $row->attendant_address : '';
            });
            $table->editColumn('attendant_phone', function ($row) {
                return $row->attendant_phone ? $row->attendant_phone : '';
            });
            $table->editColumn('has_pestilence', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->has_pestilence ? 'checked' : null) . '>';
            });
            $table->editColumn('hospital_mail_notify', function ($row) {
                return $row->hospital_mail_notify ? $row->hospital_mail_notify : '';
            });
            $table->editColumn('reffering', function ($row) {
                return $row->reffering ? $row->reffering : '';
            });
            $table->editColumn('reffering_type', function ($row) {
                return $row->reffering_type ? $row->reffering_type : '';
            });
            $table->editColumn('reffering_other', function ($row) {
                return $row->reffering_other ? $row->reffering_other : '';
            });

            $table->editColumn('wants_shopping', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->wants_shopping ? 'checked' : null) . '>';
            });
            $table->editColumn('visa_status', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->visa_status ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'group', 'hospital', 'department', 'has_pestilence', 'wants_shopping', 'visa_status']);

            return $table->make(true);
        }

        return view('admin.travels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('travel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = TravelGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.travels.create', compact('departments', 'groups', 'hospitals', 'patients'));
    }

    public function store(StoreTravelRequest $request)
    {
        $travel = Travel::create($request->all());

        return redirect()->route('admin.travels.index');
    }

    public function edit(Travel $travel)
    {
        abort_if(Gate::denies('travel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = TravelGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel->load('patient', 'group', 'hospital', 'department');

        return view('admin.travels.edit', compact('departments', 'groups', 'hospitals', 'patients', 'travel'));
    }

    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        $travel->update($request->all());

        return redirect()->route('admin.travels.index');
    }

    public function show(Travel $travel)
    {
        abort_if(Gate::denies('travel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travel->load('patient', 'group', 'hospital', 'department');

        return view('admin.travels.show', compact('travel'));
    }

    public function destroy(Travel $travel)
    {
        abort_if(Gate::denies('travel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travel->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelRequest $request)
    {
        $travels = Travel::find(request('ids'));

        foreach ($travels as $travel) {
            $travel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
