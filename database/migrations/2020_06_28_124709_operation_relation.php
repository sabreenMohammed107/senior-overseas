<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperationRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //  This is Realations for the operations Table ..
      Schema::table('operations', function (Blueprint $table) {
        $table->foreign('sales_quote_id')->references('id')->on('sale_quotes');
        $table->foreign('shipper_id')->references('id')->on('clients');
        $table->foreign('consignee_id')->references('id')->on('clients');
        $table->foreign('notify_id')->references('id')->on('clients');
        $table->foreign('commodity_id')->references('id')->on('commodities');
        $table->foreign('sales_quote_ocean_id')->references('id')->on('sale_quote_oceans');
        $table->foreign('sales_quote_air_id')->references('id')->on('sale_quote_airs');
        $table->foreign('sales_quote_tracking_id')->references('id')->on('sale_quote_truckings');
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
