<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\Admin\PatientResource;
use App\Models\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientResource(Patient::with(['user', 'office', 'campaign_org', 'city'])->get());
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        if ($request->input('photo', false)) {
            $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('passport_image', false)) {
            $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_image'))))->toMediaCollection('passport_image');
        }

        return (new PatientResource($patient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientResource($patient->load(['user', 'office', 'campaign_org', 'city']));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        if ($request->input('photo', false)) {
            if (! $patient->photo || $request->input('photo') !== $patient->photo->file_name) {
                if ($patient->photo) {
                    $patient->photo->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($patient->photo) {
            $patient->photo->delete();
        }

        if ($request->input('passport_image', false)) {
            if (! $patient->passport_image || $request->input('passport_image') !== $patient->passport_image->file_name) {
                if ($patient->passport_image) {
                    $patient->passport_image->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_image'))))->toMediaCollection('passport_image');
            }
        } elseif ($patient->passport_image) {
            $patient->passport_image->delete();
        }

        return (new PatientResource($patient))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
