<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;
use App\Http\Resources\Admin\TranslatorResource;
use App\Models\Translator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TranslatorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('translator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TranslatorResource(Translator::with(['city'])->get());
    }

    public function store(StoreTranslatorRequest $request)
    {
        $translator = Translator::create($request->all());

        return (new TranslatorResource($translator))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Translator $translator)
    {
        abort_if(Gate::denies('translator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TranslatorResource($translator->load(['city']));
    }

    public function update(UpdateTranslatorRequest $request, Translator $translator)
    {
        $translator->update($request->all());

        return (new TranslatorResource($translator))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Translator $translator)
    {
        abort_if(Gate::denies('translator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $translator->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
