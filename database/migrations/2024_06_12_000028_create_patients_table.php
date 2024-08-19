<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('gender');
            $table->string('surname');
            $table->string('phone');
            $table->string('middle_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_origin')->nullable();
            $table->string('foriegn_phone')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birth_place')->nullable();
            $table->longText('address')->nullable();
            $table->float('weight', 5, 2)->nullable();
            $table->float('height', 5, 2)->nullable();
            $table->string('blood_group')->nullable();
            $table->string('treating_doctor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
