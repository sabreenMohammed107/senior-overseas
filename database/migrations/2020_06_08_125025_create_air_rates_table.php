<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('air_carrier_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('aol_id')->unsigned()->nullable();
            $table->integer('aod_id')->unsigned()->nullable();
            $table->string('slide_range', 250)->nullable();
            $table->double('price')->nullable();
            $table->dateTime('validity_date', 6)->nullable();
            $table->text('notes')->nullable();
            $table->string('code', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('air_rates');
    }
}
