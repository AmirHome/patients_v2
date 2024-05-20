<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatorsTable extends Migration
{
    public function up()
    {
        Schema::create('translators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
