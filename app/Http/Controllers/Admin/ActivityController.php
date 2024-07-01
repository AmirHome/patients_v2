<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyActivityRequest;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Travel;
use App\Models\TravelStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Activity::with(['user', 'travel', 'status'])->select(sprintf('%s.*', (new Activity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'activity_show';
                $editGate      = 'activity_edit';
                $deleteGate    = 'activity_delete';
                $crudRoutePart = 'activities';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('status_title', function ($row) {
                return $row->status ? $row->status->title : '';
            });

            $table->editColumn('document_file', function ($row) {
                if (! $row->document_file) {
                    return '';
                }
                $links = [];
                foreach ($row->document_file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('document_name', function ($row) {
                return $row->document_name ? $row->document_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'travel', 'status', 'document_file']);

            return $table->make(true);
        }

        return view('admin.activities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel = Travel::pluck('reffering_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.activities.create', compact('statuses', 'travel', 'users'));
    }

    public function store(StoreActivityRequest $request)
    {
        $activity = Activity::create($request->all());

        foreach ($request->input('document_file', []) as $file) {
            $activity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $activity->id]);
        }

        return redirect()->back();
        // return redirect()->route('admin.activities.index');
    }

    public function edit(Activity $activity)
    {
        abort_if(Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel = Travel::pluck('reffering_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activity->load('user', 'travel', 'status');

        return view('admin.activities.edit', compact('activity', 'statuses', 'travel', 'users'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());

        if (count($activity->document_file) > 0) {
            foreach ($activity->document_file as $media) {
                if (! in_array($media->file_name, $request->input('document_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $activity->document_file->pluck('file_name')->toArray();
        foreach ($request->input('document_file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $activity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
            }
        }

        return redirect()->route('admin.activities.index');
    }

    public function show(Activity $activity)
    {
        abort_if(Gate::denies('activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activity->load('user', 'travel', 'status');

        return view('admin.activities.show', compact('activity'));
    }

    public function destroy(Activity $activity)
    {
        abort_if(Gate::denies('activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activity->delete();

        return back();
    }

    public function massDestroy(MassDestroyActivityRequest $request)
    {
        $activities = Activity::find(request('ids'));

        foreach ($activities as $activity) {
            $activity->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('activity_create') && Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Activity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
