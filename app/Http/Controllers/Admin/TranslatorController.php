<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTranslatorRequest;
use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;
use App\Models\Province;
use App\Models\Translator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TranslatorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('translator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Translator::with(['city'])->select(sprintf('%s.*', (new Translator)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'translator_show';
                $editGate      = 'translator_edit';
                $deleteGate    = 'translator_delete';
                $crudRoutePart = 'translators';

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
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'city']);

            return $table->make(true);
        }
    
        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.translators.index', compact('cities'));
    }

    public function create()
    {
        abort_if(Gate::denies('translator_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.translators.create', compact('cities'));
    }

    public function store(StoreTranslatorRequest $request)
    {
        $translator = Translator::create($request->all());

        return redirect()->route('admin.translators.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(Translator $translator)
    {
        abort_if(Gate::denies('translator_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $translator->load('city');

        return view('admin.translators.edit', compact('cities', 'translator'));
    }

    public function update(UpdateTranslatorRequest $request, Translator $translator)
    {
        $translator->update($request->all());

        return redirect()->route('admin.translators.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(Translator $translator)
    {
        abort_if(Gate::denies('translator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $translator->load('city');

        return view('admin.translators.show', compact('translator'));
    }

    public function destroy(Translator $translator)
    {
        abort_if(Gate::denies('translator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $translator->delete();

        return back();
    }

    public function massDestroy(MassDestroyTranslatorRequest $request)
    {
        $translators = Translator::find(request('ids'));

        foreach ($translators as $translator) {
            $translator->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
