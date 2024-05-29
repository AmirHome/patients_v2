<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_9610777')->references('id')->on('provinces');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id', 'hospital_fk_9610778')->references('id')->on('hospitals');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_9610779')->references('id')->on('departments');
        });
    }
}
