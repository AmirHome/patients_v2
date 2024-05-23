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


class TravelController extends ParentController
{
    //use DataTablesFilterTrait;

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
