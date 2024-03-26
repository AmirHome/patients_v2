<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTranslatorsTable extends Migration
{
    public function up()
    {
        Schema::table('translators', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_9610708')->references('id')->on('provinces');
        });
    }
}
