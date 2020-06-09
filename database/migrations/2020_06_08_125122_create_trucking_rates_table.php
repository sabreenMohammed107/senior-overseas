<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckingRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('trucking_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->integer('pol_id')->unsigned()->nullable();
            $table->integer('pod_id')->unsigned()->nullable();
            $table->integer('car_type_id')->unsigned()->nullable();
            $table->double('car_price')->nullable();
            $table->integer('car_currency_id')->unsigned()->nullable();
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
        Schema::dropIfExists('trucking_rates');
    }
}
