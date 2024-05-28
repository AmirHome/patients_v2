<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Travel;
use App\Models\TravelGroup;
use App\Models\TravelHospital;
use App\Models\TravelStatus;
use DateTime;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TravelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($limit = null): void
    {

        $rows = DB::connection('conversion_db')->table('travels');
        if (isset($limit)) {
            $rows = $rows->where('patient_id', Patient::pluck('id')->toArray())->limit($limit);
        }
        $rows = $rows->get();

        //dd($rows, Patient::pluck('id')->toArray());

        foreach ($rows as $key => $row) {

            $hospitalizationDate = $row->hospitalization_date;
            $planningDischargeDate = $row->planning_discharge_date;
            $arrivalDate = $row->arrival_date;
            $departureDate = $row->departure_date;
            $visaStartDate = $row->visa_start_date;
            $visaEndDate = $row->visa_end_date;

            try {
                if ($hospitalizationDate !== '0000-00-00') {
                    $date = new DateTime($hospitalizationDate);

                    $hospitalizationDate = $date->format('Y-m-d');
                } else {
                    $hospitalizationDate = null;
                }
            } catch (Exception $e) {
                $hospitalizationDate = null;
            }

            try {
                if ($planningDischargeDate !== '0000-00-00') {
                    $date = new DateTime($planningDischargeDate);

                    $planningDischargeDate = $date->format('Y-m-d');
                } else {
                    $planningDischargeDate = null;
                }
            } catch (Exception $e) {
                $planningDischargeDate = null;
            }

            try {
                if ($arrivalDate !== '0000-00-00') {
                    $date = new DateTime($arrivalDate);

                    $arrivalDate = $date->format('Y-m-d');
                } else {
                    $arrivalDate = null;
                }
            } catch (Exception $e) {
                $arrivalDate = null;
            }

            try {
                if ($departureDate !== '0000-00-00') {
                    $date = new DateTime($departureDate);

                    $departureDate = $date->format('Y-m-d');
                } else {
                    $departureDate = null;
                }
            } catch (Exception $e) {
                $departureDate = null;
            }

            try {
                if ($visaStartDate !== '0000-00-00') {
                    $date = new DateTime($visaStartDate);

                    $visaStartDate = $date->format('Y-m-d');
                } else {
                    $visaStartDate = null;
                }
            } catch (Exception $e) {
                $visaStartDate = null;
            }

            try {
                if ($visaEndDate !== '0000-00-00') {
                    $date = new DateTime($visaEndDate);

                    $visaEndDate = $date->format('Y-m-d');
                } else {
                    $visaEndDate = null;
                }
            } catch (Exception $e) {
                $visaEndDate = null;
            }

            $status = $row->status == 0 ? 21 : $row->status;
            $travel = Travel::updateOrCreate(['id' => $row->id], [
                'patient_id'     => Patient::where('id', $row->patient_id)->first()->id,
                'group_id'       => TravelGroup::where('id', $row->group_id)->first()->id ?? 2,
                'hospital_id'    => Hospital::where('id', $row->hospital_id)->first()->id ?? 1,
                'department_id'  => Department::where('id', $row->department_id)->first()->id ?? null,
                'last_status_id'      => TravelStatus::where('id', $status)->first()->id ?? null,
                'attendant_name' => $row->attendant_name,
                'attendant_address' => $row->attendant_address,
                'attendant_phone' => $row->attendant_phone,
                'has_pestilence' => $row->has_pestilence,
                //'notify_hospitals' => $row->hospital_mail_notify,
                'hospital_mail_notify' => $row->hospital_mail_id,
                'reffering'      => (in_array($row->reffering_type, ['App\Models\Fond', 'App\Models\Other']) ? $row->reffering_other : $row->reffering_id),
                'reffering_type' => refferingType($row->reffering_type),
                // GUIDE: Remove reffering_other and use reffering_id instead of it
                // 'reffering_other' => $row->reffering_other,
                'hospitalization_date' => $hospitalizationDate,
                'planning_discharge_date' => $planningDischargeDate,
                'arrival_date'   => $arrivalDate,
                'departure_date' => $departureDate,
                'wants_shopping' => $row->wants_shopping,
                'visa_status'    => $row->visa_status,
                'visa_start_date' => $visaStartDate,
                'visa_end_date'  => $visaEndDate,


                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
                'deleted_at'     => $row->deleted_at,
            ]);


            if (!empty($row->hospital_mail_notify)) {
                $ids = explode(',', $row->hospital_mail_notify);
                $validIds = TravelHospital::pluck('id')->toArray();
                $verifyIds = array_intersect($ids, $validIds);

                if(sort($ids) !== sort($verifyIds)){
                    Log::emergency("Seeder:\nTravelId={$travel->id} TravelHospitalIDs=$row->hospital_mail_notify");
                }

                $travel->notify_hospitals()->sync($verifyIds);
            }
          
        }
    }
}
