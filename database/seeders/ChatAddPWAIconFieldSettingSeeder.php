<?php

namespace Database\Seeders;

use App\Models\ChatSetting as Setting;
use Illuminate\Database\Seeder;

class ChatAddPWAIconFieldSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pwaIcon = ('assets/images/logo-30x30.png');
        Setting::create(['key' => 'pwa_icon', 'value' => $pwaIcon]);
    }
}
