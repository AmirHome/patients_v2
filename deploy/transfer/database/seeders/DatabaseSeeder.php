<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\TravelTreatmentActivity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '3072M');

        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,

            CountriesTableSeeder::class,
            ProvinceTableSeeder::class,
            OfficeTableSeeder::class,
            UsersTableSeeder::class,
            CrmStatusTableSeeder::class,
            TaskStatusTableSeeder::class,

            TravelStatusTableSeeder::class,
            TravelHospitalTableSeeder::class,
            TravelGroupTableSeeder::class,
            CampaignsTableSeeder::class,
            TranslatorTableSeeder::class,
            MinistryTableSeeder::class,
            SettingTableSeeder::class,
            
            DepartmentTableSeeder::class,
            HospitalTableSeeder::class,
            DoctorTableSeeder::class,

            ChatCreatePermissionSeeder::class,
            ChatAddPWAIconFieldSettingSeeder::class,
            ChatAddDefaultSettingSeeder::class,
            ChatFrontCmsSeeder::class,

        ]);


        // If APP_ENV is not production (is local), seed the following tables
        if (!env('APP_DEBUG')) {
            $this->call([
                CustomersTableSeeder::class,
                PatientTableSeeder::class,
                TravelTableSeeder::class,
                TravelTreatmentActivityTableSeeder::class,
                ActivityTableSeeder::class,
            ]);
        } else {
            $limit = 20;
            $this->callWith(CustomersTableSeeder::class, ['limit' => $limit]);
            $this->callWith(PatientTableSeeder::class, ['limit' => $limit]);
            $this->callWith(TravelTableSeeder::class, ['limit' => $limit+100]);
            $this->callWith(TravelTreatmentActivityTableSeeder::class, ['limit' => $limit]);
            $this->callWith(ActivityTableSeeder::class, ['limit' => $limit]);
        }

        $this->call([
            FinanceCategorySeeder::class,
        ]);

    }
}
