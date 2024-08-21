<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMinistryRequest;
use App\Http\Requests\StoreMinistryRequest;
use App\Http\Requests\UpdateMinistryRequest;
use App\Models\Ministry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MinistriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('ministry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ministry::query()->select(sprintf('%s.*', (new Ministry)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ministry_show';
                $editGate      = 'ministry_edit';
                $deleteGate    = 'ministry_delete';
                $crudRoutePart = 'ministries';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('code_inc', function ($row) {
                return $row->code_inc ? $row->code_inc : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.ministries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ministry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ministries.create');
    }

    public function store(StoreMinistryRequest $request)
    {
        $ministry = Ministry::create($request->all());

        return redirect()->route('admin.ministries.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(Ministry $ministry)
    {
        abort_if(Gate::denies('ministry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ministries.edit', compact('ministry'));
    }

    public function update(UpdateMinistryRequest $request, Ministry $ministry)
    {
        $ministry->update($request->all());

        return redirect()->route('admin.ministries.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(Ministry $ministry)
    {
        abort_if(Gate::denies('ministry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ministries.show', compact('ministry'));
    }

    public function destroy(Ministry $ministry)
    {
        abort_if(Gate::denies('ministry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministry->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinistryRequest $request)
    {
        $ministries = Ministry::find(request('ids'));

        foreach ($ministries as $ministry) {
            $ministry->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
