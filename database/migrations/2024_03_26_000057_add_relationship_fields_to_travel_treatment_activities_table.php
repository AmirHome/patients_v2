<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTravelTreatmentActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('travel_treatment_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9634840')->references('id')->on('users');
            $table->unsignedBigInteger('travel_id')->nullable();
            $table->foreign('travel_id', 'travel_fk_9634841')->references('id')->on('travels');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9634861')->references('id')->on('travel_treatment_statuses');
        });
    }
}
