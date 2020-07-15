<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpensesRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //  This is Realations for the operation_expenses Table ..
         Schema::table('operation_expenses', function (Blueprint $table) {
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('expenses_type_id')->references('id')->on('expenses');
            $table->foreign('cashbox_expenses_types_id')->references('id')->on('cashbox_expenses_types');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('ocean_carrier_id')->references('id')->on('carriers');
            $table->foreign('air_carrier_id')->references('id')->on('carriers');
            $table->foreign('agent_id')->references('id')->on('agents');

            $table->foreign('trucking_id')->references('id')->on('suppliers');
            $table->foreign('clearance_id')->references('id')->on('suppliers');
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
