<?php

namespace Database\Seeders;

use App\Models\CampaignOrg;
use App\Models\Office;
use App\Models\Patient;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Exception;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($limit=null): void
    {

        $chunkSize = 1000;

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Patient::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::connection('conversion_db')->table('patients')->orderByDesc('id')->chunk($rows = $chunkSize, function ($rows) use (&$limit) {
            $this->insertPatients($rows, $limit);
        });
        
    }

    private function insertPatients($rows, &$limit=null){
        foreach ($rows as $key => $row) {

            if(isset($limit) && ($limit-- < 0)) {break;};

            $birthDate = $row->birth_date;
            try {
                if ($birthDate !== '0000-00-00') {
                    $date = new DateTime($birthDate);

                    $birthDate = $date->format('Y-m-d');
                } else {
                    $birthDate = null;
                }
            } catch (Exception $e) {
                $birthDate = null;
            }

            Patient::create([
                'id'             => $row->id,
                'user_id'        => User::where('id', $row->user_id)->first()->id,
                'office_id'      => Office::where('id', $row->office_id)->first()->id,
                'campaign_org_id'=> CampaignOrg::where('id', $row->campaign_id)->first()->id??1,
                'city_id'        => Province::where('id', $row->city_id)->first()->id,
                'name'           => $row->name,
                'middle_name'    => $row->middle_name,
                'surname'        => $row->surname,
                'mother_name'    => $row->mother_name,
                'father_name'    => $row->father_name,
                'citizenship'    => $row->citizenship,
                'passport_no'    => $row->passport_no,
                'passport_origin'=> $row->passport_origin,
                'phone'          => $row->phone,
                'foriegn_phone'  => $row->foriegn_phone,
                'email'          => $row->email,
                'gender'         => $row->gender,
                'birthday'       => $birthDate,
                'birth_place'    => $row->birth_place,
                'address'        => $row->address,
                'weight'         => $row->weight,
                'height'         => $row->height,
                'blood_group'    => ($row->blood_group==-1)?null:$row->blood_group,
                'code'           => $row->code,
                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
                'deleted_at'     => $row->deleted_at,
            ]);
        }
    }

}
