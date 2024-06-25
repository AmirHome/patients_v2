<?php

namespace App\Http\Controllers\Admin\Override;

use App\Http\Controllers\Admin\TravelController as ParentController;
use App\Http\Controllers\Traits\DataTablesFilterTrait;
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
use App\Models\CampaignOrg;
use App\Models\Office;
use App\Models\Province;
use App\Models\Translator;
use App\Models\TravelHospital;
use App\Models\TravelTreatmentActivity;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class TravelController extends ParentController
{
    use DataTablesFilterTrait;

    public function index(Request $request)
    {

        abort_if(Gate::denies('travel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = $this->travelFilterMount();

        if ($request->ajax()) {
            $query = Travel::with(['patient.city.country', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals'])->select(sprintf('%s.*', (new Travel)->table));

            $query = $this->travelFilter($request, $query);

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
                return $row->patient ? $row->patient->name . ' ' .  $row->patient->surname : '';
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

            $table->rawColumns([
                'actions', 'placeholder', 'patient', 'group', 'hospital', 'department', 'last_status',
                'has_pestilence', 'hospital_mail_notify', 'notify_hospitals', 'wants_shopping', 'visa_status'
            ]);

            return $table->make(true);
        }

        return view('admin.travels.index', $data);
    }

    public function shares($code)
    {

        $travel = checkShareCode($code, 'share_hospital');

        $travel = Travel::find($travel)
            ->load(
                'patient',
                'group',
                'hospital',
                'department',
                'last_status',
                'notify_hospitals',
                'travelTravelTreatmentActivities.status',
                'travelTravelTreatmentActivities.user',
            );
        return view('admin.travels.share', compact('travel'));
    }

    public function share($code)
    {

        $id = checkShareCode($code, 'share_translator');

        $travel = Travel::with([
            'patient', 'group', 'hospital', 'department', 'last_status',
            'travelTravelTreatmentActivities' => function ($query) use ($id) {
                $query->where('id', $id);
            }
        ])
            ->whereHas('travelTravelTreatmentActivities', function ($query) use ($id) {
                $query->where('id', $id);
            })
            // ->load('patient', 'group', 'hospital', 'department', 'last_status',
            //         'notify_hospitals',
            //         'travelTravelTreatmentActivities.status', 'travelTravelTreatmentActivities.user',
            // )
            ->first();;
        //dd( $code , $id, $data, $travel);

        return view('admin.travels.share', compact('travel'));
    }

    public function edit(Travel $travel)
    {
        abort_if(Gate::denies('travel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = TravelGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_statuses = TravelStatus::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $notify_hospitals = TravelHospital::pluck('title', 'id');


        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $offices = Office::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaign_orgs = CampaignOrg::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patient = Patient::find($travel->patient_id);
        $patient->load('user', 'office', 'campaign_org', 'city');

        $translators = Translator::get(['id', 'title'])->pluck('title', 'id');

        $travel->load('patient', 'group', 'hospital', 'department', 'last_status', 'notify_hospitals');

        return view('admin.travels.edit', compact(
            'departments',
            'groups',
            'hospitals',
            'last_statuses',
            'notify_hospitals',
            'patients',
            'travel',
            'campaign_orgs',
            'cities',
            'offices',
            'patient',
            'translators'
        ));
    }

    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        $request->merge(['patient_id' => $travel->patient_id])->offsetUnset('code'); //->offsetUnset('user_id');
        //dd($request->all());
        $travel->update($request->all());
        $travel->notify_hospitals()->sync($request->input('notify_hospitals', []));
        $patient = Patient::find($travel->patient_id);
        $patient->update($request->all());

        if ($request->input('photo', false)) {
            if (!$patient->photo || $request->input('photo') !== $patient->photo->file_name) {
                if ($patient->photo) {
                    $patient->photo->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($patient->photo) {
            $patient->photo->delete();
        }

        if ($request->input('passport_image', false)) {
            if (!$patient->passport_image || $request->input('passport_image') !== $patient->passport_image->file_name) {
                if ($patient->passport_image) {
                    $patient->passport_image->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_image'))))->toMediaCollection('passport_image');
            }
        } elseif ($patient->passport_image) {
            $patient->passport_image->delete();
        }

        return redirect()->route('admin.travels.index');
    }


    public function ajaxIndexByType($type)
    {
        $refferingIds = null;
        if (in_array($type, ['Doctor', 'Ministry', 'Office'])) {
            $refferingIds = resolve("App\\Models\\$type")::get(['id', 'name'])->pluck('name', 'id');
        }

        return response()->json($refferingIds);
    }
}
