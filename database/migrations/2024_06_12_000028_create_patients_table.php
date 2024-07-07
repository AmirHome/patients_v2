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
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('passport_no');
            $table->string('passport_origin')->nullable();
            $table->string('phone');
            $table->string('foriegn_phone')->nullable();
            $table->string('email');
            $table->string('gender');
            $table->date('birthday')->nullable();
            $table->string('birth_place')->nullable();
            $table->longText('address')->nullable();
            $table->float('weight', 5, 2)->nullable();
            $table->float('height', 5, 2)->nullable();
            $table->string('blood_group')->nullable();
            $table->string('treating_doctor')->nullable();
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
