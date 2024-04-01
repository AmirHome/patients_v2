<?php

namespace Database\Seeders;

use App\Models\Travel;
use App\Models\TravelStatus;
use App\Models\TravelTreatmentActivity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TravelTreatmentActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $rows = DB::connection('conversion_db')->table('treatment_actions')->get();

        foreach ($rows as $row) {
            TravelTreatmentActivity::create([
                'id'             => $row->id,
                'user_id'        => User::where('id', $row->user_id)->first()->id, 
                'travel_id'      => Travel::where('id', $row->travel_id)->first()->id,
                'status_id'      => TravelStatus::where('id', $row->status)->first()->id??null,
                'description'    => $row->description,
            ]);
        }
            

        $rows = DB::connection('conversion_db')->table('treatment_files')->get();

        foreach ($rows as $key => $row) {
            
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
