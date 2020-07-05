<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_type_id')->unsigned()->nullable();
            $table->dateTime('entry_date', 6)->nullable();
            $table->double('depit',8, 2)->nullable();
            $table->double('credit',8, 2)->nullable();
            $table->integer('cash_box_id')->unsigned()->nullable();
            $table->integer('bank_account_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('ocean_carrier_id')->unsigned()->nullable();
            $table->integer('air_carrier_id')->unsigned()->nullable();
            $table->integer('agent_id')->unsigned()->nullable();
            $table->integer('trucking_id')->unsigned()->nullable();
            $table->integer('clearance_id')->unsigned()->nullable();
            $table->integer('operation_id')->unsigned()->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('financial_entries');
    }
}
