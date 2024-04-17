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
        Schema::table('users', function (Blueprint $table) {


            $table->timestamp('last_seen')->nullable();
            $table->tinyInteger('is_online')->default(0)->nullable();
            $table->tinyInteger('is_active')->default(0)->nullable();
            $table->text('about')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('activation_code')->nullable();
            $table->tinyInteger('is_system')->default(0)->nullable();

            $table->string('player_id')->unique()->nullable()->comment('One signal user id');
            $table->boolean('is_subscribed')->nullable();
            $table->integer('privacy')->default(1);
            $table->integer('gender')->nullable();
            $table->string('language')->default('en');
            $table->boolean('is_super_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('chat_last_seen');
            $table->dropColumn('is_online');
            $table->dropColumn('is_active');
            $table->dropColumn('about');
            $table->dropColumn('photo_url');
            $table->dropColumn('activation_code');
            $table->dropColumn('is_system');
            $table->dropColumn('player_id');
            $table->dropColumn('is_subscribed');
            $table->dropColumn('privacy');
            $table->dropColumn('gender');
            $table->dropColumn('language');
            $table->dropColumn('is_super_admin');

        });
    }
};
