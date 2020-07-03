<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  This is Realations for the clients Table ..
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });

        //  This is Realations for the ports Table ..
        Schema::table('ports', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('port_type_id')->references('id')->on('port_types');
        });


        //  This is Realations for the bank_accounts Table ..
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->foreign('currency_id')->references('id')->on('currencies');
        });


        //  This is Realations for the suppliers Table ..
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('supplier_type_id')->references('id')->on('supplier_types');
        });

        //  This is Realations for the agents Table ..
        Schema::table('agents', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });

        //  This is Realations for the carriers Table ..
        Schema::table('carriers', function (Blueprint $table) {
            $table->foreign('carrier_type_id')->references('id')->on('carrier_types');
        });
 //  This is Realations for the ocean_freight_rates Table ..
 Schema::table('ocean_freight_rates', function (Blueprint $table) {
    $table->foreign('carrier_id')->references('id')->on('carriers');
    $table->foreign('pol_id')->references('id')->on('ports');
    $table->foreign('pod_id')->references('id')->on('ports');
    $table->foreign('container_id')->references('id')->on('containers');
    $table->foreign('currency_id')->references('id')->on('currencies');
});



//  This is Realations for the air_rates Table ..
Schema::table('air_rates', function (Blueprint $table) {
    $table->foreign('air_carrier_id')->references('id')->on('carriers');
    $table->foreign('currency_id')->references('id')->on('currencies');
    $table->foreign('aol_id')->references('id')->on('ports');
    $table->foreign('aod_id')->references('id')->on('ports');
  
});
         //  This is Realations for the trucking_rates Table ..
         Schema::table('trucking_rates', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('pol_id')->references('id')->on('ports');
            $table->foreign('pod_id')->references('id')->on('ports');
            $table->foreign('car_type_id')->references('id')->on('car_types');
        });

          //  This is Realations for the sale_quote_airs Table ..
          Schema::table('sale_quote_airs', function (Blueprint $table) {
         
            $table->foreign('air_rate_id')->references('id')->on('air_rates');
            $table->foreign('sale_quote_id')->references('id')->on('sale_quotes')->onDelete('cascade');;
            $table->foreign('currency_id')->references('id')->on('currencies');
        });

         //  This is Realations for the sale_quote_oceans Table ..
         Schema::table('sale_quote_oceans', function (Blueprint $table) {
         
            $table->foreign('ocean_rate_id')->references('id')->on('ocean_freight_rates');
            $table->foreign('sale_quote_id')->references('id')->on('sale_quotes')->onDelete('cascade');;
            $table->foreign('currency_id')->references('id')->on('currencies');
        });


         //  This is Realations for the sale_quote_truckings Table ..
         Schema::table('sale_quote_truckings', function (Blueprint $table) {
         
            $table->foreign('trucking_rate_id')->references('id')->on('trucking_rates');
            $table->foreign('sale_quote_id')->references('id')->on('sale_quotes')->onDelete('cascade');;
            $table->foreign('currency_id')->references('id')->on('currencies');
        });

        
        //  This is Realations for the sale_quotes Table ..
        Schema::table('sale_quotes', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('clearance_currency_id')->references('id')->on('currencies');
            $table->foreign('door_door_currency_id')->references('id')->on('currencies');
            $table->foreign('sale_person_id')->references('id')->on('employees');
            $table->foreign('agent_id')->references('id')->on('agents');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
