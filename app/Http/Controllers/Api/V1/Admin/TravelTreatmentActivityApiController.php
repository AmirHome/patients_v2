<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTravelTreatmentActivityRequest;
use App\Http\Requests\UpdateTravelTreatmentActivityRequest;
use App\Http\Resources\Admin\TravelTreatmentActivityResource;
use App\Models\TravelTreatmentActivity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelTreatmentActivityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('travel_treatment_activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelTreatmentActivityResource(TravelTreatmentActivity::with(['user', 'travel', 'status'])->get());
    }

    public function store(StoreTravelTreatmentActivityRequest $request)
    {
        $travelTreatmentActivity = TravelTreatmentActivity::create($request->all());

        foreach ($request->input('treatment_file', []) as $file) {
            $travelTreatmentActivity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('treatment_file');
        }

        return (new TravelTreatmentActivityResource($travelTreatmentActivity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TravelTreatmentActivity $travelTreatmentActivity)
    {
        abort_if(Gate::denies('travel_treatment_activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TravelTreatmentActivityResource($travelTreatmentActivity->load(['user', 'travel', 'status']));
    }

    public function update(UpdateTravelTreatmentActivityRequest $request, TravelTreatmentActivity $travelTreatmentActivity)
    {
        $travelTreatmentActivity->update($request->all());

        if (count($travelTreatmentActivity->treatment_file) > 0) {
            foreach ($travelTreatmentActivity->treatment_file as $media) {
                if (! in_array($media->file_name, $request->input('treatment_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $travelTreatmentActivity->treatment_file->pluck('file_name')->toArray();
        foreach ($request->input('treatment_file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $travelTreatmentActivity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('treatment_file');
            }
        }

        return (new TravelTreatmentActivityResource($travelTreatmentActivity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TravelTreatmentActivity $travelTreatmentActivity)
    {
        abort_if(Gate::denies('travel_treatment_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelTreatmentActivity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
