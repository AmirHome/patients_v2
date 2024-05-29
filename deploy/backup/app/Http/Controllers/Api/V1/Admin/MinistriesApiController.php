<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMinistryRequest;
use App\Http\Requests\UpdateMinistryRequest;
use App\Http\Resources\Admin\MinistryResource;
use App\Models\Ministry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinistriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ministry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MinistryResource(Ministry::all());
    }

    public function store(StoreMinistryRequest $request)
    {
        $ministry = Ministry::create($request->all());

        return (new MinistryResource($ministry))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ministry $ministry)
    {
        abort_if(Gate::denies('ministry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MinistryResource($ministry);
    }

    public function update(UpdateMinistryRequest $request, Ministry $ministry)
    {
        $ministry->update($request->all());

        return (new MinistryResource($ministry))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ministry $ministry)
    {
        abort_if(Gate::denies('ministry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministry->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
