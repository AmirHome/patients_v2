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
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CrmStatusTableSeeder::class,
            TaskStatusTableSeeder::class,
            CountriesTableSeeder::class,

            TravelStatusTableSeeder::class,
            ProvinceTableSeeder::class,
            CampaignsTableSeeder::class,
            TranslatorTableSeeder::class,
            MinistryTableSeeder::class,
            TravelGroupTableSeeder::class,
            SettingTableSeeder::class,
            //CustomersTableSeeder::class,
            OfficeTableSeeder::class,
            DepartmentTableSeeder::class,
            HospitalTableSeeder::class,
            DoctorTableSeeder::class,

            // PatientTableSeeder::class,
            // TravelTableSeeder::class,
            // TravelTreatmentActivityTableSeeder::class,
            // ActivityTableSeeder::class,

            ChatCreatePermissionSeeder::class,
            ChatAddPWAIconFieldSettingSeeder::class,
            ChatAddDefaultSettingSeeder::class,
            ChatFrontCmsSeeder::class,

        ]);


        // If APP_ENV is not production, seed the following tables
        if (env('APP_ENV') == 'production') {
            $this->call([
                CustomersTableSeeder::class,
                PatientTableSeeder::class,
                TravelTableSeeder::class,
                TravelTreatmentActivityTableSeeder::class,
                ActivityTableSeeder::class,
            ]);
        } else {
            $this->callWith(CustomersTableSeeder::class, ['limit' => 20]);
            $this->callWith(PatientTableSeeder::class, ['limit' => 20]);
            $this->callWith(TravelTableSeeder::class, ['limit' => 120]);
            $this->callWith(TravelTreatmentActivityTableSeeder::class, ['limit' => 20]);
            $this->callWith(ActivityTableSeeder::class, ['limit' => 20]);
        }
    }
}
