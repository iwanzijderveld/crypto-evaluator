<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinChangesTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_changes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('coin_id');
            $table->double('percent_change', 6, 2);
            $table->double('price', 10, 8);
            $table->boolean('positive');
            $table->timestamps();

            $table->foreign('coin_id')->references('id')->on('coins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_changes');
    }
}