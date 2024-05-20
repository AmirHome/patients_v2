<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('conversion_db')->table('doctors')->get();

        foreach ($rows as $row) {
            Doctor::create([
                'id'             => $row->id,
                'name'           => $row->name,
                'phone'          => $row->phone,
                'email'          => $row->email,
                'address'          => $row->address,
                'city_id'          => Province::where('id', $row->city_id)->first()->id, //$row->city_id,
                'hospital_id'          => Hospital::where('id', $row->hospital_id)->first()->id ?? 1, //$row->hospital_id,
                'department_id'          => Department::where('id', $row->department_id)->first()->id ?? 1, //$row->department_id,
                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
                'deleted_at'     => $row->deleted_at,
            ]);
        }
    }
}
