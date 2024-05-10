<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelRequest;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Models\Department;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Travel;
use App\Models\TravelGroup;
use App\Models\TravelStatus;
use App\Models\Country;
use App\Models\CampaignChannel;
use App\Models\Translator;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TravelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('travel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Form filters
        $countries = Country::get(['id', 'name']);
        $cities    = collect();
        $genders = Patient::GENDER_SELECT;
        $bloodGroups = Patient::BLOOD_GROUP_SELECT;
        $refferingTypes = Travel::REFFERING_TYPE_SELECT;
        $campaignChannels = CampaignChannel::get(['id', 'title']); //->pluck('title', 'id');
        $campaignOrganizations = collect();
        $statuses = TravelStatus::orderBy('ordering', 'desc')->get(['id', 'title'])->pluck('title', 'id');
        $departments = Department::get(['id', 'name'])->pluck('name', 'id');
        $notify_hospitals = Hospital::get(['id', 'name'])->pluck('name', 'id');
        $translators = Translator::get(['id', 'title'])->pluck('title', 'id');

        if ($request->ajax()) {
            $query = Travel::with(['patient.city.country', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals'])->select(sprintf('%s.*', (new Travel)->table));
            
            // Add custom filter for search_index
            if ($request->has('ff_patient_name')) {
                $value = $request->input('ff_patient_name');
                $query->whereHas('patient', function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('surname', 'like', '%' . $value . '%')
                        ->orWhere('middle_name', 'like', '%' . $value . '%');
                });
            }
            if ($request->has('ff_patient_code')) {
                $value = $request->input('ff_patient_code');
                $query->whereHas('patient', function ($query) use ($value) {
                    $query->where('code', 'like', '%' . $value . '%');
                });
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'travel_show';
                $editGate      = 'travel_edit';
                $deleteGate    = 'travel_delete';
                $crudRoutePart = 'travels';

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
            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? $row->patient->name .' '.  $row->patient->surname: '';
            });

            $table->editColumn('patient.middle_name', function ($row) {
                return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->middle_name) : '';
            });
            // $table->editColumn('patient.surname', function ($row) {
            //     return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->surname) : '';
            // });
            // $table->editColumn('patient.code', function ($row) {
            //     return $row->patient ? (is_string($row->patient) ? $row->patient : $row->patient->code) : '';
            // });
            $table->addColumn('group_name', function ($row) {
                return $row->group ? $row->group->name : '';
            });

            $table->addColumn('hospital_name', function ($row) {
                return $row->hospital ? $row->hospital->name : '';
            });

            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->addColumn('last_status_title', function ($row) {
                return $row->last_status ? $row->last_status->title : '';
            });

            $table->editColumn('last_status.ordering', function ($row) {
                return $row->last_status ? (is_string($row->last_status) ? $row->last_status : $row->last_status->ordering) : '';
            });
            $table->editColumn('attendant_name', function ($row) {
                return $row->attendant_name ? $row->attendant_name : '';
            });
            $table->editColumn('attendant_address', function ($row) {
                return $row->attendant_address ? $row->attendant_address : '';
            });
            $table->editColumn('attendant_phone', function ($row) {
                return $row->attendant_phone ? $row->attendant_phone : '';
            });
            $table->editColumn('has_pestilence', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->has_pestilence ? 'checked' : null) . '>';
            });
            $table->editColumn('hospital_mail_notify', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->hospital_mail_notify ? 'checked' : null) . '>';
            });
            $table->editColumn('notify_hospitals', function ($row) {
                $labels = [];
                foreach ($row->notify_hospitals as $notify_hospital) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $notify_hospital->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('reffering', function ($row) {
                return $row->reffering ? $row->reffering : '';
            });

            $table->editColumn('wants_shopping', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->wants_shopping ? 'checked' : null) . '>';
            });
            $table->editColumn('visa_status', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->visa_status ? 'checked' : null) . '>';
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'group', 'hospital', 'department', 'last_status', 
            'has_pestilence', 'hospital_mail_notify', 'notify_hospitals', 'wants_shopping', 'visa_status']);

            return $table->make(true);
        }

        return view('admin.travels.index', compact('countries', 'cities','genders', 'bloodGroups', 'refferingTypes', 'campaignChannels', 'campaignOrganizations', 'statuses', 'departments', 'notify_hospitals', 'translators'));
    }

    public function create()
    {
        abort_if(Gate::denies('travel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = TravelGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $notify_hospitals = Hospital::pluck('name', 'id');

        return view('admin.travels.create', compact('departments', 'groups', 'hospitals', 'last_statuses', 'notify_hospitals', 'patients'));
    }

    public function store(StoreTravelRequest $request)
    {
        $travel = Travel::create($request->all());
        $travel->notify_hospitals()->sync($request->input('notify_hospitals', []));

        return redirect()->route('admin.travels.index');
    }

    public function edit(Travel $travel)
    {
        abort_if(Gate::denies('travel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = TravelGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $notify_hospitals = Hospital::pluck('name', 'id');

        $travel->load('patient', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals');

        return view('admin.travels.edit', compact('departments', 'groups', 'hospitals', 'last_statuses', 'notify_hospitals', 'patients', 'travel'));
    }

    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        $travel->update($request->all());
        $travel->notify_hospitals()->sync($request->input('notify_hospitals', []));

        return redirect()->route('admin.travels.index');
    }

    public function show(Travel $travel)
    {
        abort_if(Gate::denies('travel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travel->load('patient', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals', 'travelTravelTreatmentActivities', 'travelActivities');

        return view('admin.travels.show', compact('travel'));
    }

    public function destroy(Travel $travel)
    {
        abort_if(Gate::denies('travel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travel->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelRequest $request)
    {
        $travels = Travel::find(request('ids'));

        foreach ($travels as $travel) {
            $travel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
