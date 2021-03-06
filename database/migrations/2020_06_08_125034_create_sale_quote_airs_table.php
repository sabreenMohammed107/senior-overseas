<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleQuoteAirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('sale_quote_airs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('air_rate_id')->unsigned()->nullable();
            $table->integer('sale_quote_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->double('price')->nullable();
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
        Schema::dropIfExists('sale_quote_airs');
    }
}
