<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TravelStatus;
use Illuminate\Support\Facades\DB;

class TravelStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $statuses =   [
            ['id'=>1, 'title'=>'Değerlendirmede'],
            ['id'=>2, 'title'=>'Eksik Rapor'],
            ['id'=>3, 'title'=>'Tedavisi Mümkün Değil'],
            ['id'=>4, 'title'=>'Tedavi Planı Oluşturuldu'],
            ['id'=>5, 'title'=>'Vefat - Ülkesinde'],
            ['id'=>6, 'title'=>'Vefat - Tedavi Aldığı Ülkede'],
            ['id'=>7, 'title'=>'Karar Aşamasında - Alternetifleri Araştırıyor'],
            ['id'=>8, 'title'=>'Karar Aşamasında - Cevap Yeterli Değil'],
            ['id'=>9, 'title'=>'Karar Aşamasında - Seyahat Planı Yapıyor'],
            ['id'=>10, 'title'=>'Karar Aşamasında - Finansal Nedenler'],
            ['id'=>11, 'title'=>'Kaybedilmiş Müşteri - Finansal Nedenler'],
            ['id'=>12, 'title'=>'Kaybedilmiş Müşteri - Farklı Hastanede Tedavi Aldı'],
            ['id'=>13, 'title'=>'Kaybedilmiş Müşteri - Tedavi Planı Yeterli Bulunmadı'],
            ['id'=>14, 'title'=>'Kaybedilmiş Müşteri - Ulaşılamıyor'],
            ['id'=>15, 'title'=>'Kazanılmış Müşteri - Tedavisi Devam Ediyor'],
            ['id'=>16, 'title'=>'Kazanılmış Müşteri - Tedavisi Tamamlandı'],
            ['id'=>17, 'title'=>'Kazanılmış Müşteri - Tedavisi Devam Edecek '],
            ['id'=>18, 'title'=>'Kazanılmış Müşteri - Kontrol İçin Gelecek '],
            ['id'=>19, 'title'=>'Kazanılmış Müşteri - Tedaviyi Red Etti'],
            ['id'=>20, 'title'=>'İptal - Hatalı Giriş'],
            ['id'=>21, 'title'=>'Çevirmen Bekleniyor'],
            ['id'=>31, 'title'=>'Hiç Cevap Vermiyor'],
                ];


        foreach ($statuses as $status) {
            TravelStatus::create([
                'id' => $status['id'],
                'title' => $status['title']
            ]);
        }

    }
}
