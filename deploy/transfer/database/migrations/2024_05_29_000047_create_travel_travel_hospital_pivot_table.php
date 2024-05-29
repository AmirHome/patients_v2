<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTravelHospitalPivotTable extends Migration
{
    public function up()
    {
        Schema::create('travel_travel_hospital', function (Blueprint $table) {
            $table->unsignedBigInteger('travel_id');
            $table->foreign('travel_id', 'travel_id_fk_9765788')->references('id')->on('travels')->onDelete('cascade');
            $table->unsignedBigInteger('travel_hospital_id');
            $table->foreign('travel_hospital_id', 'travel_hospital_id_fk_9765788')->references('id')->on('travel_hospitals')->onDelete('cascade');
        });
    }
}
