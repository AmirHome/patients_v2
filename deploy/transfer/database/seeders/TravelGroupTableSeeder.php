<?php

namespace Database\Seeders;

use App\Models\TravelGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('conversion_db')->table('travel_groups')->get();

        foreach ($rows as $row) {
            TravelGroup::create([
                'id'             => $row->id,
                'name'           => $row->name,
                'color'          => $row->color,
            ]);            
        }
    }
}
