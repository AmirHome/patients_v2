<?php

namespace Database\Seeders;

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
            
            // TravelStatusTableSeeder::class,
            // ProvinceTableSeeder::class,
            // CampaignsTableSeeder::class,
            // TranslatorTableSeeder::class,
            // MinistryTableSeeder::class,
            // TravelGroupTableSeeder::class,
            SettingTableSeeder::class,
            // CustomersTableSeeder::class,
            // OfficeTableSeeder::class,
            // DepartmentTableSeeder::class,
            // HospitalTableSeeder::class,
            // DoctorTableSeeder::class,
            // PatientTableSeeder::class,
            // TravelTableSeeder::class,
            // TravelTreatmentActivityTableSeeder::class,
            // ActivityTableSeeder::class,

            ChatCreatePermissionSeeder::class,
            ChatAddPWAIconFieldSettingSeeder::class,
            ChatAddDefaultSettingSeeder::class,
            ChatFrontCmsSeeder::class,

        ]);
    }
}
