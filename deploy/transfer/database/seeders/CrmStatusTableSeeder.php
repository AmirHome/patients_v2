<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        // 'Aranmadı',
        // 'Ulaşılamadı',
        // 'Raporunu Gönderecek',
        // 'Programa kaydedildi',
        // 'İlgilenmiyor',
        // 'Raporu Yok',
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Aranmadı',
            ],
            [
                'id'         => 2,
                'name'       => 'Ulaşılamadı',
            ],
            [
                'id'         => 3,
                'name'       => 'Raporunu Gönderecek',
            ],
            [
                'id'         => 4,
                'name'       => 'Programa kaydedildi',
            ],
            [
                'id'         => 5,
                'name'       => 'İlgilenmiyor',
            ],
            [
                'id'         => 6,
                'name'       => 'Raporu Yok',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
