<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attendant_name')->nullable();
            $table->longText('attendant_address')->nullable();
            $table->string('attendant_phone')->nullable();
            $table->boolean('has_pestilence')->default(0)->nullable();
            $table->string('hospital_mail_notify')->nullable();
            $table->string('reffering')->nullable();
            $table->string('reffering_type');
            $table->date('hospitalization_date')->nullable();
            $table->date('planning_discharge_date')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->boolean('wants_shopping')->default(0)->nullable();
            $table->boolean('visa_status')->default(0)->nullable();
            $table->date('visa_start_date')->nullable();
            $table->date('visa_end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
