<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinanRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  This is Realations for the financial_entries Table ..
        Schema::table('financial_entries', function (Blueprint $table) {
            $table->foreign('trans_type_id')->references('id')->on('finan_trans_types');
            $table->foreign('cash_box_id')->references('id')->on('cash_boxes');
            $table->foreign('bank_account_id')->references('id')->on('banks');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('client_id')->references('id')->on('clients');


            $table->foreign('ocean_carrier_id')->references('id')->on('carriers');
            $table->foreign('air_carrier_id')->references('id')->on('carriers');
            $table->foreign('agent_id')->references('id')->on('agents');

            $table->foreign('trucking_id')->references('id')->on('suppliers');
            $table->foreign('clearance_id')->references('id')->on('suppliers');
            $table->foreign('operation_id')->references('id')->on('operations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
