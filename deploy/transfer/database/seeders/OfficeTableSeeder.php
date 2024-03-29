<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('conversion_db')->table('offices')->get();

        foreach ($rows as $row) {
            Office::create([
                'id'             => $row->id,
                'name'           => $row->name,
                'phone'          => $row->phone,
                'fax'          => $row->fax,
                'address'          => $row->address,
                'city_id'          => Province::where('id', $row->city_id)->first()->id, //$row->city_id,
            ]);            
        }
    }
}
