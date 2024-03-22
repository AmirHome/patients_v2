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
            $table->string('status');
            $table->string('attendant_name');
            $table->longText('attendant_address')->nullable();
            $table->string('attendant_phone');
            $table->boolean('has_pestilence')->default(0);
            $table->string('hospital_mail_notify')->nullable();
            $table->integer('reffering');
            $table->string('reffering_type');
            $table->string('reffering_other')->nullable();
            $table->date('hospitalization_date');
            $table->date('planning_discharge_date');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->boolean('wants_shopping')->default(0);
            $table->boolean('visa_status')->default(0);
            $table->date('visa_start_date');
            $table->date('visa_end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
