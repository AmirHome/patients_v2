<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalTravelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('hospital_travel', function (Blueprint $table) {
            $table->unsignedBigInteger('travel_id');
            $table->foreign('travel_id', 'travel_id_fk_9765788')->references('id')->on('travels')->onDelete('cascade');
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('hospital_id', 'hospital_id_fk_9765788')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }
}
