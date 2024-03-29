<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Setting;
use App\Models\TravelGroup;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CrmStatusTableSeeder::class,
            TaskStatusTableSeeder::class,
            CountriesTableSeeder::class,
            
            TravelTreatmentStatusTableSeeder::class,
            ProvinceTableSeeder::class,
            CampaignsTableSeeder::class,
            TranslatorTableSeeder::class,
            MinistryTableSeeder::class,
            TravelGroupTableSeeder::class,
            SettingTableSeeder::class,
            CustomersTableSeeder::class,
            OfficeTableSeeder::class,
            DepartmentTableSeeder::class,
            HospitalTableSeeder::class,
            DoctorTableSeeder::class,

        ]);
    }
}
