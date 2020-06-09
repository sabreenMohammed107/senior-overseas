<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleQuoteTruckingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('sale_quote_truckings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trucking_rate_id')->unsigned()->nullable();
            $table->integer('sale_quote_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->double('car_price')->nullable();
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
        Schema::dropIfExists('sale_quote_truckings');
    }
}
