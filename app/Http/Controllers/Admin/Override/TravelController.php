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
use App\Models\Translator;
use App\Models\TravelTreatmentActivity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;


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

        return view('admin.travels.index', $data);
    }

    public function shares($code)
    {
  
        $travel = checkShareCode($code, 'share_hospital');
        
        $travel = Travel::find($travel)
                    ->load('patient', 'group', 'hospital', 'department', 'last_status',
                            'notify_hospitals',
                            'travelTravelTreatmentActivities.status', 'travelTravelTreatmentActivities.user',
                    )
                    ;
        return view('admin.travels.share', compact('travel'));
    }

    public function share($code)
    {
  
        $id = checkShareCode($code, 'share_translator');
        
        $travel = Travel::with(['patient', 'group', 'hospital', 'department', 'last_status',
        'travelTravelTreatmentActivities'=>function($query) use($id){
            $query->where('id', $id);
        }])
        ->whereHas('travelTravelTreatmentActivities', function ($query) use ($id){
            $query->where('id', $id);
        })
        // ->load('patient', 'group', 'hospital', 'department', 'last_status',
        //         'notify_hospitals',
        //         'travelTravelTreatmentActivities.status', 'travelTravelTreatmentActivities.user',
        // )
        ->first();
        ;
        //dd( $code , $id, $data, $travel);

        return view('admin.travels.share', compact('travel'));
    }


}
