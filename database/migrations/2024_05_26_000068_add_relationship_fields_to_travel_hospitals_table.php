<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTravelHospitalsTable extends Migration
{
    public function up()
    {
        Schema::table('travel_hospitals', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9813326')->references('id')->on('teams');
        });
    }
}
