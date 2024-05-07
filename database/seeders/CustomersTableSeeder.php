<?php

namespace Database\Seeders;

use App\Models\CampaignOrg;
use App\Models\CrmCustomer;
use App\Models\CrmDocument;
use App\Models\CrmStatus;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Exception;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($limit=null): void
    {
        $rows = DB::connection('conversion_db')->table('customers');
        if(isset($limit)) {
            $rows = $rows->orderByDesc('id')->limit($limit);
        }
        $rows = $rows->get();

        foreach ($rows as $row) {

            $birthDate = $row->birth_date;

            try {
                if ($birthDate !== '0000-00-00') {
                    //$date = Carbon::createFromFormat('Y-m-d', $birthDate);
                    $date = new DateTime($birthDate);

                    $birthDate = $date->format('Y-m-d');
                } else {
                    $birthDate = null;
                }
            } catch (Exception $e) {
                $birthDate = null;
            }
            CrmCustomer::create([
                'id'             => $row->id,
                'user_id'        => User::where('id', $row->user_id)->first()->id,
                'status_id'      => $row->status+1,
                'campaign_id'    => CampaignOrg::where('id', $row->campaign_id)->first()->id ?? 1,
                'city_id'        => Province::where('id', $row->city_id)->first()->id,
                'first_name'     => $row->name,
                'last_name'      => $row->surname,
                'email'          => $row->email,
                'phone'          => $row->phone,
                
                'birthday'       => $birthDate,
            ]);            
        }

        $customer_ids = CrmCustomer::pluck('id')->toArray();

        $rows = DB::connection('conversion_db')->table('customer_actions')->get();

        foreach ($rows as $row) {
            if(!in_array($row->customer_id, $customer_ids)) continue;
            CrmDocument::create([
                'id'             => $row->id,
                'customer_id'    => CrmCustomer::where('id', $row->customer_id)->first()->id ?? 1,
                'user_id'    => User::where('id', $row->user_id)->first()->id,
                'status_id'      => $row->status+1,
                'description'     => $row->description,
            ]);
        }
        $document_ids = CrmDocument::pluck('id')->toArray();

        $rows = DB::connection('conversion_db')->table('customer_files')->get();

        foreach ($rows as $key => $row) {
            if(!in_array($row->customer_action_id, $document_ids)) continue;
            Media::create([
                'model_type' => 'App\Models\CrmDocument',
                'model_id'    => CrmDocument::where('id', $row->customer_action_id)->first()->id,
                'collection_name' => 'document_file',
                'name' => $row->name,
                'file_name' => $row->name,
                'disk'=> 'public',
                'conversions_disk'=> 'public',
                'size' => $row->size,
                'mime_type' => $row->mime_type,
                'manipulations' => [],
                'custom_properties'=> [],
                'generated_conversions' =>[],
                'responsive_images'=> [],
            ]);
        }
        
    }
}
