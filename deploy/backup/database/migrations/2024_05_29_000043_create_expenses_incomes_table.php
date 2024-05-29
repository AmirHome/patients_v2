<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesIncomesTable extends Migration
{
    public function up()
    {
        Schema::create('expenses_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->decimal('amount', 15, 2);
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
