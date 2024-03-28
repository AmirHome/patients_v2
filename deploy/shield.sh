#!/bin/bash

# Laravel Seeder
cp database/seeders/CampaignsTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CountriesTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DatabaseSeeder.php deploy/transfer/database/seeders
cp database/seeders/ProvinceTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelTreatmentStatusTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/UsersTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TranslatorTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/MinistryTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelGroupTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/SettingTableSeeder.php deploy/transfer/database/seeders



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

echo -e "\e[34mCopied Shield files.\e[0m"