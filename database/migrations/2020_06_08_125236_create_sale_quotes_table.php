<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('sale_quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('quote_date', 6)->nullable();
            $table->string('quote_code', 250)->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('sale_person_id')->unsigned()->nullable();
            $table->integer('ocean_air_type')->nullable();
            $table->double('clearance_price')->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->integer('agent_id')->unsigned()->nullable();
            $table->integer('clearance_currency_id')->unsigned()->nullable();
            $table->text('clearance_notes')->nullable();
            $table->double('door_door_price')->nullable();
            $table->integer('door_door_currency_id')->unsigned()->nullable();
            $table->integer('sale_quotes_type_id')->unsigned()->nullable();
            $table->text('door_door_notes')->nullable();
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
        Schema::dropIfExists('sales_quotes');
    }
}
