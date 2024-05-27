<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Province;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Doctor::with(['city', 'hospital', 'department'])->select(sprintf('%s.*', (new Doctor)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'doctor_show';
                $editGate      = 'doctor_edit';
                $deleteGate    = 'doctor_delete';
                $crudRoutePart = 'doctors';

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
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->addColumn('hospital_name', function ($row) {
                return $row->hospital ? $row->hospital->name : '';
            });

            $table->editColumn('hospital.phone', function ($row) {
                return $row->hospital ? (is_string($row->hospital) ? $row->hospital : $row->hospital->phone) : '';
            });
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            
            $table->rawColumns(['actions', 'placeholder', 'city', 'hospital', 'department']);

            return $table->make(true);
        }

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.doctors.index', compact('cities', 'departments', 'hospitals'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.doctors.create', compact('cities', 'departments', 'hospitals'));
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());

        return redirect()->route('admin.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor->load('city', 'hospital', 'department');

        return view('admin.doctors.edit', compact('cities', 'departments', 'doctor', 'hospitals'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());

        return redirect()->route('admin.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('city', 'hospital', 'department');

        return view('admin.doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        $doctors = Doctor::find(request('ids'));

        foreach ($doctors as $doctor) {
            $doctor->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
