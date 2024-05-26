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
            $table->string('middle_name');
            $table->string('surname');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('citizenship');
            $table->string('passport_no');
            $table->string('passport_origin');
            $table->string('phone');
            $table->string('foriegn_phone');
            $table->string('email');
            $table->string('gender');
            $table->date('birthday')->nullable();
            $table->string('birth_place');
            $table->longText('address');
            $table->float('weight', 5, 2);
            $table->float('height', 5, 2);
            $table->string('blood_group')->nullable();
            $table->string('treating_doctor')->nullable();
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
