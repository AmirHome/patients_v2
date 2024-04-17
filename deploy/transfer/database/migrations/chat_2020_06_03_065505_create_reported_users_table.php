<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reported_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reported_by');
            $table->unsignedBigInteger('reported_to');
            $table->longText('notes');
            $table->timestamps();

            $table->foreign('reported_by')
                ->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reported_to')
                ->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reported_users');
    }
};
