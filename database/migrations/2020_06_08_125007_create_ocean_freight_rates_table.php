<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOceanFreightRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocean_freight_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ocean_freight', 250)->nullable();
            $table->double('price')->nullable();
            $table->integer('carrier_id')->unsigned()->nullable();
            $table->integer('pol_id')->unsigned()->nullable();
            $table->integer('pod_id')->unsigned()->nullable();
            $table->integer('container_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('transit_time')->nullable();
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
        Schema::dropIfExists('ocean_freight_rates');
    }
}
