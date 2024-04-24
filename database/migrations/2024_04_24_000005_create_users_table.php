<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('job_type')->nullable();
            $table->string('can_see_prices')->nullable();
            $table->string('can_set_prices')->nullable();
            $table->string('is_super')->nullable();
            $table->string('remember_token')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
