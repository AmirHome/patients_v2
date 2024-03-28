<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Translator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rows = DB::connection('conversion_db')->table('translators')->get();

        foreach ($rows as $row) {
            Translator::create([
                'id'             => $row->id,
                'title'           => $row->title,
                'email'          => $row->email,
                'phone'          => $row->phone,
                'city_id'          => Province::where('name', $row->city)->first()->id,
            ]);            
        }
    }
}
