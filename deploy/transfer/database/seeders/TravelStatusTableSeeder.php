<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TravelStatus;

class TravelStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses =         [
            'Çevirmen Bekleniyor',
            'Değerlendirmede',
            'Eksik Rapor',
            'Tedavisi Mümkün Değil',
            'Tedavi Planı Oluşturuldu',
            'Vefat - Ülkesinde',
            'Vefat - Tedavi Aldığı Ülkede',
            'Karar Aşamasında - Alternetifleri Araştırıyor',
            'Karar Aşamasında - Cevap Yeterli Değil',
            'Karar Aşamasında - Seyahat Planı Yapıyor',
            'Karar Aşamasında - Finansal Nedenler',
            'Kaybedilmiş Müşteri - Finansal Nedenler',
            'Kaybedilmiş Müşteri - Farklı Hastanede Tedavi Aldı',
            'Kaybedilmiş Müşteri - Tedavi Planı Yeterli Bulunmadı',
            'Kaybedilmiş Müşteri - Ulaşılamıyor',
            'Kazanılmış Müşteri - Tedavisi Devam Ediyor',
            'Kazanılmış Müşteri - Tedavisi Tamamlandı',
            'Kazanılmış Müşteri - Tedavisi Devam Edecek ',
            'Kazanılmış Müşteri - Kontrol İçin Gelecek ',
            'Kazanılmış Müşteri - Tedaviyi Red Etti',
            'İptal - Hatalı Giriş',
        ];

        foreach ($statuses as $status) {
            TravelStatus::create([
                'title' => $status,
            ]);
        }
        
    }
}
