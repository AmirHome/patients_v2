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
    public function run($limit=null): void
    {
        # GUIDE: Hızlı Vaka Girisi Rapor Yükleme  attach files into TravelTreatmentActivity
        # GUIDE: Raporlar attach files into TravelTreatmentActivity

        $rows = DB::connection('conversion_db')->table('treatment_actions');
        if(isset($limit)) {
            $rows = $rows->where('travel_id', Travel::pluck('id')->toArray())->limit($limit);
            
        }
        $rows = $rows->get();
        
        foreach ($rows as $row) {
            

            TravelTreatmentActivity::create([
                'id'             => $row->id,
                'user_id'        => User::where('id', $row->user_id)->first()->id, 
                'travel_id'      => Travel::where('id', $row->travel_id)->first()->id,
                'status_id'      => TravelStatus::where('id', $row->status)->first()->id??null,
                'description'    => $row->description,
            ]);
        }
            
        $treatment_action_ids = TravelTreatmentActivity::pluck('id')->toArray();

        $rows = DB::connection('conversion_db')->table('treatment_files')->get();
        foreach ($rows as $key => $row) {
            if(!in_array($row->treatment_action_id, $treatment_action_ids)) continue;
            if(empty($row->name)) continue;
            Media::create([
                'model_type' => 'App\Models\TravelTreatmentActivity',
                'model_id'    => TravelTreatmentActivity::where('id', $row->treatment_action_id)->first()->id,
                'collection_name' => 'treatment_file',
                'name' => $row->description??'',
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
