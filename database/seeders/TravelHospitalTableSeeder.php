<?php

namespace Database\Seeders;

use App\Models\TravelHospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelHospitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('conversion_db')->table('hospital_mails')->get();

        foreach ($rows as $row) {
            TravelHospital::create([
                'id'             => $row->id,
                'title'           => $row->name,
                'email'          => $row->email,
                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
                'deleted_at'     => $row->deleted_at,
            ]);            
        }
    }
}
