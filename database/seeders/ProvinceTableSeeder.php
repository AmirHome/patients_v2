<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('conversion_db')->table('cities')->get();

        foreach ($rows as $row) {
            Province::create([
                'id'             => $row->id,
                'name'           => $row->name,
                'country_id'     => $row->country_id,
            ]);
        }
    }
}
