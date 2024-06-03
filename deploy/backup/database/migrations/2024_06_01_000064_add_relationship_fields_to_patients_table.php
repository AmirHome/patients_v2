<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPatientsTable extends Migration
{
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9621268')->references('id')->on('users');
            $table->unsignedBigInteger('office_id')->nullable();
            $table->foreign('office_id', 'office_fk_9621271')->references('id')->on('offices');
            $table->unsignedBigInteger('campaign_org_id')->nullable();
            $table->foreign('campaign_org_id', 'campaign_org_fk_9621273')->references('id')->on('campaign_orgs');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_9621275')->references('id')->on('provinces');
        });
    }
}
