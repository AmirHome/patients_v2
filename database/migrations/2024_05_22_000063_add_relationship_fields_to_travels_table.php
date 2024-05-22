<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTravelsTable extends Migration
{
    public function up()
    {
        Schema::table('travels', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_9623420')->references('id')->on('patients');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_9623421')->references('id')->on('travel_groups');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id', 'hospital_fk_9623422')->references('id')->on('hospitals');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_9623423')->references('id')->on('departments');
            $table->unsignedBigInteger('last_status_id')->nullable();
            $table->foreign('last_status_id', 'last_status_fk_9735286')->references('id')->on('travel_statuses');
        });
    }
}
