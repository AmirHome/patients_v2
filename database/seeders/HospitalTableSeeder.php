<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('conversion_db')->table('hospitals')->get();
        
        foreach ($rows as $row) {
            Hospital::create([
                'id'             => $row->id,
                'name'           => $row->name,
                'email'          => $row->email,
                'phone'          => $row->phone,
                'fax'          => $row->fax,
                'address'          => $row->address,
                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
                'deleted_at'     => $row->deleted_at,
            ]);            
        }
    }
}
