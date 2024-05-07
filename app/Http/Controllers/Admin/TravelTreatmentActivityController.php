<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTravelTreatmentActivityRequest;
use App\Http\Requests\StoreTravelTreatmentActivityRequest;
use App\Http\Requests\UpdateTravelTreatmentActivityRequest;
use App\Models\Travel;
use App\Models\TravelStatus;
use App\Models\TravelTreatmentActivity;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TravelTreatmentActivityController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_treatment_activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TravelTreatmentActivity::with(['user', 'travel', 'status'])->select(sprintf('%s.*', (new TravelTreatmentActivity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_treatment_activity_show';
                $editGate      = 'travel_treatment_activity_edit';
                $deleteGate    = 'travel_treatment_activity_delete';
                $crudRoutePart = 'travel-treatment-activities';

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

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->addColumn('travel_reffering_type', function ($row) {
                return $row->travel ? $row->travel->reffering_type : '';
            });

            $table->editColumn('travel.reffering', function ($row) {
                return $row->travel ? (is_string($row->travel) ? $row->travel : $row->travel->reffering) : '';
            });
            $table->addColumn('status_title', function ($row) {
                return $row->status ? $row->status->title : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'travel', 'status']);

            return $table->make(true);
        }

        return view('admin.travelTreatmentActivities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('travel_treatment_activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel = Travel::pluck('reffering_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.travelTreatmentActivities.create', compact('statuses', 'travel', 'users'));
    }

    public function store(StoreTravelTreatmentActivityRequest $request)
    {
        $travelTreatmentActivity = TravelTreatmentActivity::create($request->all());

        foreach ($request->input('treatment_file', []) as $file) {
            $travelTreatmentActivity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('treatment_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $travelTreatmentActivity->id]);
        }

        return redirect()->route('admin.travel-treatment-activities.index');
    }

    public function edit(TravelTreatmentActivity $travelTreatmentActivity)
    {
        abort_if(Gate::denies('travel_treatment_activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel = Travel::pluck('reffering_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travelTreatmentActivity->load('user', 'travel', 'status');

        return view('admin.travelTreatmentActivities.edit', compact('statuses', 'travel', 'travelTreatmentActivity', 'users'));
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

        return redirect()->route('admin.travel-treatment-activities.index');
    }

    public function show(TravelTreatmentActivity $travelTreatmentActivity)
    {
        abort_if(Gate::denies('travel_treatment_activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelTreatmentActivity->load('user', 'travel', 'status');

        return view('admin.travelTreatmentActivities.show', compact('travelTreatmentActivity'));
    }

    public function destroy(TravelTreatmentActivity $travelTreatmentActivity)
    {
        abort_if(Gate::denies('travel_treatment_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelTreatmentActivity->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelTreatmentActivityRequest $request)
    {
        $travelTreatmentActivities = TravelTreatmentActivity::find(request('ids'));

        foreach ($travelTreatmentActivities as $travelTreatmentActivity) {
            $travelTreatmentActivity->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('travel_treatment_activity_create') && Gate::denies('travel_treatment_activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TravelTreatmentActivity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
