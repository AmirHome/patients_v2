<?php

namespace Database\Seeders;

use App\Models\TravelTreatmentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelTreatmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $travelTreatmentStatus = [
            [
                'id'  => 1,
                'title' => 'Çevirmen Bekleniyor',
            ],
            [
                'id'  => 2,
                'title' => 'Değerlendirmede',
            ],
            [
                'id'  => 3,
                'title' => 'Eksik Rapor',
            ],
            [
                'id'  => 4,
                'title' => 'Tedavisi Mümkün Değil',
            ],
            [
                'id'  => 5,
                'title' => 'Tedavi Planı Oluşturuldu',
            ],
            [
                'id'  => 6,
                'title' => 'Vefat - Ülkesinde',
            ],
            [
                'id'  => 7,
                'title' => 'Vefat - Tedavi Aldığı Ülkede',
            ],
            [
                'id'  => 8,
                'title' => 'Karar Aşamasında - Alternetifleri Araştırıyor',
            ],
            [
                'id'  => 9,
                'title' => 'Karar Aşamasında - Cevap Yeterli Değil',
            ],
            [
                'id'  => 10,
                'title' => 'Karar Aşamasında - Seyahat Planı Yapıyor',
            ],
            [
                'id'  => 11,
                'title' => 'Karar Aşamasında - Finansal Nedenler',
            ],
            [
                'id'  => 12,
                'title' => 'Kaybedilmiş Müşteri - Finansal Nedenler',
            ],
            [
                'id'  => 13,
                'title' => 'Kaybedilmiş Müşteri - Farklı Hastanede Tedavi Aldı',
            ],
            [
                'id'  => 14,
                'title' => 'Kaybedilmiş Müşteri - Tedavi Planı Yeterli Bulunmadı',
            ],
            [
                'id'  => 15,
                'title' => 'Kaybedilmiş Müşteri - Ulaşılamıyor',
            ],
            [
                'id'  => 16,
                'title' => 'Kazanılmış Müşteri - Tedavisi Devam Ediyor',
            ],
            [
                'id'  => 17,
                'title' => 'Kazanılmış Müşteri - Tedavisi Tamamlandı',
            ],
            [
                'id'  => 18,
                'title' => 'Kazanılmış Müşteri - Tedavisi Devam Edecek ',
            ],
            [
                'id'  => 19,
                'title' => 'Kazanılmış Müşteri - Kontrol İçin Gelecek ',
            ],
            [
                'id'  => 20,
                'title' => 'Kazanılmış Müşteri - Tedaviyi Red Etti',
            ],
            [
                'id'  => 21,
                'title' => 'İptal - Hatalı Giriş',
            ],
        ];

        TravelTreatmentStatus::insert($travelTreatmentStatus);
    }
}
