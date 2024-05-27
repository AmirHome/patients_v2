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

class TranslatorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('translator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $translators = Translator::with(['city'])->get();

        return view('admin.translators.index', compact('translators'));
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

        return redirect()->route('admin.translators.index');
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

        return redirect()->route('admin.translators.index');
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
