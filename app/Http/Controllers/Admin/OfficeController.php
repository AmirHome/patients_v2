<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOfficeRequest;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Models\Office;
use App\Models\Province;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Office::with(['city'])->select(sprintf('%s.*', (new Office)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'office_show';
                $editGate      = 'office_edit';
                $deleteGate    = 'office_delete';
                $crudRoutePart = 'offices';

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
            $table->editColumn('fax', function ($row) {
                return $row->fax ? $row->fax : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'city']);

            return $table->make(true);
        }

        return view('admin.offices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('office_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.offices.create', compact('cities'));
    }

    public function store(StoreOfficeRequest $request)
    {
        $office = Office::create($request->all());

        return redirect()->route('admin.offices.index');
    }

    public function edit(Office $office)
    {
        abort_if(Gate::denies('office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $office->load('city');

        return view('admin.offices.edit', compact('cities', 'office'));
    }

    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $office->update($request->all());

        return redirect()->route('admin.offices.index');
    }

    public function show(Office $office)
    {
        abort_if(Gate::denies('office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office->load('city', 'officePatients');

        return view('admin.offices.show', compact('office'));
    }

    public function destroy(Office $office)
    {
        abort_if(Gate::denies('office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfficeRequest $request)
    {
        $offices = Office::find(request('ids'));

        foreach ($offices as $office) {
            $office->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
