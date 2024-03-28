<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Setting::create([
            'central_hospital_mail'           => 'info@turmeda.com, mahmut@turmeda.com',
            'central_hospital_mail_cc'          => 'info@turmeda.com, mahmut@turmeda.com',
            'central_hospital_mail_bcc'          => '',
        ]);
    }
}
