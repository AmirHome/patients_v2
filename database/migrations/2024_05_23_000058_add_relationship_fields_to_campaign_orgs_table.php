<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCampaignOrgsTable extends Migration
{
    public function up()
    {
        Schema::table('campaign_orgs', function (Blueprint $table) {
            $table->unsignedBigInteger('channel_id')->nullable();
            $table->foreign('channel_id', 'channel_fk_9610507')->references('id')->on('campaign_channels');
        });
    }
}
