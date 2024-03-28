<?php

namespace Database\Seeders;

use App\Models\CampaignChannel;
use App\Models\CampaignOrg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channelsRows = DB::connection('conversion_db')->table('campaign_channels')->get();
        foreach ($channelsRows as $row) {
            CampaignChannel::create([
                'id'             => $row->id,
                'title'           => $row->name,
                'created_at'     => $row->created_at,
                'updated_at'     => $row->updated_at,
            ]);
        }

        $campaignsRows = DB::connection('conversion_db')->table('campaigns')->get();
        foreach ($campaignsRows as $row) {
            CampaignOrg::create([
                'id'             => $row->id,
                'title'           => $row->name,
                'channel_id' => $row->channel_id,
                'started_at' => $row->started_at,
                'status' => $row->status,
            ]);
        }
    }
}
