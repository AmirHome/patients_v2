<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyActivityRequest;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Travel;
use App\Models\TravelTreatmentStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{
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
            $table->addColumn('travel_status', function ($row) {
                return $row->travel ? $row->travel->status : '';
            });

            $table->editColumn('travel.attendant_name', function ($row) {
                return $row->travel ? (is_string($row->travel) ? $row->travel : $row->travel->attendant_name) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('status_title', function ($row) {
                return $row->status ? $row->status->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'travel', 'status']);

            return $table->make(true);
        }

        return view('admin.activities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel = Travel::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TravelTreatmentStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.activities.create', compact('statuses', 'travel', 'users'));
    }

    public function store(StoreActivityRequest $request)
    {
        $activity = Activity::create($request->all());

        return redirect()->route('admin.activities.index');
    }

    public function edit(Activity $activity)
    {
        abort_if(Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $travel = Travel::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TravelTreatmentStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activity->load('user', 'travel', 'status');

        return view('admin.activities.edit', compact('activity', 'statuses', 'travel', 'users'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());

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
}
