<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\CampaignOrg;
use App\Models\Office;
use App\Models\Patient;
use App\Models\Province;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Patient::with(['user', 'office', 'campaign_org', 'city'])->select(sprintf('%s.*', (new Patient)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patient_show';
                $editGate      = 'patient_edit';
                $deleteGate    = 'patient_delete';
                $crudRoutePart = 'patients';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('office_name', function ($row) {
                return $row->office ? $row->office->name : '';
            });

            $table->addColumn('campaign_org_title', function ($row) {
                return $row->campaign_org ? $row->campaign_org->title : '';
            });

            $table->editColumn('campaign_org.started_at', function ($row) {
                return $row->campaign_org ? (is_string($row->campaign_org) ? $row->campaign_org : $row->campaign_org->started_at) : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : '';
            });
            $table->editColumn('surname', function ($row) {
                return $row->surname ? $row->surname : '';
            });
            $table->editColumn('mother_name', function ($row) {
                return $row->mother_name ? $row->mother_name : '';
            });
            $table->editColumn('father_name', function ($row) {
                return $row->father_name ? $row->father_name : '';
            });
            $table->editColumn('citizenship', function ($row) {
                return $row->citizenship ? $row->citizenship : '';
            });
            $table->editColumn('passport_no', function ($row) {
                return $row->passport_no ? $row->passport_no : '';
            });
            $table->editColumn('passport_origin', function ($row) {
                return $row->passport_origin ? $row->passport_origin : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('foriegn_phone', function ($row) {
                return $row->foriegn_phone ? $row->foriegn_phone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? Patient::GENDER_SELECT[$row->gender] : '';
            });

            $table->editColumn('birth_place', function ($row) {
                return $row->birth_place ? $row->birth_place : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('weight', function ($row) {
                return $row->weight ? $row->weight : '';
            });
            $table->editColumn('height', function ($row) {
                return $row->height ? $row->height : '';
            });
            $table->editColumn('blood_group', function ($row) {
                return $row->blood_group ? Patient::BLOOD_GROUP_SELECT[$row->blood_group] : '';
            });
            $table->editColumn('treating_doctor', function ($row) {
                return $row->treating_doctor ? $row->treating_doctor : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('passport_image', function ($row) {
                if ($photo = $row->passport_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'office', 'campaign_org', 'city', 'photo', 'passport_image']);

            return $table->make(true);
        }

        return view('admin.patients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $offices = Office::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaign_orgs = CampaignOrg::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.patients.create', compact('campaign_orgs', 'cities', 'offices', 'users'));
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        if ($request->input('photo', false)) {
            $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo', 'patient_photos');
        }

        if ($request->input('passport_image', false)) {
            $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_image'))))->toMediaCollection('passport_image', 'patient_photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $patient->id]);
        }

        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $offices = Office::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaign_orgs = CampaignOrg::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patient->load('user', 'office', 'campaign_org', 'city');

        return view('admin.patients.edit', compact('campaign_orgs', 'cities', 'offices', 'patient', 'users'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        if ($request->input('photo', false)) {
            if (! $patient->photo || $request->input('photo') !== $patient->photo->file_name) {
                if ($patient->photo) {
                    $patient->photo->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo', 'patient_photos');
            }
        } elseif ($patient->photo) {
            $patient->photo->delete();
        }

        if ($request->input('passport_image', false)) {
            if (! $patient->passport_image || $request->input('passport_image') !== $patient->passport_image->file_name) {
                if ($patient->passport_image) {
                    $patient->passport_image->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_image'))))->toMediaCollection('passport_image', 'patient_photos');
            }
        } elseif ($patient->passport_image) {
            $patient->passport_image->delete();
        }

        return redirect()->route('admin.patients.index');
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('user', 'office', 'campaign_org', 'city', 'patientTravels');

        return view('admin.patients.show', compact('patient'));
    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientRequest $request)
    {
        $patients = Patient::find(request('ids'));

        foreach ($patients as $patient) {
            $patient->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('patient_create') && Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Patient();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
