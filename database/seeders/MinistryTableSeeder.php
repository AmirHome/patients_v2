<?php

namespace Database\Seeders;

use App\Models\Ministry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinistryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rows = DB::connection('conversion_db')->table('ministries')->get();

        foreach ($rows as $row) {
            Ministry::create([
                'id'             => $row->id,
                'name'           => $row->name,
                'code'          => $row->code,
                'code_inc'          => $row->code_inc,
                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
                'deleted_at'     => $row->deleted_at,
            ]);            
        }
        


    }
}
