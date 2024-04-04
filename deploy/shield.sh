#!/bin/bash



# Laravel DB, Seeder
mkdir -p deploy/transfer/database/seeders

cp database/patients_db_old.sql deploy/transfer/database
#$ php artisan make:seeder ActivityTableSeeder
cp database/seeders/CampaignsTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CountriesTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DatabaseSeeder.php deploy/transfer/database/seeders
cp database/seeders/ProvinceTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelStatusTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/UsersTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TranslatorTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/MinistryTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelGroupTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/SettingTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CustomersTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CrmStatusTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/OfficeTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DepartmentTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/HospitalTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DoctorTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/PatientTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelTreatmentActivityTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/ActivityTableSeeder.php deploy/transfer/database/seeders

# Development
mkdir -p deploy/transfer/resources/views/layouts
mkdir -p deploy/transfer/app/Providers
mkdir -p deploy/transfer/config

cp -r app/Interfaces deploy/transfer/app
cp -r app/Helpers deploy/transfer/app
cp config/database.php deploy/transfer/config
cp config/media-library.php deploy/transfer/config

cp resources/views/layouts/admin.blade.php deploy/transfer/resources/views/layouts

cp app/Providers/AppServiceProvider.php deploy/transfer/app/Providers
cp composer.json composer.json.bak


# LiveWire
mkdir -p deploy/transfer/app
mkdir -p deploy/transfer/resources/views/livewire
mkdir -p deploy/transfer/resources/views/components

cp -r app/Livewire deploy/transfer/app
cp -r resources/views/livewire deploy/transfer/resources/views
cp -r resources/views/components deploy/transfer/resources/views

# Write to function coding() in deploy/transfer.sh
LINE="Route::get('/counter', '\App\Livewire\Counter');"
FILE=routes/web.php
grep -qF -- "$LINE" "$FILE" || echo "$LINE" >> "$FILE"

echo  "Copied Shield files."
